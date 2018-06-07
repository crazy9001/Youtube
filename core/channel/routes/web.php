<?php
/**
 * Created by PhpStorm.
 * User: Toinn
 * Date: 6/7/2018
 * Time: 10:45 AM
 */

Route::group(['namespace' => 'Youtube\Channel\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => config('youtube.admin_dir'), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'channel'], function () {

            Route::get('/', [
                'as' => 'channel.index',
                'uses' => 'IndexController@index',
            ]);

            Route::get('/ListChannel', [
                'as' => 'channel.list',
                'uses' => 'IndexController@getListChannel',
            ]);

            Route::post('/store', [
                'as' => 'channel.store',
                'uses' => 'IndexController@store',
            ]);

            Route::post('/update/nameChannel', [
                'as' => 'channel.update.name',
                'uses' => 'IndexController@updateNameChannel',
            ]);

        });

    });

});