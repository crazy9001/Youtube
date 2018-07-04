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
        Assets::addStylesheets(['data-table']);
        Assets::addJavascript(['data-table']);

        $channels = $this->channelRepository->pluck( 'name', 'id_channel')->toArray();
        $status = [
            '1' =>  'Hoạt động',
            '0' =>  'Block',
        ];

        return view('videos::index.index', compact('channels', 'status'));
    }

    public function getListVideos()
    {
        $channel = Input::get('channel');
        $status = Input::get('status');
        if(!isset($channel) && !isset($status)){
            $listVideos = $this->videoRepository->with(['group', 'channel'])->get();
            return Datatables::of($listVideos)->make(true);
        }
        if($channel == 0 && $status == 0){
            $listVideos = $this->videoRepository->with(['group', 'channel'])->findWhere([ 'status'  =>  0]);
            return Datatables::of($listVideos)->make(true);
        }
        if($channel == 0 && $status == 1){
            $listVideos = $this->videoRepository->with(['group', 'channel'])->findWhere([ 'status'  =>  1]);
            return Datatables::of($listVideos)->make(true);
        }
        $listVideos = $this->videoRepository->with(['group', 'channel'])->findWhere(['channelId' => $channel, 'status'  =>  $status]);
        return Datatables::of($listVideos)->make(true);
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