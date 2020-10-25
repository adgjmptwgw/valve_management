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

// apiResource・・・Route::resource('users', 'UsersController')と同じ使い方
// Route::apiResource('/System', 'Api\OptionApiController');

// 弁の開閉状態のルーティング
Route::put('/System/{System}', 'Api\OptionApiController@update');

// 弁の操作履歴のルーティング
Route::post('/System', 'Api\OptionApiController@store');

// 付箋のルーティング
Route::put('/Tag/{Tag}', 'Api\OptionApiController@updateTag');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
