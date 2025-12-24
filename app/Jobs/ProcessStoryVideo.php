<?php

namespace App\Jobs;

use App\Models\Story;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ProcessStoryVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $story;
    protected $originalFilename;

    public function __construct(Story $story, $originalFilename)
    {
        $this->story = $story;
        $this->originalFilename = $originalFilename;
    }

    public function handle()
    {
        $lowBitrate = (new X264)->setKiloBitrate(500); // 360p/480p approx
        $midBitrate = (new X264)->setKiloBitrate(1500); // 720p approx
        $highBitrate = (new X264)->setKiloBitrate(3000); // 1080p

        // Create a subfolder for the story ID to keep chunks organized
        $hlsPath = "{$this->story->id}/playlist.m3u8";

        FFMpeg::fromDisk('stories')
            ->open($this->originalFilename)
            ->exportForHLS()
            ->addFormat($lowBitrate)
            ->addFormat($midBitrate)
            ->addFormat($highBitrate)
            ->save($hlsPath);

        // Update the story record to point to the playlist
        // We store "ID/playlist.m3u8" as the image_path
        $this->story->image_path = $hlsPath;
        $this->story->save();

        // Optional: Delete original large file? 
        // For now, let's keep it or delete it. User complained about size, so deleting is good.
        // unlink(public_path('images/stories/' . $this->originalFilename));
    }
}
