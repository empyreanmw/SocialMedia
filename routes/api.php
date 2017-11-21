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

    
    
