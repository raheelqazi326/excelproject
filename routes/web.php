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
    Route::post('/auth/change/password', 'AuthController@password')->name('auth.password');

    /////////////////////////////////////// SHEET ROUTE //////////////////////////////////////////////
    Route::get('/sheet/list', 'SpreadsheetController@index')->name('sheet.list');
    // Route::post('/upload-spreadsheet', 'SpreadsheetController@uploadSpreadsheet')->name('sheet.upload');
    Route::get('/spreadsheet-uploaded/{total_requests}', 'SpreadsheetController@sheetUploadNotification')->name('sheet.uploaded');
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
    Route::get('/sheet/history', 'HistoryController@history')->name('user.history');
    Route::get('/user/history/data', 'HistoryController@historydata')->name('history.data');
    Route::post('/user/history/delete', 'HistoryController@historyDelete')->name('history.delete');
    Route::post('/sheet/move', 'HistoryController@move')->name('sheet.move');
    Route::post('/sheet/upload/save', 'HistoryController@SheetSave')->name('sheet.save');
    Route::get('/sheet/download/', 'HistoryController@downloadfile')->name('sheet.download');
    Route::get('/sheet/download/data', 'HistoryController@filedata')->name('sheet.data');

});
Route::get('/welcome', function () {
    return view('welcome');
});
// Route::get('/call-pusher', function () {
//     event(new App\Events\SheetUpdate('reload'));
//     return "Event has been sent!";
// });
