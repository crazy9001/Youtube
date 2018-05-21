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
use Youtube\Groups\Repositories\Eloquent\GroupRepository;

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

    protected $groupsRepository;

    public function __construct(DbVideosRepository $videosRepository, GroupRepository $groupsRepository)
    {
        parent::__construct();
        $this->videoRepository = $videosRepository;
        $this->groupsRepository = $groupsRepository;
    }

    public function handle()
    {
        $listVideosChannel = Youtube::listChannelVideos('UClyA28-01x4z60eWQ2kiNbA', 50);
        foreach($listVideosChannel as $video){
            $videoInfomation = Youtube::getVideoInfo($video->id->videoId);
            if($videoInfomation != false){
                $findVideo = $this->videoRepository->findWhere(['video_id' => $videoInfomation->id]);
                $groups = $this->groupsRepository->pluck('tags', 'id')->all();
                $videoTags = isset($videoInfomation->snippet->tags) ? $videoInfomation->snippet->tags : array();
                $videoData = [
                    'video_id' => isset($videoInfomation->id) ? $videoInfomation->id : '',
                    'title' => isset($videoInfomation->snippet->title) ? $videoInfomation->snippet->title : '',
                    'description' => isset($videoInfomation->snippet->description) ? $videoInfomation->snippet->description : '',
                    'thumbnails' =>  isset($videoInfomation->snippet->thumbnails->high->url) ? $videoInfomation->snippet->thumbnails->high->url : '',
                    'published_at' => isset($videoInfomation->snippet->publishedAt) ? $videoInfomation->snippet->publishedAt : '',
                    'tags' => isset($videoInfomation->snippet->tags) ? json_encode($videoInfomation->snippet->tags) : '',
                    'category_id' => isset($videoInfomation->snippet->categoryId) ? $videoInfomation->snippet->categoryId : '',
                    'embed_html' => isset($videoInfomation->player->embedHtml) ? $videoInfomation->player->embedHtml : '',
                    'group_id' =>  !empty(key(array_intersect($groups, $videoTags))) ? key(array_intersect($groups, $videoTags)) : 0
                ];
                if($findVideo->isEmpty()){
                    $this->videoRepository->create($videoData);
                }else{
                    $this->videoRepository->update($videoData, $findVideo->first()->id);
                }
            }
        }
    }

}