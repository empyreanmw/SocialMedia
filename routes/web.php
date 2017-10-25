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

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
Route::post('/posts/{user}/create', 'PostsController@store');
Route::delete('/posts/{post}/delete', 'PostsController@destroy');
Route::get('/trending/{trend}', 'PostsController@trends')->name('trends');
Route::get('/people', 'HomeController@people');
Route::post('/posts/{post}/favorite', 'PostsController@favorite');
Route::delete('/posts/{post}/unfavorite', 'PostsController@unfavorite');
Route::get('/{user}/notifications', 'NotificationsController@index')->name('notifications');

Route::post('/replies/create', 'ReplyController@store');
Route::delete('/replies/{post}/{reply}/delete', 'ReplyController@delete');
Route::post('/replies/{reply}/favorite', 'ReplyController@favorite');
Route::delete('/replies/{reply}/unfavorite', 'ReplyController@unfavorite');

Route::get('/profiles/{user}','ProfilesController@show')->name('profile');

Route::post('/followers/create', 'FollowersController@create');
Route::post('/followers/destroy', 'FollowersController@destroy');


Route::post('/profiles/{user}/userinfo', 'UserAvatarController@update');
Route::get('/profiles/{user}/messages', 'MessagesController@inbox')->name('messages');
Route::get('/profiles/{user}/messages/{message}/show', 'MessagesController@individualMessage');
Route::get('/profiles/{user}/messages/newMessage', 'MessagesController@newMessage');
Route::post('/profiles/{user}/messages/newMessage/create', 'MessagesController@store');
Route::post('/profiles/{user}/messages/{message}/createReply', 'MessagesController@createReply');
Route::post('/profiles/{user}/avatar', 'UserAvatarController@store');

Route::get('api/users', 'UsersController@index');









