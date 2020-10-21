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

// Route::get('valveData', function () {
//     return App\ValveOption::all();
//     return view('SystemList');
// });


// ホーム画面の表示処理
Route::get('/', 'ValveController@HomeIndex');

// 1号機目次表示処理
Route::get('/DiagramsList', 'ValveController@ListIndex');

// 弁操作履歴表示処理
Route::get('/History', 'ValveController@HistoryIndex');

// Route::get('/SystemList/json', 'ValveController@json');
// Route::get('/SystemList/json/{id}', 'ValveController@json');

// 系統線図の表示に関するルーティング
// Route::get('/SystemD', 'ValveController@index');

// 編集処理
// Route::post('/SystemD', 'ValveController@update');

// ValveOptionsのテーブルにデータを登録する処理
// Route::post('/SystemD', 'ValveController@store');

// Route::resource('SystemD', 'ValveController')->only([
//     'index', 'store', 'edit', 'update', 'destroy'
// ]);


// 以下Laravelデフォルト
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
