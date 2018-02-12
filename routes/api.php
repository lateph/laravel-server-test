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

// Route::group(['middleware' => ['cors']], function() {
   
// });
Route::post('upload', 'ItemController@upload');
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('home', 'CategoryController@home');
    
    Route::get('items', 'ItemController@index');
    Route::get('items/{id}', 'ItemController@show');
    Route::post('items', 'ItemController@store');
    Route::put('items/{id}', 'ItemController@update');
    Route::delete('items/{id}', 'ItemController@delete');
    
    
    Route::get('categories', 'CategoryController@index');
    Route::get('categories/{id}', 'CategoryController@show');
    Route::post('categories', 'CategoryController@store');
    Route::put('categories/{id}', 'CategoryController@update');
    Route::delete('categories/{id}', 'CategoryController@delete');

    Route::get('comments', 'CommentController@index');
    Route::get('comments/{id}', 'CommentController@show');
    Route::post('comments', 'CommentController@store');
    Route::put('comments/{id}', 'CommentController@update');
    Route::delete('comments/{id}', 'CommentController@delete');
});