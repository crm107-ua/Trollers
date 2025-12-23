<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\User;
use Intervention\Image\Facades\Image;

class StoryController extends Controller
{
    /**
     * Display a listing of stories
     */
    public function index()
    {
        $stories = Story::with('user')->orderBy('created_at', 'desc')->get();
        return view('general.Stories.index', compact('stories'));
    }

    /**
     * Show the form for creating a new story
     */
    public function create()
    {
        $users = User::orderBy('name', 'asc')->get();
        return view('general.Stories.create', compact('users'));
    }

    /**
     * Store a newly created story
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'user_name' => 'nullable|string|max:255', // Keep for backward compatibility
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,webm,mov|max:204800', // 200MB max
            'duration' => 'nullable|integer|max:120' // Max 120 seconds (2 minutes)
        ]);

        $file = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Detect media type
        $mimeType = $file->getMimeType();
        $mediaType = str_starts_with($mimeType, 'video') ? 'video' : 'image';

        // Move file to stories folder
        $file->move(public_path('images/stories'), $filename);

        // Get user name for legacy field
        $user = User::find($request->user_id);

        // Create story record
        Story::create([
            'user_id' => $request->user_id,
            'user_name' => $user->name, // Keep for backward compatibility
            'image_path' => $filename,
            'media_type' => $mediaType,
            'duration' => $request->duration
        ]);

        return redirect()->route('home')->with('success', 'Story publicada correctamente!');
    }

    /**
     * Display the specified story
     */
    public function show($id)
    {
        $story = Story::findOrFail($id);
        $allStories = Story::orderBy('created_at', 'desc')->get();

        return view('general.Stories.show', compact('story', 'allStories'));
    }

    /**
     * Remove the specified story
     */
    public function destroy($id)
    {
        $story = Story::findOrFail($id);

        // Delete file
        $filePath = public_path('images/stories/' . $story->image_path);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $story->delete();

        return redirect()->route('home')->with('success', 'Story eliminada correctamente!');
    }

    /**
     * Get stories as JSON for AJAX
     */
    public function getStoriesJson()
    {
        $stories = Story::orderBy('created_at', 'desc')->get();
        return response()->json($stories);
    }

    /**
     * Delete all stories and their files
     */
    public function deleteAll()
    {
        // Get all stories
        $stories = Story::all();

        // Delete all files
        foreach ($stories as $story) {
            $filePath = public_path('images/stories/' . $story->image_path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Delete all related data first (to avoid foreign key constraint)
        \App\Models\StoryView::query()->delete();
        \App\Models\StoryComment::query()->delete();

        // Delete all stories
        Story::query()->delete();

        return redirect()->route('home')->with('success', 'Todas las stories han sido eliminadas correctamente!');
    }

    /**
     * Clean stories older than 24 hours
     */
    public static function cleanOldStories()
    {
        $twentyFourHoursAgo = \Carbon\Carbon::now()->subHours(24);
        $oldStories = Story::where('created_at', '<', $twentyFourHoursAgo)->get();

        foreach ($oldStories as $story) {
            $filePath = public_path('images/stories/' . $story->image_path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $story->delete();
        }
    }

    /**
     * Mark story as viewed
     */
    public function markAsViewed(Request $request, $id)
    {
        $userId = auth()->id();

        // Create or update view record
        \App\Models\StoryView::updateOrCreate(
            ['user_id' => $userId, 'story_id' => $id],
            ['viewed_at' => now()]
        );

        return response()->json(['success' => true]);
    }

    /**
     * Get comments for a story
     */
    public function getComments($id)
    {
        $comments = \App\Models\StoryComment::where('story_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($comments);
    }

    /**
     * Add a comment to a story
     */
    public function addComment(Request $request, $id)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'comment' => 'required|string|max:500'
        ]);

        $comment = \App\Models\StoryComment::create([
            'story_id' => $id,
            'user_name' => $request->user_name,
            'comment' => $request->comment
        ]);

        return response()->json($comment);
    }
}
