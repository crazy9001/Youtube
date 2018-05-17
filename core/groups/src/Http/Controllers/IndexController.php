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
use Assets;

class IndexController extends Controller
{
    protected $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function index()
    {

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

    public function store()
    {

    }
}