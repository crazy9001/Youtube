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
use Input;

class IndexController extends Controller
{
    protected $groupRepository;


    public function __construct( GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function index()
    {
        $search = Input::get('search');
        $filters = array(
            'search' => trim($search),
        );
        $sortInfo = array();
        if (Input::has('sort') && Input::has('dir')) {
            $sortInfo['column'] = Input::get('sort');
            $sortInfo['order'] = Input::get('dir');
        }
        $groups = $this->groupRepository->getGroups($filters)->get();
        $html = $this->groupView($groups, '');
        return view('groups::index.index', compact('html'));
    }

    public function groupView($data, $string)
    {

        $html = '';

        foreach($data as $value)
        {
            $tags = $value->tags && !empty($value->tags) ? $value->tags : '';
            $display = $value->display && $value->display == 1 ? '<span class="label label-info">Hiển thị</span>' : '<span class="label label-default">Ẩn</span>';
            $html .= '<tr role="row" class="odd" id="group-1">
                        <td style="width: 10px">'. $value->id .'</td>
                        <td class="group-name">
                            '. $string . ' ' . $value->name .'
                        </td>
                        <td>'. $tags .'</td>
                        <td>'. $value->note .'</td>
                        <td>'. $display .'</td>
                        <td>
                            <input type="checkbox" data-skin="square" data-color="blue" name="groupsSelect[]" value="">
                        </td>
                    </tr>';
            if(isset($value->children) && !empty($value->children)) {
                $html .= $this->groupView($value->children, $string . '━');
            }
        }

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