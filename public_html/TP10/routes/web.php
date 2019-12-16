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
    session();
    Route::get('/', 'ArticleController@home');
    Route::get('index', 'ArticleController@home');
    Route::get('article/{id}', 'ArticleController@getArticle');

    Route::get('signin', 'UserController@signin');
    Route::get('signup', 'UserController@signup');
    Route::get('home', 'ArticleController@home');
    Route::post('adduser', 'UserController@adduser');
    Route::post('authenticate', 'UserController@authenticate');

    Route::prefix('news')->group(function(){
        Route::get('categories','ArticleController@getCategories');
        Route::get('category/{catId}','ArticleController@getArticles');
        Route::get('category/{catId}/{id}', 'ArticleController@getArticleByCategory');
    });

    Route::prefix('admin')
        ->middleware('myuser.auth')
        ->group(function() {

        Route::get('signout', 'UserController@signout');
        Route::get('signin', 'UserController@signin');

        Route::group([], function () {
            Route::get('deleteuser', 'UserController@deleteuser');
            Route::post('changepassword', 'UserController@changepassword');
            Route::post('changeage', 'UserController@changeage');
            Route::get('formpassword', 'UserController@formpassword');
            Route::get('welcome', 'UserController@welcome');
        });
        Route::prefix('game')
            ->group(function (){
                Route::get('newGame','VideoGameController@newGame');
                Route::post('createGame','VideoGameController@createGame');
                Route::get('myGames','VideoGameController@myGames');
                Route::get('delete/{id}','VideoGameController@delete');
                Route::get('modify/{id}','VideoGameController@modify');
            });

        Route::prefix('write')
            ->group(function (){
                Route::get('newArticle','ArticleController@newArticle');
                Route::post('createArticle','ArticleController@createArticle');
                Route::get('myArticles','ArticleController@myArticles');
                Route::get('modify/{id}','ArticleController@modify');   //à faire
                Route::get('publish/{id}/{etat}','ArticleController@publish');
                Route::get('delete/{id}','ArticleController@delete');
            });
    });
});
