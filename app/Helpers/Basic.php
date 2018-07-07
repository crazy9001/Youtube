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
use Illuminate\Support\Facades\Input;

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

    public static function getSortableColumnOnArray($array, $prefix = '')
    {
        $queryString = self::getQueryString($prefix);
        foreach ($array as $key => $value) {
            $array[$key] = self::getSortableColumn($key, $value, $queryString, $prefix);
        }
        return $array;
    }

    /**
     * Function to get query string
     *
     * @return string
     */
    public static function getQueryString($prefix = '')
    {
        // Temp array
        $arr = array();
        // Array to ignore the parameters from the query string
        $ignore = array('page', 'dir', 'sort', $prefix . 'page', $prefix . 'sort', $prefix . 'dir');

        // Get the desired array
        foreach (Input::all() as $key => $value) {
            if (!in_array($key, $ignore)) {
                $arr[] = $key . "=" . $value;
            }
        }

        // If the query string is present if not present
        if (count($arr) > 0) {
            return implode("&", $arr);
        } else {
            return "";
        }
    }

    /**
     * Function to get sortable column
     *
     * @param type $column
     * @param type $displayName
     * @return string
     */
    public static function getSortableColumn($column, $displayName, $queryString, $prefix = '')
    {
        $sort = Input::get($prefix . 'sort');
        $dir = strtolower(Input::get($prefix . 'dir'));
        $nextDir = 'asc';
        $arrow = '';
        if (strcasecmp($sort, $column) == 0) {
            switch ($dir) {
                case 'asc':
                    $arrow = '<span class="glyphicon glyphicon-arrow-up" style="margin-left: 3px"></span>';
                    $nextDir = 'desc';
                    break;
                case 'desc':
                    $arrow = '<span class="glyphicon glyphicon-arrow-down" style="margin-left: 3px"></span>';
                    $nextDir = 'asc';
                    break;
            }
        }

        $button = '<a href="?' . (empty($queryString) ? '' : $queryString . '&') . $prefix . 'sort=' . $column . '&' . $prefix . 'dir=' . $nextDir . '">' . $displayName . $arrow . '</a>';
        return $button;
    }

}