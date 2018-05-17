<?php
/**
 * Created by PhpStorm.
 * User: Toinn
 * Date: 5/17/2018
 * Time: 11:55 AM
 */

Route::group(['namespace' => 'Youtube\Groups\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => config('youtube.admin_dir'), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'group'], function () {

            Route::get('/', [
                'as' => 'group.index',
                'uses' => 'IndexController@index',
            ]);

            Route::get('create', [
                'as' => 'group.create',
                'uses' => 'IndexController@create',
            ]);

            Route::post('create', [
                'as' => 'group.create',
                'uses' => 'IndexController@store',
            ]);

        });

    });

});