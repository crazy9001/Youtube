<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 9/4/2018
 * Time: 9:21 PM
 */

namespace App\Http\Controllers\FrontEnd;
use Youtube\Groups\Repositories\Eloquent\GroupRepository;

class HomeController extends BaseController
{
    protected $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        parent::__construct();
        $this->groupRepository = $groupRepository;
    }

    public function index()
    {
        $groups = $this->groupRepository->getGroups()->get();
        return view('layout.FronHome', compact('groups'));
    }

}