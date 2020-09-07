<?php

use Illuminate\Support\Facades\Route;

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

// 系統線図の表示に関するルーティング
Route::get('/SystemD', 'ValveController@index');

// Route::get('/SystemD',function(){
//     return view('SystemD');
// });

// ホーム画面の表示処理
Route::get('/Home', 'ValveController@HomeIndex');

// 編集処理
// Route::post('/SystemD', 'ValveController@update');

// 弁のオプション
// Route::post('/SystemD', 'ValveController@store');

// Route::resource('SystemD', 'ValveController')->only([
//     'index', 'store', 'edit', 'update', 'destroy'
// ]);


// 以下Laravelデフォルト
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
