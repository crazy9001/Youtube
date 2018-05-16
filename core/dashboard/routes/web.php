<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/11/2018
 * Time: 7:03 PM
 */
Route::group(['namespace' => 'Youtube\Dashboard\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => config('youtube.admin_dir'), 'middleware' => 'auth'], function () {

        Route::get('/', [
            'as' => 'dashboard.index',
            'uses' => 'DashboardController@getDashboard',
        ]);

        Route::get('/group', [
            'as' => 'user.group.index',
            'uses' => 'DashboardController@getDashboard',
        ]);

    });

});