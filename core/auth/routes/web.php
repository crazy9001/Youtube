<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/11/2018
 * Time: 6:54 PM
 */
Route::group(['namespace' => 'Youtube\Auth\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => config('youtube.admin_dir')], function () {

        Route::group(['middleware' => 'guest'], function () {

            Route::get('/login', [
                'as' => 'access.login',
                'uses' => 'AuthController@getLogin',
            ]);

            Route::post('/login', [
                'as' => 'access.login',
                'uses' => 'AuthController@postLogin',
            ]);


        });
        
        Route::group(['middleware' => 'auth'], function () {

            Route::get('/logout', [
                'as' => 'access.logout',
                'uses' => 'AuthController@getLogout',
            ]);

        });

    });

});