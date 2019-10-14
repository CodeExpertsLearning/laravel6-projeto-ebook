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
    return view('welcome');
});

Route::get('hello-world', 'HelloWorldController@index');

Route::get('/post/{slug}', function($slug) {
	return $slug;
});

Route::resource('/users', 'UserController');

Route::prefix('admin')->namespace('Admin')->group(function(){

	Route::resource('posts', 'PostController');
	Route::resource('categories', 'CategoryController');

});