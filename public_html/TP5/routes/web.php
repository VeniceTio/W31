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

Route::get('/', function () {
    return view('signin');
});
Route::get('signin.php', function () {
    return view('signin');
});
Route::post('authenticate.php', function () {
    return view('authenticate');
});
Route::get('welcome.php', function () {
    return view('welcome');
});

Route::get('signup.php', function () {
    return view('signup');
});

