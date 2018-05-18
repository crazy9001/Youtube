<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/18/2018
 * Time: 6:27 PM
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Youtube;
use Youtube\Videos\Repositories\Eloquent\DbVideosRepository;
use Youtube\Groups\Repositories\Eloquent\TagRepository;

class CrawlVideoYoutube extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will start crawl video from Youtube';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $videoRepository;

    protected $tagRepository;

    public function __construct(DbVideosRepository $videosRepository, TagRepository $tagRepository)
    {
        parent::__construct();
        $this->videoRepository = $videosRepository;
        $this->tagRepository = $tagRepository;
    }

    public function handle()
    {
        $listVideosChannel = Youtube::listChannelVideos('UCsFZL2A9RZTVI5v7h5gYbPQ');
        foreach($listVideosChannel as $video){
            //dd($video->id->videoId);
            $videoInfomation = Youtube::getVideoInfo($video->id->videoId);
           // dd($videoInfomation);
            if($videoInfomation != false){
                $video = [
                    'video_id' => $videoInfomation->id,
                    'title' => $videoInfomation->snippet->title,
                    'description' => $videoInfomation->snippet->description,
                    'thumbnails' =>  $videoInfomation->snippet->thumbnails->standard->url,
                    'published_at' => $videoInfomation->snippet->publishedAt,
                    'tags' => json_encode($videoInfomation->snippet->tags),
                    'category_id' => $videoInfomation->snippet->categoryId,
                    'embed_html' => $videoInfomation->player->embedHtml
                ];
                $video = $this->videoRepository->updateOrCreate($video);
                dd(json_decode($video->tags));
            }
        }
        //dd($videos);
        //$this->videoRepository->updateOrCreate($videos);

    }

}