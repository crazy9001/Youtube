<?php
/**
 * Created by PhpStorm.
 * User: Toinn
 * Date: 6/7/2018
 * Time: 10:40 AM
 */

namespace Youtube\Videos\Http\Controllers;

use Youtube\Videos\Repositories\Eloquent\DbVideosRepository;
use Assets;

class IndexController
{
    protected $videoRepository;

    public function __construct(DbVideosRepository $videosRepository)
    {
        $this->videoRepository = $videosRepository;
    }

    public function index()
    {
        Assets::addStylesheets(['data-table']);
        Assets::addJavascript(['data-table']);

        $listVideos = $this->videoRepository->with('channel')->paginate(5);
        /*foreach($listVideos as $video){
            dd($video);
        }*/
        return view('videos::index.index', compact('listVideos'));
    }

    public function getListVideos()
    {
        $listVideos = $this->videoRepository->with('channel')->all();
        return $this->sendResponse($listVideos->toArray(), 'Successfully');
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