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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/posts', 'PostController@index');
Route::post('/posts', 'PostController@store');

Route::group(['middleware' => ['auth']], function () {
    
    // 投稿の作成画面の表示、作成処理、詳細画面、更新、削除
    Route::resource('posts', 'PostController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'delete']]);
});

Route::get('/posts/create', 'PostController@create');
Route::get('/posts/{post}', 'PostController@show');
Route::get('/posts/{post}/edit', 'PostController@edit');
Route::put('/posts/{post}', 'PostController@update');
Route::delete('/posts/{post}', 'PostController@delete');

