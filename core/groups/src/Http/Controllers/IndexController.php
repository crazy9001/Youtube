<?php
/**
 * Created by PhpStorm.
 * User: Toinn
 * Date: 5/17/2018
 * Time: 12:01 PM
 */

namespace Youtube\Groups\Http\Controllers;

use App\Http\Controllers\Controller;
use Youtube\Groups\Repositories\Eloquent\GroupRepository;
use Youtube\Groups\Repositories\Eloquent\TagRepository;
use Assets;
use Sentinel;
use Youtube\Groups\Http\Requests\GroupRequest;

class IndexController extends Controller
{
    protected $groupRepository;

    protected $tagRepository;

    public function __construct( GroupRepository $groupRepository, TagRepository $tagRepository )
    {
        $this->groupRepository = $groupRepository;
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        return view('groups::index.index');
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
        ];
        $group = $this->groupRepository->updateOrCreate($data);

        // data tags
        $tagInputs = explode(',', $request->input('tags'));
        foreach ($tagInputs as $tagName) {
            $tag = $this->tagRepository->findWhere(['name' => $tagName])->first();
            if ($tag === null) {
                $dataTag = [
                    'name'  =>  $tagName,
                    'slug'  =>  str_slug($tagName),
                    'user_id'   =>  Sentinel::getUser()->id
                ];
                $tag = $this->tagRepository->updateOrCreate($dataTag);
            }
            $group->tags()->attach($tag->id);
        }

        if ($request->input('submit') == 'save') {
            return redirect()->route('group.index')->with('success_msg', trans('bases::notices.create_success_message'));
        }
    }
}