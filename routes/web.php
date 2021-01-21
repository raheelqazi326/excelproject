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
Route::get('/', 'App\Http\Controllers\AuthController@index')->name('login');
Route::post('/auth/login', 'App\Http\Controllers\AuthController@login')->name('auth.login');
Route::get('/auth/logout', 'App\Http\Controllers\AuthController@logout')->name('auth.logout');

Route::group(['middleware'=>'auth'], function () {

    /////////////////////////////////////// SHEET ROUTE //////////////////////////////////////////////
    Route::get('/sheet/list', 'SpreadsheetController@index')->name('sheet.list');
    Route::post('/upload-spreadsheet', 'SpreadsheetController@uploadSpreadsheet')->name('sheet.upload');
    Route::get('/sheet/datatable', 'SpreadsheetController@datatableSpreadsheet')->name('sheet.datatable');
    
    /////////////////////////////////////// USER ROUTE //////////////////////////////////////////////
<<<<<<< HEAD
    Route::post('/user/store', 'App\Http\Controllers\UserController@store')->name('user.store');
    Route::get('/user/list', 'App\Http\Controllers\UserController@index')->name('user.list');
    Route::get('/user/create', 'App\Http\Controllers\UserController@create')->name('user.create');
    Route::get('/user/show/{id}', 'App\Http\Controllers\UserController@show')->name('/user/show/{id}');

});
=======
    Route::post('/user/sotore', 'UserController@store')->name('user.store');
    Route::get('/user/list', 'UserController@index')->name('user.list');
    Route::get('/user/create', 'UserController@create')->name('user.create');
>>>>>>> 4c2873bb22b7026cc3a88493fe58f6b32e7a8ecf

});
// Route::get('/', function () {
//     return view('welcome');
// });
