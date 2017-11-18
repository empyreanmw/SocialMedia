<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

<<<<<<< HEAD
    
    Route::post('login', 'Auth\LoginController@login')->middleware('web');   
    Route::post('logout', 'Auth\LoginController@logout')->middleware('web');   
    
    Route::prefix('users')->group(function (){
         Route::post('/', 'UsersController@index');
         Route::post('/create', 'Auth\RegisterController@register');  
    });
    
    Route::prefix('posts')->group(function (){
        Route::get('/', 'ApiPostsController@index');
        Route::post('create', 'ApiPostsController@store');    
    });

    Route::prefix('trends')->group(function (){
        Route::post('/', 'TrendsController@index');
    });

=======
    Route::post('users', 'UsersController@index');
    Route::get('posts', 'PostsController@popularPosts');
    Route::get('trends', 'TrendsController@index');
    Route::post('post/create', 'PostsController@store');
    Route::post('trends/search', 'TrendsController@search');    
    Route::post('users/create', 'Auth\RegisterController@register');    
>>>>>>> 6f555e7... Added api support for listing Top trends, post and users. Also added support for creating users via API.
    
    
