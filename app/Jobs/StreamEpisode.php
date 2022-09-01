<?php

namespace App\Jobs;

use App\Models\Episode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use FFMpeg\Format\Video\X264;
use FFMpeg;
// use Pbmedia\LaravelFFMpeg\FFMpegFacade;

class StreamEpisode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $episode;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Episode $episode)
    {
        $this->episode = $episode;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $lowBitrate = (new X264('aac'))->setKiloBitrate(144);
        $midBitrate = (new X264('aac'))->setKiloBitrate(360);
        $highBitrate = (new X264('aac'))->setKiloBitrate(720);

        FFMpeg::fromDisk('public')
            ->open($this->episode->path)
            ->exportForHLS()
            ->onProgress(function ($percentage) {
                $this->episode->update(['percent' => $percentage]);
            })
            ->setSegmentLength(10) // optional
            ->setKeyFrameInterval(48) // optional
            ->addFormat($lowBitrate)
            ->addFormat($midBitrate)
            ->addFormat($highBitrate)
            ->save("encoding/episodes/{$this->episode->id}/{$this->episode->id}.m3u8");
    } //-- end of function handle()
}//-- end class StreamEpisode
