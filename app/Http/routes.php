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

Route::group(['prefix' => 'resources', 'middleware' => ['auth', 'admin_or_tutor', 'enabled']], function () {
    Route::get('', ['as' => 'resources', 'uses' => 'ResourceController@index']);
    Route::get('add', ['as' => 'resources.add', 'uses' => 'ResourceController@getEditResource']);
    Route::post('add', ['as' => 'resources.add', 'uses' => 'ResourceController@postEditResource']);
    Route::get('{id}/edit', ['as' => 'resources.edit', 'uses' => 'ResourceController@getEditResource']);
    Route::post('{id}/edit', ['as' => 'resources.edit', 'uses' => 'ResourceController@postEditResource']);
    Route::get('{id}/enable', ['as' => 'resources.enable', 'uses' => 'ResourceController@enableResource']);
    Route::get('{id}/delete', ['as' => 'resources.delete', 'uses' => 'ResourceController@deleteResource']);
    Route::get('{id}/download', ['as' => 'resources.download', 'uses' => 'ResourceController@downloadResource']);
});

Route::group(['prefix' => 'reports', 'middleware' => ['auth', 'admin_or_tutor', 'enabled']], function () {
    Route::get('', ['as' => 'reports', 'uses' => 'ReportController@index']);
    Route::get('add', ['as' => 'reports.add', 'uses' => 'ReportController@getEdit']);
    Route::post('add', ['as' => 'reports.add', 'uses' => 'ReportController@postEdit']);
    Route::get('{id}/edit', ['as' => 'reports.edit', 'uses' => 'ReportController@getEdit']);
    Route::post('{id}/edit', ['as' => 'reports.edit', 'uses' => 'ReportController@postEdit']);
    Route::get('{id}/enable', ['as' => 'reports.enable', 'uses' => 'ReportController@enable']);
    Route::get('{id}/delete', ['as' => 'reports.delete', 'uses' => 'ReportController@delete']);
    Route::get('{id}/notify', ['as' => 'reports.notify', 'uses' => 'ReportController@notify']);
    Route::get('{slug}', ['as' => 'reports.view', 'uses' => 'ReportController@getBySlug']);
});

Route::get('profile', ['as' => 'profile', 'uses' => 'ProfileController@getProfile']);
Route::post('profile', ['as' => 'profile', 'uses' => 'ProfileController@postProfile']);

Route::group(['prefix' => 'calendar', 'middleware' => ['auth', 'admin_or_tutor', 'enabled']], function () {
    Route::get('', ['as' => 'calendar', 'uses' => 'CalendarController@index']);
});

Route::group(['prefix' => 'lessons', 'middleware' => ['auth', 'enabled']], function () {
    Route::get('{id}', ['as' => 'lesson.find', 'uses' => 'LessonController@find']);
    Route::get('tutor/{tutorId}', ['as' => 'lesson.find', 'uses' => 'LessonController@getByTutorId']);
    Route::post('/', ['as' => 'lesson.save', 'uses' => 'LessonController@save']);
    Route::put('{id}', ['as' => 'lesson.save', 'uses' => 'LessonController@save']);
    Route::delete('{id}', ['as' => 'lesson.delete', 'uses' => 'LessonController@delete']);
});

Route::get('contact', 'ContactController@getContact');
Route::post('contact', 'ContactController@postContact');

Route::any('{uri}', 'PageController@index')->where('uri', '(.*)');