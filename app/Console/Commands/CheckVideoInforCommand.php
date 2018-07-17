<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Youtube;
use Youtube\Videos\Repositories\Eloquent\DbVideosRepository;

class CheckVideoInforCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $videoRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DbVideosRepository $videosRepository)
    {
        parent::__construct();
        $this->videoRepository = $videosRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->checkVideoInfoProgress();
    }

    public function checkVideoInfoProgress()
    {
        $videos = $this->videoRepository->all();

        foreach($videos as $row)
        {
            $inforVideo = Youtube::getVideoInfo($row->video_id);
            if(!empty($inforVideo)){
                $status = ( isset($inforVideo->contentDetails->regionRestriction) && count($inforVideo->contentDetails->regionRestriction->blocked ) >= 100 ) ? 2 : 1;
            }else{
                $status = 3;
            }
            if($status == 1){
                $data['description'] = isset($inforVideo->snippet->description) ? $inforVideo->snippet->description : '';
                $data['thumbnails'] = isset($inforVideo->snippet->thumbnails->high->url) ? $inforVideo->snippet->thumbnails->high->url : '';
                $data['published_at'] = isset($inforVideo->snippet->publishedAt) ? $inforVideo->snippet->publishedAt : '';
                $data['views'] = isset($inforVideo->statistics->viewCount) ? $inforVideo->statistics->viewCount : $row->views;
                $data['like_count'] = isset($inforVideo->statistics->likeCount) ? $inforVideo->statistics->likeCount : $row->like_count;
                $data['dislike_count'] = isset($inforVideo->statistics->dislikeCount) ? $inforVideo->statistics->dislikeCount : $row->dislike_count;
            }
            $data['status'] = $status;
            $video = $this->videoRepository->update($data, $row->id);
            $this->info('Check success : ' . $row->title);
            \Log::info('Check success : ' . $row->title . ' vào lúc ' . Carbon::now());
        }
    }
}
