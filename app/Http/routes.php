<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
    Route::post('login', ['as' => 'login', 'uses' => 'Auth\AuthController@postLogin']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
});

Route::group(['prefix' => 'password'], function () {
    Route::get('email', ['as' => 'password.email', 'uses' => 'Auth\PasswordController@getEmail']);
    Route::post('email', ['as' => 'password.email', 'uses' => 'Auth\PasswordController@postEmail']);
    Route::get('reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\PasswordController@getReset']);
    Route::post('reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\PasswordController@postReset']);
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('', ['as' => 'admin.index', 'uses' => 'AdminController@index']);
});

Route::any('{uri}', 'PageController@index')->where('uri', '(.*)');