<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/18/2018
 * Time: 7:00 PM
 */


Route::group(['namespace' => 'Youtube\Videos\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => config('youtube.admin_dir'), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'video'], function () {


            Route::get('/lists', [
                'as' => 'list.videos',
                'uses' => 'IndexController@getListVideos',
            ]);

            Route::get('/', [
                'as' => 'video.index',
                'uses' => 'IndexController@index',
            ]);

            Route::post('/check', [
                'as' => 'video.check',
                'uses' => 'IndexController@checkVideo',
            ]);

            Route::post('/delete', [
                'as' => 'video.delete',
                'uses' => 'IndexController@deleteVideo',
            ]);


        });

    });

});