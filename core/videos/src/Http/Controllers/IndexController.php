<?php
/**
 * Created by PhpStorm.
 * User: Toinn
 * Date: 6/7/2018
 * Time: 10:40 AM
 */

namespace Youtube\Videos\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Youtube\Videos\Models\Video;
use Youtube\Videos\Repositories\Eloquent\DbVideosRepository;
use Youtube\Channel\Repositories\Eloquent\DbChannelRepository;
use Assets;
use DataTables;
use Helper;
use Youtube;

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
            '2' =>  'Bị chặn quốc gia',
            '3' =>  'Chết'
        ];
        $search = Input::get('search');
        $channel = Input::get('channel');
        $status = Input::get('status');
        $display = Input::get('display');
        $search_type = Input::get('search_type');
        $filters = array(
            'channel' => trim($channel),
            'status' => trim($status),
            'display' => trim($display),
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
        $countTotalVideo = $this->videoRepository->all()->count();
        $countBlock = $this->videoRepository->findWhere(['status' => '2'])->count();
        $countDie = $this->videoRepository->findWhere(['status' => '3'])->count();
        return view('videos::index.index', compact('pagination', 'columns', 'videos', 'channels', 'statuss', 'filters', 'countBlock', 'countDie', 'countTotalVideo'));
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
            'checkbox'  =>  '<input type="checkbox" data-skin="square" data-color="blue" id="select_all_video">',
            'id'    =>  'ID'
        );
        return Helper::getSortableColumnOnArray($columns);
    }

    public function checkVideo(Request $request)
    {
        $videoId = $request->only('video');
        $videoLocal = $this->videoRepository->findWhere(['video_id' => $videoId['video']])->first();
        if(isset($videoLocal) && !empty($videoLocal)){
            try{
                $inforVideo = Youtube::getVideoInfo($videoLocal->video_id);
                if(isset($inforVideo) && !empty($inforVideo)){
                    $status = 1;
                    if( isset($inforVideo->contentDetails->regionRestriction->blocked) && count($inforVideo->contentDetails->regionRestriction->blocked ) >= 100 ){
                        $status = 3;
                    }
                    if(isset($inforVideo->contentDetails->regionRestriction->allowed)){
                        $status = in_array('VN', $inforVideo->contentDetails->regionRestriction->allowed) ? 1 : 3;
                    }
                }else{
                    $status = 3;
                }
                $data['status'] = $status;
                $data['updated_at'] = Carbon::now();
                $video = $this->videoRepository->update($data, $videoLocal->id);
                return $this->sendResponse($video->toArray(), 'Successfully');
            }
            catch (\Exception $e) {
                return $this->sendError('Error.', $e->getMessage());
            }
        }
        return $this->sendError('Error.', 'Video không tồn tại hoặc đã bị xóa');

    }


    public function deleteVideo(Request $request)
    {
        $videoId = $request->only('video');
        $videoLocal = $this->videoRepository->findWhere(['video_id' => $videoId['video']])->first();
        if(isset($videoLocal) && !empty($videoLocal)){
            try{
                return $videoLocal->delete();

            }catch (\Exception $e)
            {
                return $this->sendError('Error.', $e->getMessage());
            }
        }
        return $this->sendError('Error.', 'Video không tồn tại hoặc đã bị xóa');
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