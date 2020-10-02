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
// Route::apiResource([
//     'System' => 'Api\OptionApiController',
//     'Tag' => 'Api\OptionApiController'
//     ]);
Route::apiResource('/System', 'Api\OptionApiController');

Route::apiResource('/Tag', 'Api\TagApiController');
// Route::apiResource('/Tag', 'Api\OptionApiController');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
