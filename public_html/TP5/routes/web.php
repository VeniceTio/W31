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
Route::get('index', function () {
    return view('signin');
});
Route::get('signin.php', function () {
    return view('signin');
});
Route::get('signup.php', function () {
    return view('signup');
});
Route::get('welcome.php', function () {
    return view('welcome');
});


Route::post('adduser.php', function () {
    return view('adduser');
});
Route::post('authenticate.php', function () {
    return view('authenticate');
});
Route::post('changepassword.php', function () {
    return view('changepassword');
});
Route::post('deleteuser.php', function () {
    return view('deleteuser');
});
