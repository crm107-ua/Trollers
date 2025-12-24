<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Story;
use App\Jobs\ProcessStoryVideo;
use Illuminate\Support\Facades\Log;

class ProcessStoryVideoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'story:process-video {story_id} {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process a story video for HLS streaming in the background';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $storyId = $this->argument('story_id');
        $filename = $this->argument('filename');

        Log::info("Starting background video processing for Story ID: {$storyId}");

        $story = Story::find($storyId);

        if (!$story) {
            Log::error("Story not found: {$storyId}");
            return 1;
        }

        try {
            // We reuse the Logic from the Job, but run it synchronously here
            // since this command is ALREADY running in the background via exec()
            ProcessStoryVideo::dispatchSync($story, $filename);

            Log::info("Video processing complete for Story ID: {$storyId}");
        } catch (\Throwable $e) {
            Log::error("Video processing failed for Story ID: {$storyId}: " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
