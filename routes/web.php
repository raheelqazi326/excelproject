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
    Route::post('/spreadsheet-uploaded/{total-requests}', 'SpreadsheetController@sheetUploadNotification')->name('sheet.uploaded');
    Route::get('/sheet/datatable', 'SpreadsheetController@datatableSpreadsheet')->name('sheet.datatable');
    Route::post('sheet/update-status', 'SpreadsheetController@updateRequestStatus')->name('sheet.update.status');
    
    /////////////////////////////////////// USER ROUTE //////////////////////////////////////////////
    Route::post('/user/store', 'UserController@store')->name('user.store');
    Route::get('/user/list', 'UserController@index')->name('user.list');
    Route::get('/user/create', 'UserController@create')->name('user.create');
    Route::get('/user/show/{id}', 'UserController@show')->name('/user/show/{id}');
    Route::post('/user/update', 'UserController@update')->name('user.update');
    Route::get('/users/list', 'UserController@indexajax')->name('/users/list');
    Route::get('/user/delete/{id}', 'UserController@delete')->name('/user/delete/{id}');
    Route::post('/user/status', 'UserController@status')->name('/user/status');
    Route::post('/email/avail', 'UserController@emailavail')->name('/email/avail');

});
Route::get('/welcome', function () {
    return view('welcome');
});
// Route::get('/call-pusher', function () {
//     event(new App\Events\SheetUpdate('reload'));
//     return "Event has been sent!";
// });
