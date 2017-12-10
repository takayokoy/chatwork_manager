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
Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/token', 'TokenController@post')->name('token');
Route::get('/chatroom/add', 'ChatRoomController@showadd')->name('chatroom.showadd');
Route::get('/chatroom/delete', 'ChatRoomController@showdelete')->name('chatroom.showdelete');
Route::post('/chatroom/add', 'ChatRoomController@add')->name('chatroom.add');
