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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::namespace('Site')->name('site.')->group(function(){
	Route::get('/', 'HomeController@index')->name('index');
	Route::get('/post/{slug}', 'HomeController@single')->name('single');

	Route::post('/post/comment', 'CommentController@saveComment')->name('single.comment');
});

//Route::get('hello-world', 'HelloWorldController@index');
//
//Route::get('/post/{slug}', function($slug) {
//	return $slug;
//});

Route::resource('/users', 'UserController');

Route::group(['middleware' => ['auth']], function(){

    Route::prefix('admin')->namespace('Admin')->group(function(){

        Route::resource('posts', 'PostController');
        Route::resource('categories', 'CategoryController');

        Route::prefix('profile')->name('profile.')->group(function(){

            Route::get('/', 'ProfileController@index')->name('index');
            Route::post('/', 'ProfileController@update')->name('update');

        });

    });
});

Auth::routes();
