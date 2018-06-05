<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/16/2018
 * Time: 7:35 PM
 */

namespace App\Helpers;

use Session;
use Sentinel;
use Youtube\Users\Repositories\Eloquent\DbUsersRepository;
use Youtube;

class BasicHelper
{


    /**
     * This function will return logged in user details from session(if not
     * present in session than from database and set values into session also).
     *
     * @param void
     * @return array $userDetials
     */
    public static function getUserDetails()
    {

        $userDetail = array();
        //checking user values in session
        if (Sentinel::check() && (!Session::has('userDetail') || empty(Session::get('userDetail')) )) {
            //setting user details in session
            $userRepo = new DbUsersRepository();
            $userRepo->setUserDetailInSession();
        }

        if (Session::has('userDetail')) {
            $userDetail = Session::get('userDetail');
        }


        return $userDetail;
    }

    /**
     * This function will be used for getting current user roles name.
     *
     * @param array $data
     * @return role name
     */
    public static function getCurrentUserRoleName()
    {
        $roles = Sentinel::getUser()->roles->toArray();
        if (isset($roles) && count($roles) > 0) {
            return $roles[0]['name'];
        } else {
            return 0;
        }
    }

    /**
     * This function will be used for getting current user roles.
     *
     * @param array $data
     * @return array $data
     * @author Toinn
     */
    public static function getCurrentUserRole()
    {
        $roles = [];

        if (Sentinel::check()) {
            $roles = Sentinel::getUser()
                ->roles
                ->toArray();
        }

        return $roles;
    }

    /**
     * @param $params
     * @param $data
     * @param bool $next
     * @param array $arr
     * @return array
     */
    public static function getDataYoutube($params, $data, $arr = array() )
    {
        if (!$arr) {
            $arr = array();
        }
        $arr[] = $data['results'];
        if($data['info']['nextPageToken'] != null){
            $params['pageToken'] = $data['info']['nextPageToken'];
            $dataVideo = Youtube::searchAdvanced($params, true);
            $arr = self::getDataYoutube($params, $dataVideo, $arr);
        }else {
            return $arr = $data['results'];
        }
        return $arr;
    }

//    public static function getDataYoutube($params, $data, $next = true, $arr = array() )
//    {
//        if (!$arr) {
//            $arr = array();
//        }
//        $arr[] = $data['results'];
//        $params['pageToken'] = $data['info']['nextPageToken'];
//        while ($next) {
//            $dataVideo = Youtube::searchAdvanced($params, true);
//            $params['pageToken'] = $dataVideo['info']['nextPageToken'];
//            $next = $dataVideo['info']['nextPageToken'] != null ? true : false;
//            print_r($next);
//            $arr[]= $dataVideo['results'];
//            //$arr = self::getDataYoutube($params, $dataVideo, $next, $arr);
//        }
//        print_r($arr);
//        /// co muon lam them de quy khong =))
//        /// the cau de quy nhin cho no nguy hiem
//        return $arr;
//
//    }

}