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

Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');


//todo change type of requests
//todo routes for polls
Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');
 
    Route::get('user', 'ApiController@getAuthUser');

    Route::get('/polls/{poll}', 'PollController@show');
    Route::get('/polls', 'PollController@index');
    Route::post('/polls/create', 'PollController@store');
    Route::post('/polls/{poll}/', 'PollController@saveOptions');
    Route::post('/polls/{poll}/vote', 'PollController@vote');

});