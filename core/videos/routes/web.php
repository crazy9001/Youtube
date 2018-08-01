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

            Route::post('/movie', [
                'as' => 'video.move.group',
                'uses' => 'IndexController@movieVideoToGroup',
            ]);

            Route::get('/{id}/edit', [
                'as' => 'video.edit',
                'uses' => 'IndexController@edit',
            ]);

            Route::post('/update', [
                'as' => 'video.update',
                'uses' => 'IndexController@update',
            ]);

            Route::post('/store', [
                'as' => 'video.create',
                'uses' => 'IndexController@store',
            ]);

        });

    });

});