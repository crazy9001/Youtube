<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/11/2018
 * Time: 7:07 PM
 */

namespace Youtube\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Permission;
use App;

class DashboardController extends Controller
{
    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Toinn
     */
    public function getDashboard()
    {
        if (Permission::isSuperAdmin() || Permission::isSystemAdmin()) {
            return $superAdmin = App::make('Youtube\Dashboard\Http\Controllers\SuperAdminController')->index();
        }elseif (Permission::isUser()) {
            return $registeredUser = App::make('Youtube\Dashboard\Http\Controllers\RegisteredUsersController')->index();
        }
    }

}