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
        /*$channels["0"] = 'Tìm kiếm video theo tên kênh';
        $channels = array_sort_recursive($channels);
        dd($channels);*/
        //dd($channel);

        return view('videos::index.index', compact('channels'));
    }

    public function getListVideos()
    {
        if(Input::get('channel')){
            $listVideos = $this->videoRepository->findWhere(['channelId' => Input::get('channel')]);
            return Datatables::of($listVideos)->make(true);
        }else{
            $listVideos = $this->videoRepository->get();
            return Datatables::of($listVideos)->make(true);
        }
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