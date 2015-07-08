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

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin', 'enabled']], function () {
    Route::get('', ['as' => 'admin', 'uses' => 'AdminController@index']);
    Route::group(['prefix' => 'users'], function () {
        Route::get('', ['as' => 'admin.users', 'uses' => 'AdminController@getUsers']);
        Route::get('add', ['as' => 'admin.users.add', 'uses' => 'AdminController@getEditUser']);
        Route::post('add', ['as' => 'admin.users.add', 'uses' => 'AdminController@postEditUser']);
        Route::get('{id}/edit', ['as' => 'admin.users.edit', 'uses' => 'AdminController@getEditUser']);
        Route::post('{id}/edit', ['as' => 'admin.users.edit', 'uses' => 'AdminController@postEditUser']);
        Route::get('{id}/enable', ['as' => 'admin.users.enable', 'uses' => 'AdminController@enableUser']);
        Route::get('{id}/delete', ['as' => 'admin.users.delete', 'uses' => 'AdminController@deleteUser']);
    });
    Route::group(['prefix' => 'pages'], function () {
        Route::get('', ['as' => 'admin.pages', 'uses' => 'AdminController@getPages']);
        Route::get('add', ['as' => 'admin.pages.add', 'uses' => 'AdminController@getEditPage']);
        Route::post('add', ['as' => 'admin.pages.add', 'uses' => 'AdminController@postEditPage']);
        Route::get('{id}/edit', ['as' => 'admin.pages.edit', 'uses' => 'AdminController@getEditPage']);
        Route::post('{id}/edit', ['as' => 'admin.pages.edit', 'uses' => 'AdminController@postEditPage']);
        Route::get('{id}/enable', ['as' => 'admin.pages.enable', 'uses' => 'AdminController@enablePage']);
        Route::get('{id}/delete', ['as' => 'admin.pages.delete', 'uses' => 'AdminController@deletePage']);
    });
});

Route::get('profile', ['as' => 'profile', 'uses' => 'ProfileController@getProfile']);
Route::post('profile', ['as' => 'profile', 'uses' => 'ProfileController@postProfile']);

Route::get('contact', 'ContactController@getContact');
Route::post('contact', 'ContactController@postContact');

Route::any('{uri}', 'PageController@index')->where('uri', '(.*)');