<?php

use App\Http\Controllers\ApiController;

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


/**
 * Standard routes
 */
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Log in routes
 */
Route::get('/apiLogin', 'ApiLoginController@login');

Route::get('/callback', 'ApiLoginController@convertToAccessToken');


/**
 * Post manipulation routes
 */
Route::get('/feed', 'FeedController@index')->middleware('auth');

Route::get('/myPosts', 'MyPostsController@index')->middleware('auth');

Route::post('/addPost', 'ApiController@addPost');

Route::get('/deletePost/{id}', 'ApiController@deletePost');

Route::get('/editPost/{id}/{title}/{content}', function($id, $title, $content) {
    return view('editPost', ['id' => $id, 'title' => $title, 'content' => $content]);
});

Route::post('/editPost', 'ApiController@editPost');


/**
 * dashboard routes
 */
Route::get('/getCurrUser', 'ApiController@getCurrUser');

Route::get('/dashboard', 'DashboardController@index')->middleware('auth');



