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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/apiLogin', 'ApiLoginController@login');

Route::get('/callback', 'ApiLoginController@convertToAccessToken');

Route::get('/posts', 'ApiController@posts');

Route::post('/addPost', 'ApiController@addPost');

Route::get('/deletePost/{id}', 'ApiController@deletePost');

Route::get('/editPost/{id}/{title}/{content}', function($id, $title, $content) {
    return view('editPost', ['id' => $id, 'title' => $title, 'content' => $content]);
});

Route::post('/editPost', 'ApiController@editPost');

Route::get('/profile', 'ProfileController@index');

Route::get('/getCurrUser', 'ApiController@getCurrUser');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::view('/test', 'test');
