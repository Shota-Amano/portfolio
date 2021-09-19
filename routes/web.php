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

Route::get('/posts', 'PostController@index')->name('index');

Route::get('/posts/{post}', 'PostController@show');

Auth::routes();



Route::group(['middleware' => ['auth']], function () {
    
    Route::post('/posts/store/{id}', 'PostController@store')->name('store');
    Route::get('/posts/create/{id}', 'PostController@create')->name('create');
    
    Route::get('/posts/{post}/edit', 'PostController@edit');
    Route::put('/posts/{post}', 'PostController@update');
    Route::delete('/posts/{post}', 'PostController@delete');

});

Route::get('chat', 'ChatController@index');
Route::get('ajax/chat', 'Ajax\ChatController@index'); // メッセージ一覧を取得
Route::post('ajax/chat', 'Ajax\ChatController@create'); // チャット登録




