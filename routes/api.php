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
Route::post('/upload-spreadsheet', 'SpreadsheetController@uploadSpreadsheet')->name('sheet.upload');
<<<<<<< HEAD
    // Route::post('/user/history/delete', 'HistoryController@historyDelete')->name('history.delete');
=======
>>>>>>> b4c920d2663870fe6cf850e51a3b33cea0b6eb23

Route::post('/sheet/edit', 'SpreadsheetController@editSpreadsheet')->name('sheet.edit');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
