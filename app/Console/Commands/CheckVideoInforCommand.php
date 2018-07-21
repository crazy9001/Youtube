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
            try {
                $inforVideo = Youtube::getVideoInfo($row->video_id);
                //$inforVideo = Youtube::getVideoInfo('BHdJ6dDouRc');
                if(isset($inforVideo) && !empty($inforVideo)){
                    $status = 1;
                    if( isset($inforVideo->contentDetails->regionRestriction->blocked) && count($inforVideo->contentDetails->regionRestriction->blocked ) >= 100 ){
                        $status = 3;
                    }
                    if(isset($inforVideo->contentDetails->regionRestriction->allowed)){
                        $status = in_array('VN', $inforVideo->contentDetails->regionRestriction->allowed) ? 1 : 3;
                    }
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
                    $data['last_check'] = Carbon::now();
                }
                $data['status'] = $status;
                $video = $this->videoRepository->update($data, $row->id);
                $this->info('Check success : ' . $row->title);
            }
            catch (\Exception $e)
            {
                Log::info('CHECK FAIL VIDEO : ' . $inforVideo->id . '. Error' . $e->getMessage());
                $this->info($e->getMessage());
            }
        }
    }
}
