<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $table = 'stories';

    protected $fillable = [
        'user_id',
        'user_name',
        'image_path',
        'media_type',
        'duration'
    ];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    // Relationship with StoryView model
    public function views()
    {
        return $this->hasMany(StoryView::class);
    }

    // Relationship with StoryComment model
    public function comments()
    {
        return $this->hasMany(StoryComment::class);
    }

    // Get stories ordered by most recent
    public static function getRecent($limit = 20)
    {
        return self::orderBy('created_at', 'desc')->limit($limit)->get();
    }
}
