<?php
/**
 * Created by PhpStorm.
 * User: Toinn
 * Date: 5/17/2018
 * Time: 12:01 PM
 */

namespace Youtube\Groups\Http\Controllers;

use App\Http\Controllers\Controller;
use Youtube\Groups\Models\Group;
use Youtube\Groups\Repositories\Eloquent\GroupRepository;
use Assets;
use Sentinel;
use Youtube\Groups\Http\Requests\GroupRequest;

class IndexController extends Controller
{
    protected $groupRepository;


    public function __construct( GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function index()
    {
        Assets::addJavascript(['nestable']);
        $groupModel = $this->groupRepository->model();
        $groups = $groupModel::nested()->get();
        $html = $this->groupView($groups);
        return view('groups::index.index', compact('html'));
        //dd($groups);
    }

    public function groupView(array $data, $class = 'dd-list')
    {
        $html = "<ol class=\"".$class."\" id=\"menu-id\">";

        foreach($data as $key=>$value) {
            $html.= '<li class="dd-item dd3-item" data-id="'.$value['id'].'" >
                    <div class="dd-handle dd3-handle">Drag</div>
                    <div class="dd3-content"><span id="label_show'.$value['id'].'">'.$value['name'].'</span> 
                        <span class="span-right">/<span id="link_show'.$value['id'].'">'.$value['slug'].'</span> &nbsp;&nbsp; 
                            <a class="edit-button" id="'.$value['id'].'" label="'.$value['name'].'" link="'.$value['slug'].'" ><i class="fa fa-pencil"></i></a>
                            <a class="del-button" id="'.$value['id'].'"><i class="fa fa-trash"></i></a></span> 
                    </div>';
            if(array_key_exists('child',$value)) {
                $html .= $this->groupView($value['child'],'child');
            }
            $html .= "</li>";
        }
        $html .= "</ol>";

        return $html;
    }

    public function childView($group){

        $html = '<ul>';

        foreach ($group->childs as $arr) {
            if(count($arr->childs)){
                $html .= '<li class="tree-view closed"><a class="tree-name">' . $arr->name . '</a>';
                $html.= $this->childView($arr);
            }else{
                $html .= '<li class="tree-view"><a class="tree-name">' . $arr->name . '</a>';
                $html .= '</li>';
            }

        }

        $html .="</ul>";
        return $html;
    }

    public function create()
    {
        Assets::addStylesheets(['tagsinput']);
        Assets::addJavascript(['tagsinput']);
        $groups = $this->groupRepository->pluck('name', 'id')->toArray();
        $groups[0] = 'Nhóm cha';
        $groups = array_sort_recursive($groups);
        return view('groups::index.create', compact('groups'));
    }

    public function store(GroupRequest $request)
    {
        // data group
        $data = [
            'name'  => $request->name,
            'slug'  =>  str_slug($request->name),
            'user_id' => Sentinel::getUser()->id,
            'parent_id' => $request->parent_id,
            'note'  =>  $request->note,
            'icon'  =>  $request->icon,
            'tags'  =>  $request->tags,
        ];
        $this->groupRepository->updateOrCreate($data);


        if ($request->input('submit') == 'save') {
            return redirect()->route('group.index')->with('success_msg', trans('bases::notices.create_success_message'));
        }
    }
}