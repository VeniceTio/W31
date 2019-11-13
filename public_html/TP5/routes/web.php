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
    session_start();
    Route::get('/', function () {
        return view('signin')->with('message',$_SESSION['message'] ?? null);
    });
    Route::get('index', function () {
        return view('signin')->with('message',$_SESSION['message'] ?? null);
    });
    Route::get('signin', function () {
        return view('signin')->with('message',$_SESSION['message'] ?? null);
    });
    Route::get('signup', function () {
        return view('signup')->with('message',$_SESSION['message'] ?? null);
    });



    Route::post('adduser', function () {
        return view('adduser');
    });
    Route::post('authenticate', function () {
        return view('authenticate');
    });


    Route::prefix('admin')->group(function() {

        Route::get('signout', function () {
            session_destroy();
            return redirect('signin')->with('message',$_SESSION['message'] ?? null);
        });
        Route::get('signin', function () {
            return redirect('signin')->with('message',$_SESSION['message'] ?? null);
        });


        Route::group([], function () {
            if (!isset($_SESSION['user'])) {
                return redirect('signin')->with('message',$_SESSION['message'] ?? null);
            }
            Route::get('deleteuser', function () {
                return view('deleteuser');
            });
            Route::post('changepassword', function () {
                return view('changepassword');
            });
            Route::get('formpassword', function () {
                return view('formpassword')->with('message',$_SESSION['message'] ?? null);
            });
            Route::get('welcome', function () {
                return view('welcome')->with(['message' =>$_SESSION['message'] ?? null,
                    'user' =>$_SESSION['user']]);
            });
        });
    });
});
