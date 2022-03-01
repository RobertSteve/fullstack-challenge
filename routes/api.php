<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserTokenController;
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

Route::post('login', 'UserTokenController');
Route::post('register', 'UserController@register');

Route::group(['middleware' => 'auth:sanctum'], function (){
    Route::post('logout', 'UserController@logout');
    Route::apiResource('tasks', 'TaskController')->except('destroy');
});
