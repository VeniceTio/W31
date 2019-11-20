<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([],function() {
    Route::get('/', 'UserController@signin');
    Route::get('index', 'UserController@signin');
    Route::get('signin', 'UserController@signin');
    Route::get('signup', 'UserController@signup');



    Route::post('adduser', 'UserController@adduser');
    Route::post('authenticate', 'UserController@authenticate');


    Route::prefix('admin')
        ->middleware('myuser.auth')
        ->group(function() {

        Route::get('signout', 'UserController@signout');
        Route::get('signin', 'UserController@signin');

        Route::group([], function () {
            Route::get('deleteuser', 'UserController@deleteuser');
            Route::post('changepassword', 'UserController@changepassword');
            Route::get('formpassword', 'UserController@formpassword');
            Route::get('welcome', 'UserController@welcome');
        });
    });
});
