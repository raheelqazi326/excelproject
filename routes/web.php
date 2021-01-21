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
Route::get('/', 'AuthController@index')->name('login');
Route::post('/auth/login', 'AuthController@login')->name('auth.login');
Route::get('/auth/logout', 'AuthController@logout')->name('auth.logout');

Route::group(['middleware'=>'auth'], function () {

    /////////////////////////////////////// SHEET ROUTE //////////////////////////////////////////////
    Route::get('/sheet/list', 'SpreadsheetController@index')->name('sheet.list');
    Route::post('/upload-spreadsheet', 'SpreadsheetController@uploadSpreadsheet')->name('sheet.upload');
    Route::get('/sheet/datatable', 'SpreadsheetController@datatableSpreadsheet')->name('sheet.datatable');
    
    /////////////////////////////////////// USER ROUTE //////////////////////////////////////////////
    Route::post('/user/store', 'UserController@store')->name('user.store');
    Route::get('/user/list', 'UserController@index')->name('user.list');
    Route::get('/user/create', 'UserController@create')->name('user.create');
    Route::get('/user/show/{id}', 'UserController@show')->name('/user/show/{id}');


});
// Route::get('/', function () {
//     return view('welcome');
// });
