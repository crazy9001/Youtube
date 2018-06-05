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

        $params = [
            'type' => 'video',
            'channelId' => 'UC0jDoh3tVXCaqJ6oTve8ebA',
            'part'  =>  'id,snippet',
            'maxResults' => 50,
            'order' => 'date'
        ];
        $search = Youtube::searchAdvanced($params, true);


        if (isset($search['info']['nextPageToken'])) {
            $params['pageToken'] = $search['info']['nextPageToken'];
            $search = Youtube::searchAdvanced($params, true);
        }

        print_r(($search));

        //dd($search);

        //$listVideosChannel = Youtube::listChannelVideos('UC0jDoh3tVXCaqJ6oTve8ebA', 50, 'date', ['id', 'snippet']);
        /*$arrayIds = [];
        foreach($search as $video){
            $arrayIds[] = $video->id->videoId;
        }
        $videosInfomation = Youtube::getVideoInfo($arrayIds);
        $groups = $this->groupsRepository->pluck('tags', 'id')->all();
        foreach($videosInfomation as $videoInfomation){
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
            $findVideo = $this->videoRepository->findWhere(['video_id' => $videoInfomation->id]);
            if($findVideo->isEmpty()){
                $this->videoRepository->create($videoData);
            }else{
                $this->videoRepository->update($videoData, $findVideo->first()->id);
            }

        }*/

    }

}