<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 9/4/2018
 * Time: 9:21 PM
 */

namespace App\Http\Controllers\FrontEnd;
use Illuminate\Support\Facades\Input;
use Youtube\Groups\Repositories\Eloquent\GroupRepository;
use Youtube\Videos\Repositories\Eloquent\DbVideosRepository;

class HomeController extends BaseController
{
    protected $groupRepository;
    protected $videoRepository;

    public function __construct(GroupRepository $groupRepository, DbVideosRepository $videosRepository)
    {
        parent::__construct();
        $this->groupRepository = $groupRepository;
        $this->videoRepository = $videosRepository;
    }

    public function index()
    {

        $groups = $this->groupRepository->getGroups()->get();
        return view('layout.FronHome', compact('groups'));
    }

    public function viewVideo()
    {
        $video_id = Input::get('v');
        $video = $this->videoRepository->findWhere(['video_id'=> $video_id])->first();
        if(isset($video) && !is_null($video)){
            return view('layout.partials.viewVideo', compact('video'));
        }
        abort('404');
    }

}