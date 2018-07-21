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

    /**
     * @return $this
     */
    public function withTrashed() {
        $this->model = $this->model->withTrashed();
        return $this;
    }

    /**
     * @return $this
     */
    public function onlyTrashed() {
        $this->model = $this->model->onlyTrashed();
        return $this;
    }

    public function getVideos($filters = array(), $sortInfo = array())
    {
        $query = DB::table('videos')
                ->join('channels', 'channels.id_channel', '=', 'videos.channelId')
                ->join('groups', 'groups.id', '=', 'videos.group_id')
                ->select('videos.*', 'channels.name as channel_name', 'groups.name as group_name')
                ->where(function($que) use ( $filters ){
                    $que->where('videos.deleted_at', '=', null);
                    if (isset($filters['channel']) && !empty($filters['channel'])) {
                        $que->where('videos.channelId', $filters['channel']);
                    }
                    if (isset($filters['status']) && !empty($filters['status'])) {
                        $que->where('videos.status', $filters['status']);
                    }
                    if (isset($filters['display']) && !empty($filters['display'])) {
                        $que->where('videos.display', $filters['display']);
                    }
                    $que->Where(function($que) use ( $filters ) {
                        if (isset($filters['search']) && !empty($filters['search'] && isset($filters['search_type']) && !empty($filters['search_type']))) {
                            if($filters['search_type'] == 'video_title'){
                                $que->orWhere('videos.title', 'like', '%' . trim($filters['search']) . '%');
                            }
                            elseif($filters['search_type'] == 'uniq_id'){
                                $que->orWhere('videos.video_id', '=', trim($filters['search']));
                            }
                        }
                    });
                })
                ->orderBy((isset($sortInfo['column']) && !empty($sortInfo['column'])) ? $sortInfo['column'] : 'videos.id', (isset($sortInfo['order']) && !empty($sortInfo['order'])) ? $sortInfo['order'] : 'asc' );;
        return $query;
    }
}