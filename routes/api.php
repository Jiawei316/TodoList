<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::namespace('api')->group(function(){
    Route::prefix('todos')->group(function(){
        Route::get('/','TodoController@index');
        Route::get('/{id}','TodoController@show');
        Route::post('/','TodoController@store');
        Route::patch('/{id}','TodoController@update');
        Route::delete('/{id}','TodoController@destroy');
    });
});
