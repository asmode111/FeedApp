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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/dashboard', 'HomeController@index')->name('dashboard')->middleware('auth');

Route::get('api/v1/user/email', 'API\V1\UserController@getByEmail');
Route::get('api/v1/words', 'API\V1\WordController@index')->middleware('auth');
Route::get('api/v1/words/extract', 'API\V1\WordController@extract')->middleware('auth');
Route::get('api/v1/feed', 'API\V1\FeedController@index')->middleware('auth');
