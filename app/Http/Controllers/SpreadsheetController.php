<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spreadsheet;

class SpreadsheetController extends Controller
{
    //
    public function index(){
        return view('admin.sheet.index');
    }

    public function uploadSpreadsheet(Request $request){
        $rows = $request->rows;
        foreach($rows as $row){        
            $spreadsheet = Spreadsheet::where('request_id', $row['Request Id'])->first();
            if(empty($spreadsheet)){
                $spreadsheet = new Spreadsheet;
                $spreadsheet->request_id = $row['Request Id'];
            }
            $spreadsheet->date = date('Y-m-d', strtotime($row['Date']));
            $spreadsheet->start = $row['Start'];
            $spreadsheet->end = $row['End'];
            $spreadsheet->ward = $row['Ward'];
            $spreadsheet->request_grade = $row['Request Grade'];
            $spreadsheet->status_id = 1;
            $spreadsheet->save();
        }
        return response()->json(['status' => true, 'message' => 'successfully uploaded']);
    }
}
