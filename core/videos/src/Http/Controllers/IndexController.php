<?php
/**
 * Created by PhpStorm.
 * User: Toinn
 * Date: 6/7/2018
 * Time: 10:40 AM
 */

namespace Youtube\Videos\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Youtube\Videos\Models\Video;
use Youtube\Videos\Repositories\Eloquent\DbVideosRepository;
use Youtube\Channel\Repositories\Eloquent\DbChannelRepository;
use Assets;
use DataTables;
use Request;
use Helper;

class IndexController
{
    protected $videoRepository;
    protected $channelRepository;

    public function __construct(DbVideosRepository $videosRepository, DbChannelRepository $channelRepository)
    {
        $this->videoRepository = $videosRepository;
        $this->channelRepository = $channelRepository;
    }

    public function index()
    {
        Assets::removeJavascript(['eakroko']);
        Assets::addStylesheets(['table-videos']);
        $channels = $this->channelRepository->pluck( 'name', 'id_channel')->toArray();
        $statuss = [
            '1' =>  'Hoạt động',
            '2' =>  'Block',
            '3' =>  'Chết'
        ];
        $search = Input::get('search');
        $channel = Input::get('channel');
        $status = Input::get('status');
        $search_type = Input::get('search_type');
        $filters = array(
            'channel' => trim($channel),
            'status' => trim($status),
            'search' => trim($search),
            'search_type'   =>  trim($search_type)
        );
        $sortInfo = array();
        if (Input::has('sort') && Input::has('dir')) {
            $sortInfo['column'] = Input::get('sort');
            $sortInfo['order'] = Input::get('dir');
        }
        $result = $this->videoRepository->getVideos($filters, $sortInfo);
        $pagination = $result->paginate('50')->appends($filters + $sortInfo)->render("pagination::default");
        $videos = $result->get();
        $columns = $this->getSortableColumn();
        $countBlock = $this->videoRepository->findWhere(['status' => '2'])->count();
        $countDie = $this->videoRepository->findWhere(['status' => '3'])->count();
        return view('videos::index.index', compact('pagination', 'columns', 'videos', 'channels', 'statuss', 'filters', 'countBlock', 'countDie'));
    }


    /**
     * @return mixed
     */
    public function getSortableColumn()
    {
        $columns = array(
            'stt' => 'STT',
            'thumbnails' => 'Ảnh',
            'title' => 'Tiêu đề',
            'video_id' => 'Unique ID',
            'group_name' => 'Nhóm',
            'channel_name' => 'Kênh',
            'updated_at' => 'Last check',
            'note' => 'Ghi chú',
            'status'    =>  'Status',
            'display'   =>  'Display',
            'checkbox'  =>  '<input type="checkbox" data-skin="square" data-color="blue">',
            'id'    =>  'ID'
        );
        return Helper::getSortableColumnOnArray($columns);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

}