<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/16/2018
 * Time: 8:26 PM
 */

namespace Youtube\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard::index.index');
    }
}