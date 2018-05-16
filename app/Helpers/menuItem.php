<?php

namespace App\Helpers;
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/16/2018
 * Time: 9:26 PM
 */

use Sentinel;
use Helper;
use URL;
use Route;
use Permission;

/**
 * Menu helper class is used to manage different menu option for different user
 *
 * @author Toinn
 */
class MenuItemHelper
{
    /**
     * Function to get menu items
     *
     * @return type Array
     * @author Toinn
     */
    public static function getMenu()
    {
        $roles = Helper::getCurrentUserRole();
        $menuNavigationItems = config('menuitems.' . $roles[0]['slug']);
        return self::getMenuView($menuNavigationItems);
    }

    /**
     * Function to get menu view for dashboard
     *
     * @author Toinn
     */
    public static function getMenuView($menuNavigationItems)
    {
        $route_current = Route::currentRouteName();
        $menu = '';
        $icons = config('menuitems.Icons');

        if (is_array($menuNavigationItems) && count($menuNavigationItems) > 0) {
            foreach ($menuNavigationItems as $key => $value) {
                if (is_array($value)) {
                    $menu .= '<li class="' . (in_array($route_current, array_values($value)) ? 'active' : '') . '">'
                        . '<a  class=" ' . $key . '"' . (in_array($route_current, array_values($value)) ? 'active' : '') . '" href="#" data-toggle="dropdown" class=\'dropdown-toggle\'>'
                        . (isset($icons[$key]) ? $icons[$key] : '')
                        . '<span>' . $key . '</span>' . (isset($key) && isset($badget_key_value[$key]) ? '<span class="pull-right badge badge-info">' . (!empty($badget_key_value[$key]) ? $badget_key_value[$key] : '0') . '</span>' : '' )
                        . '<span class="caret"></span>'
                        . '</a>'
                        . '<ul class="dropdown-menu">'
                        . self::getMenuView($value)
                        . '</ul>'
                        . '</li>';
                } else {
                    $menu .= '<li class="' . ($route_current == $value ? 'active' : '') . '">'
                        . '<a class="' . ($route_current == $value ? 'active ' : '') . '" href="' . ( Route::has($value) ? URL::route($value) : URL::to('login') ) . '">'
                        . (isset($icons[$key]) ? $icons[$key] : '')
                        . '<span>' . $key . '</span>' . (isset($key) && isset($badget_key_value[$key]) ? '<span class="pull-right badge badge-info">' . (!empty($badget_key_value[$key]) ? $badget_key_value[$key] : '0') . '</span>' : '' )
                        . '</a>'
                        . '</li>';
                }
            }
        }
        return $menu;
    }
}