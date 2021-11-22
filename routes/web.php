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
    return view('auth.login');
});

Route::get('/try', 'TestController@index');



Auth::routes();



Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/posts', 'PostController@index')->name('index');
    Route::get('/posts/search', 'PostController@searchPost');
    Route::get('/posts/{id}', 'PostController@show');
    
    Route::post('/posts/store/{id}', 'PostController@store')->name('store');
    Route::get('/posts/create/{id}', 'PostController@create')->name('create');
    
    Route::get('/posts/{post}/edit', 'PostController@edit');
    Route::put('/posts/{post}', 'PostController@update');
    
    Route::get('/posts/delete/{id}', 'PostController@del')->name('delete');
    Route::post('/posts/delete/{id}', 'PostController@remove')->name('remove');
    
    Route::get('/result/ajax', 'ChatController@getData');
    Route::post('/add', 'ChatController@add')->name('add');
    Route::get('/chat', 'ChatController@index')->name('chat');
    
    
    
});








