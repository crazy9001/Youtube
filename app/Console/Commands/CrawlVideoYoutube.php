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
use Youtube\Channel\Repositories\Eloquent\DbChannelRepository;
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

    protected $channelRepository;

    public function __construct(DbVideosRepository $videosRepository, GroupRepository $groupsRepository, DbChannelRepository $channelRepository)
    {
        parent::__construct();
        $this->videoRepository = $videosRepository;
        $this->groupsRepository = $groupsRepository;
        $this->channelRepository = $channelRepository;
    }

    public function handle()
    {
        $this->crawlVideoProgress();
    }

    /**
     * This function start get video with a channel
     */
    protected function crawlVideoProgress()
    {
        $listChannelId = $this->getListChannelId();
        foreach ($listChannelId as $channelId) {
            $this->crawlVideoByChannelId($channelId);
        }
    }

    /**
     * This function get list channel
     * @return array
     */
    protected function getListChannelId()
    {
        return $this->channelRepository->pluck('id_channel', 'id');
    }

    /**
     * This function in Progress crawl
     * @param $channelId
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    protected function crawlVideoByChannelId($channelId)
    {

        // create param
        $params = [
            'type' => 'video',
            'channelId' => $channelId,
            'part'  =>  'id,snippet',
            'maxResults' => 50,
            'order' => 'date'
        ];
        $videos = [];
        // search video channel
        $search = Youtube::searchAdvanced($params, true);

        // get info channel
        $inforChannel = Youtube::getChannelById($params['channelId']);

        $this->info('---------------------- CRAWLING VIDEO CHANNEL ' . $inforChannel->snippet->title . ' ----------------------');

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
            $totalGroup = [];
            foreach($groups as $key => $group){
                if(isset($group) && !empty($group)){
                    $newGroup = explode(",", $group);
                    $totalGroup[$key] = $newGroup;
                }
            }
            foreach($videosInfomation as $videoInfomation){
                // tags video
                $videoTags = isset($videoInfomation->snippet->tags) ? $videoInfomation->snippet->tags : array();
                $videoData = [
                    'video_id' => isset($videoInfomation->id) ? $videoInfomation->id : '',
                    'channelId' => isset($videoInfomation->snippet->channelId) ? $videoInfomation->snippet->channelId : '',
                    'title' => isset($videoInfomation->snippet->title) ? $videoInfomation->snippet->title : '',
                    'description' => isset($videoInfomation->snippet->description) ? $videoInfomation->snippet->description : '',
                    'thumbnails' =>  isset($videoInfomation->snippet->thumbnails->high->url) ? $videoInfomation->snippet->thumbnails->high->url : '',
                    'published_at' => isset($videoInfomation->snippet->publishedAt) ? $videoInfomation->snippet->publishedAt : '',
                    'tags' => isset($videoInfomation->snippet->tags) ? json_encode($videoInfomation->snippet->tags) : '',
                    'category_id' => isset($videoInfomation->snippet->categoryId) ? $videoInfomation->snippet->categoryId : '',
                    'status' => 1,
                    'display' => 1,
                    'note' => '',
                    'embed_html' => isset($videoInfomation->player->embedHtml) ? $videoInfomation->player->embedHtml : '',
                    'group_id' =>  isset($videoTags) && !empty($videoTags) ? (Helper::searchGroupIdByValue($videoTags, $totalGroup) != "" ? Helper::searchGroupIdByValue($videoTags, $totalGroup) : 1) : 1, // insert video into group after compare tags
                    'views' =>  isset($videoInfomation->statistics->viewCount) ? $videoInfomation->statistics->viewCount : 0,
                    'like_count' =>  isset($videoInfomation->statistics->likeCount) ? $videoInfomation->statistics->likeCount : 0,
                    'dislike_count' =>  isset($videoInfomation->statistics->dislikeCount) ? $videoInfomation->statistics->dislikeCount : 0,
                ];
                $findVideo = $this->videoRepository->findWhere(['video_id' => $videoInfomation->id]);

                if($findVideo->isEmpty()){
                    $this->info($videoData['title']);
                    $this->videoRepository->create($videoData);
                }

            }
        }
        // update last update channel
        $dataChannel['last_update'] = Carbon::now();
        $channel = $this->channelRepository->findWhere(['id_channel' => $inforChannel->id])->first();
        $this->channelRepository->update($dataChannel, $channel->id);

    }

}