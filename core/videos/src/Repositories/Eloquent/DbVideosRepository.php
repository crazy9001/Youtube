<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/18/2018
 * Time: 7:02 PM
 */

namespace Youtube\Videos\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Youtube\Videos\Models\Video;
use DB;

class DbVideosRepository extends BaseRepository
{
    /**
     * @return string
     */
    function model()
    {
        return Video::class;
    }

    public function getVideos($filters = array(), $sortInfo = array())
    {
        $query = DB::table('videos')
                ->rightjoin('channels', 'channels.id_channel', '=', 'videos.channelId')
                ->leftjoin('groups', 'groups.id', '=', 'videos.group_id')
                ->select('videos.*', 'channels.name as channel_name', 'groups.name as group_name')
                ->where(function($que) use ( $filters ){
                    if (isset($filters['channel']) && !empty($filters['channel'])) {
                        $que->where('videos.channelId', $filters['channel']);
                    }
                    if (isset($filters['status']) && !empty($filters['status'])) {
                        $que->where('videos.status', $filters['status']);
                    }
                    $que->Where(function($que) use ( $filters ) {
                        if (isset($filters['search']) && !empty($filters['search'])) {
                            $que->orWhere('videos.title', 'like', '%' . trim($filters['search']) . '%');
                            $que->orWhere('videos.channelId', 'like', '%' . trim($filters['search']) . '%');
                            $que->orWhere('videos.thumbnails', 'like', '%' . trim($filters['search']) . '%');
                            $que->orWhere('groups.name', 'like', '%' . trim($filters['search']) . '%');
                            $que->orWhere('channels.name', 'like', '%' . trim($filters['search']) . '%');
                        }
                    });
                })
                ->orderBy((isset($sortInfo['column']) && !empty($sortInfo['column'])) ? $sortInfo['column'] : 'videos.id', (isset($sortInfo['order']) && !empty($sortInfo['order'])) ? $sortInfo['order'] : 'asc' );;
        return $query;
    }
}