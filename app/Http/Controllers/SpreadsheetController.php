<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpreadsheetController extends Controller
{
    public function index(){
        return view('admin.sheet.index');
    }

    public function uploadSpreadsheet(Request $request){
        return response()->json($request->all());
    }
}
