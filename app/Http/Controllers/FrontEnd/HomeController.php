<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 9/4/2018
 * Time: 9:21 PM
 */

namespace App\Http\Controllers\FrontEnd;

class HomeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('layout.FronHome');
    }

}