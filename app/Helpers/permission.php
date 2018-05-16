<?php namespace App\Helpers;

use Sentinel;
use Helper;
use URL;
use Route;

/**
 * Menu helper class is used to manage different menu option for different user
 *
 */
class PermissionHelper
{


    /**
     * This function returns the group name of logged in user.
     *
     * @param void
     * @return string $groupName
     */
    public static function getGroupName()
    {
        $userDetails = Helper::getUserDetails();
        //Getting user roles from session
        if (is_object($userDetails) && is_array($userDetails->roles) && count($userDetails->roles)) {
            $groupAlias = $userDetails->roles;
        } else {

            //Getting user roles from database
            $groups = Helper::getCurrentUserRole();

            $groupAlias = array_map(function($group) {
                return $group['slug'];
            }, $groups);
        }

        $groupName = 'guest';

        if (is_array($groupAlias) && count($groupAlias)) {

            if (in_array('super-admin', $groupAlias)) {
                $groupName = 'super_admin';
            } elseif (in_array('system-admin', $groupAlias)) {
                $groupName = 'system_admin';
            } elseif (in_array('registered-user', $groupAlias)) {
                $groupName = 'user';
            } else {
                $groupName = 'guest';
            }
        }

        return $groupName;
    }

    /**
     * This function is used to know user group.
     *
     * @param void
     * @return boolean
     */
    public static function isSuperAdmin()
    {
        $groupName = self::getGroupName();

        if ($groupName == 'super_admin') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function is used to know user group.
     *
     * @param void
     * @return boolean
     */
    public static function isSystemAdmin()
    {
        $groupName = self::getGroupName();

        if ($groupName == 'system_admin') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function is used to know user group.
     *
     * @param void
     * @return boolean
     */
    public static function isUser()
    {
        $groupName = self::getGroupName();

        if ($groupName == 'user') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function is used to know user group.
     *
     * @param void
     * @return boolean
     */
    public static function isGuest()
    {
        $groupName = self::getGroupName();

        if ($groupName == 'guest') {
            return true;
        } else {
            return false;
        }
    }

    public static function checkRole($user_id, $role)
    {
        $user = Sentinel::findById($user_id);
        if($user) {
            return $user->inRole($role);
        } else {
            return false;
        }

    }

}
