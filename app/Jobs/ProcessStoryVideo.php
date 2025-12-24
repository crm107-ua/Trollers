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

        // Paths
        $diskRoot = config('filesystems.disks.stories.root'); // public_path('images/stories')
        $inputPath = $diskRoot . '/' . $this->originalFilename;
        $cleanFilename = 'clean_' . $this->originalFilename;
        $cleanPath = $diskRoot . '/' . $cleanFilename;

        // 1. Sanitize: Create a temporary copy with ONLY the supported streams (Video + 1st Audio)
        // discarding the problematic 'apac' stream from iPhone 17 (Future Metadata!).
        // -map 0:v -> Map all video streams
        // -map 0:a:0 -> Map ONLY the first audio stream (usually AAC)
        // -c copy -> Stream copy (no re-encoding yet, fast)
        // -y -> Overwrite
        $cmd = "ffmpeg -y -i " . escapeshellarg($inputPath) . " -map 0:v -map 0:a:0 -c copy " . escapeshellarg($cleanPath);

        // Execute the cleaning command
        exec($cmd . ' 2>&1', $output, $returnCode);

        // If cleaning fails (e.g. no audio stream?), fall back to original
        $fileToProcess = ($returnCode === 0 && file_exists($cleanPath)) ? $cleanFilename : $this->originalFilename;

        // Create a subfolder for the story ID to keep chunks organized
        $hlsPath = "{$this->story->id}/playlist.m3u8";

        try {
            FFMpeg::fromDisk('stories')
                ->open($fileToProcess)
                ->exportForHLS()
                ->addFormat($lowBitrate)
                ->addFormat($midBitrate)
                ->addFormat($highBitrate)
                ->save($hlsPath);

            // Update the story record to point to the playlist
            $this->story->image_path = $hlsPath;
            $this->story->save();

        } finally {
            // Cleanup: Delete the temporary clean file
            if ($fileToProcess === $cleanFilename && file_exists($cleanPath)) {
                @unlink($cleanPath);
            }
        }
    }
}
