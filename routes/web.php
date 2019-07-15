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

Route::get('posts/like','PostsController@likePostButton');
Route::post('posts/likePost','PostsController@likePosts');
// Route::resource('posts','PostsController');
nvjfvnjf vf, sv,v