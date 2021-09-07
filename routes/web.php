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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/posts', 'PostController@index')->name('index');

Route::get('/posts/{post}', 'PostController@show');

Auth::routes();



Route::group(['middleware' => ['auth']], function () {
    
    Route::post('/posts/store/{id}', 'PostController@store')->name('store');
    Route::get('/posts/create/{id}', 'PostController@create')->name('create');
    
    //Route::get('/posts/{post}/edit', 'PostController@edit');
    //Route::put('/posts/{post}', 'PostController@update');
    //Route::delete('/posts/{post}', 'PostController@delete');

});




