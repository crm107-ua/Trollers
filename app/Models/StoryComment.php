<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryComment extends Model
{
    use HasFactory;

    protected $fillable = ['story_id', 'user_name', 'comment'];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }
}
