<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpreadsheetController extends Controller
{
    //
    public function index(){

    }

    public function uploadSpreadsheet(Request $request){
        return response()->json($request->all());
    }

}