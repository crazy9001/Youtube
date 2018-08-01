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
use Youtube\Groups\Repositories\Eloquent\GroupRepository;
use Assets;
use DataTables;
use Helper;
use Youtube;
use Youtube\Groups\Models\Group;
use Youtube\Videos\Http\Requests\VideoUpdateRequest;
use Validator;

class IndexController
{
    protected $videoRepository;
    protected $channelRepository;
    protected $groupRepository;

    /**
     * IndexController constructor.
     * @param DbVideosRepository $videosRepository
     * @param DbChannelRepository $channelRepository
     */
    public function __construct(DbVideosRepository $videosRepository, DbChannelRepository $channelRepository, GroupRepository $groupRepository)
    {
        $this->videoRepository = $videosRepository;
        $this->channelRepository = $channelRepository;
        $this->groupRepository = $groupRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $groupsNested = Group::attr(['name' => 'move_to_group', 'class' => 'inline smaller-select'])
                        ->selected(1)
                        ->renderAsDropdown();
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
        $group = Input::get('group');
        $search_type = Input::get('search_type');
        $filters = array(
            'channel' => trim($channel),
            'status' => trim($status),
            'display' => trim($display),
            'group' => trim($group),
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
        return view('videos::index.index', compact('pagination', 'columns', 'videos', 'channels', 'statuss', 'filters', 'countBlock', 'countDie', 'countTotalVideo', 'groupsNested'));
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
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
                $data['last_check'] = Carbon::now();
                $video = $this->videoRepository->update($data, $videoLocal->id);
                return $this->sendResponse($video->toArray(), 'Successfully');
            }
            catch (\Exception $e) {
                return $this->sendError('Error.', $e->getMessage());
            }
        }
        return $this->sendError('Error.', 'Video không tồn tại hoặc đã bị xóa');

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
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

    public function movieVideoToGroup(Request $request)
    {
        $data = $request->only('video', 'group');
        $videoLocal = $this->videoRepository->findWhere(['video_id' => $data['video']])->first();
        try{
            if(isset($videoLocal) && !empty($videoLocal)){
                $newData['group_id'] = $data['group'];
                $video = $this->videoRepository->update($newData, $videoLocal->id);
                return $this->sendResponse($video->toArray(), 'Successfully');
            }
            return $this->sendError('Error.', 'Video không tồn tại hoặc đã bị xóa');
        }
        catch (\Exception $e)
        {
            return $this->sendError('Error.', $e->getMessage());
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

    public function edit($id){

        Assets::removeJavascript(['eakroko']);
        Assets::addJavascript(['ck-editor']);
        $groupsNested = Group::attr(['name' => 'group_video', 'class' => 'inline smaller-select group_video'])
            ->selected(1)
            ->renderAsDropdown();
        $video = $this->videoRepository->findWhere(['video_id' => $id])->first();
        if($video){
            $inforVideo = Youtube::getVideoInfo($video->video_id);
            //dd($inforVideo);
            return view('videos::index.create', compact('video', 'groupsNested', 'inforVideo'));
        }
        return redirect()->route('video.index')->with('error_msg', 'Video không tồn tại hoặc đã bị xóa')->withInput();
    }

    public function update(VideoUpdateRequest $request)
    {
        if($request->submit == 'Apply'){
            $newData = [
                'title' => $request->video_title,
                'description' => $request->description,
                'embed_code' => $request->embed_code,
                'note'  =>  $request->note,
                'group_id'  =>  $request->group_video,
                'display'   =>  $request->display
            ];
            $video = $this->videoRepository->update($newData, $request->id);
            return redirect()->route('video.edit', $video->video_id)->with('success_msg', trans('bases::notices.update_success_message'));
        }elseif($request->submit == 'Delete'){
            $videoId = $request->unique_id;
            $video = $this->videoRepository->findWhere(['video_id' => $videoId])->first();
            if(isset($video) && !empty($video)){
                $video->delete();
                return redirect()->route('video.index')->with('success_msg', trans('bases::notices.delete_success_message'));
            }
            return $this->sendError('Error.', 'Video không tồn tại hoặc đã bị xóa');
        }elseif($request->submit == 'Save'){
            $newData = [
                'title' => $request->video_title,
                'description' => $request->description,
                'embed_code' => $request->embed_code,
                'note'  =>  $request->note,
                'group_id'  =>  $request->group_video,
                'display'   =>  $request->display
            ];
            $video = $this->videoRepository->update($newData, $request->id);
            return redirect()->route('video.index')->with('success_msg', trans('bases::notices.update_success_message'));
        }
    }

    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'link' => 'required',
            'channel'   =>'required|exists:channels,id_channel'
        ],[
            'link.required' => 'Vui lòng nhập link video',
            'channel.required' => 'Vui lòng chọn kênh cho video',
            'channel.exists'    =>  'Kênh không tồn tại'
        ]);
        if($validator->fails()){
            return $this->sendError('Error.', $validator->errors()->first(), 422);
        }
        parse_str( parse_url( $request->link, PHP_URL_QUERY ), $my_array_of_vars );
        $idVideo =  $my_array_of_vars['v'];
        try{
            $groups = $this->groupRepository->pluck('tags', 'id')->all();
            $totalGroup = [];
            foreach($groups as $key => $group){
                if(isset($group) && !empty($group)){
                    $newGroup = explode(",", $group);
                    $totalGroup[$key] = $newGroup;
                }
            }
            $videoInfomation = Youtube::getVideoInfo($idVideo);
            if($videoInfomation){
                $videoData = [
                    'video_id' => isset($videoInfomation->id) ? $videoInfomation->id : '',
                    'channelId' => isset($request->channel) ? $request->channel : '',
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
                    'last_check'    =>  \Carbon\Carbon::now()
                ];
                $findVideo = $this->videoRepository->withTrashed()->findWhere(['video_id' => $videoInfomation->id]);
                if($findVideo->isEmpty()){
                    $video = $this->videoRepository->create($videoData);
                    return $this->sendResponse($video->toArray(), 'Thêm mới video thành công', 200);
                }
                return $this->sendError('Error.', 'Video đã tồn tại', 400);
            }
            return $this->sendError('Error.', 'Video không chính xác. Vui lòng kiểm tra lại', 404);
        }
        catch (\Exception $e){
            return $this->sendError('Error.', $e->getMessage(), 400);
        }
    }

}