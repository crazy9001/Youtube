<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/16/2018
 * Time: 6:54 PM
 */

namespace Youtube\Users\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Youtube\Users\Models\Users;
use DB;
use Sentinel;
use Session;

class DbUsersRepository extends BaseRepository
{

    /**
     * @return string
     */
    function model()
    {
        return Users::class;
    }

    /**
     * This function will be used to user Details in  session.
     *
     * @param void
     * @return void
     */
    public function setUserDetailInSession()
    {
        //By default it will provide with the logged in user detail
        $userDetail = $this->getUserDetail();
        if (!empty($userDetail->roles)) {
            $userDetail->roles = explode(',', $userDetail->roles);
        }
        Session::put('userDetail', $userDetail);
    }

    /**
     * This function will be used to get user details.
     *
     * @param int $userId
     * @return array $userDetail
     */
    public function getUserDetail($userId = 0)
    {
        if (!$userId) {
            $userId = Sentinel::getUser()->id;
        }
        $userDetail = DB::table('users')
            ->leftJoin('role_users as usrRoles', 'usrRoles.user_id', '=', 'users.id')
            ->leftJoin('roles', 'roles.id', '=', 'usrRoles.role_id')
            ->select('users.email', 'users.last_login', DB::raw('group_concat(distinct roles.slug) as roles'), 'roles.id as role_id', DB::raw('CONCAT(users.first_name, " ", users.last_name) AS full_name'))
            ->where('users.id', $userId)
            ->groupBy('users.id')
            ->first();
        return $userDetail;
    }

}