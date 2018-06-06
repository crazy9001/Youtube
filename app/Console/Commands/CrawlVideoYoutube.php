<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/18/2018
 * Time: 6:27 PM
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Youtube;
use Youtube\Videos\Repositories\Eloquent\DbVideosRepository;
use Youtube\Groups\Repositories\Eloquent\GroupRepository;
use Helper;

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
        // create param
        $params = [
            'type' => 'video',
            'channelId' => 'UCDGv4buAgQMq03Qxa6aW1lQ',/*UCDGv4buAgQMq03Qxa6aW1lQ*/
            'part'  =>  'id,snippet',
            'maxResults' => 50,
            'order' => 'date'
        ];
        $videos = [];
        // search video channel
        $search = Youtube::searchAdvanced($params, true);

        // get info channel
        $inforChannel = Youtube::getChannelById($params['channelId']);
        $this->info('Crawling video channel : ' . $inforChannel->snippet->title);

        // merge videos
        $videos = array_merge($videos, $search['results']);

        // check next page
        if(isset($search['info']['nextPageToken'])){
            while (isset($search['info']['nextPageToken'])){
                $params['pageToken'] = $search['info']['nextPageToken'];
                $search = Youtube::searchAdvanced($params, true);
                if($search['results'] != null){
                    // merge videos
                    $videos = array_merge($videos, $search['results']);
                }
            }
        }
        $arrayIds = [];

        // create list video id
        foreach($videos as $video){
            $arrayIds[] = $video->id->videoId;
        }

        // chunk id video  - api max 50 video
        $chunkIds = (array_chunk($arrayIds,50));

        foreach($chunkIds as $key => $value){
            // get info 50 video
            $videosInfomation = Youtube::getVideoInfo($value);

            // get group by tag
            $groups = $this->groupsRepository->pluck('tags', 'id')->all();
            foreach($videosInfomation as $videoInfomation){
                // tags video
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
                    'group_id' =>  !empty(key(array_intersect($groups, $videoTags))) ? key(array_intersect($groups, $videoTags)) : 0 // insert video into group after compare tags
                ];
                $findVideo = $this->videoRepository->findWhere(['video_id' => $videoInfomation->id]);

                $this->info($videoData['title']);

                if($findVideo->isEmpty()){
                    $this->videoRepository->create($videoData);
                }else{
                    $this->videoRepository->update($videoData, $findVideo->first()->id);
                }

            }
        }

    }

}