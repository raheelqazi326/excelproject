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
Route::get('/login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::post('/auth/login', 'App\Http\Controllers\AuthController@login')->name('auth.login');
Route::get('/auth/logout', 'App\Http\Controllers\AuthController@logout')->name('auth.logout');

Route::group(['middleware'=>'auth'], function () {

    /////////////////////////////////////// SHEET ROUTE //////////////////////////////////////////////
    Route::get('/sheet/list', 'App\Http\Controllers\SpreadsheetController@index')->name('sheet.list');


    /////////////////////////////////////// USER ROUTE //////////////////////////////////////////////
    Route::post('/user/sotore', 'App\Http\Controllers\UserController@store')->name('user.store');
    Route::get('/user/list', 'App\Http\Controllers\UserController@index')->name('user.list');
    Route::get('/user/create', 'App\Http\Controllers\UserController@create')->name('user.create');

});

Route::get('/', function () {
    return view('welcome');
});
