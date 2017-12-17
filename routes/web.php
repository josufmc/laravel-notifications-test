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

Route::get('/messages/create', 'MessagesController@create')->name('messages.create');
Route::post('/messages', 'MessagesController@store')->name('messages.store');
Route::get('/messages/{id}', 'MessagesController@show')->name('messages.show');
Route::get('/notifications', 'NotificationsController@index')->name('notifications.index');
Route::patch('/notifications/{id}', 'NotificationsController@read')->name('notifications.read');
Route::delete('/notifications/{id}', 'NotificationsController@destroy')->name('notifications.destroy');


Route::resource('posts', 'PostController');

