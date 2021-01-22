<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spreadsheet;
use DataTables;

class SpreadsheetController extends Controller
{
    public function index(){   
        return view('admin.sheet.index');
    }

    public function datatableSpreadsheet(){
        // dd($request->all());
        return DataTables::of(Spreadsheet::with('status')->whereHas('status')->whereDate('created_at', date('Y-m-d', time())))->toJson();
    }
    
    public function editSpreadsheet(Request $request){
        $data = $request->data;
        $i = (array_keys($data))[0];
        $errors = [];
        foreach($data[$i] as $key => $value){
            $errors[] = [
                "name" => $key,
                "status" => "invalid field"
            ];
        }
        return response()->json([
            "data" => [],
            "fieldErrors" => $errors
        ]);
        foreach($request->data as $key => $data){
            $spreadsheet = Spreadsheet::find($key);
            if(!empty($spreadsheet)){
                foreach ($data as $key => $value) {
                    $spreadsheet->$key = $value;
                }
                $spreadsheet->save();
            }
        }
        return DataTables::of(Spreadsheet::find(array_keys($request->data)))->toJson();
    }

    public function uploadSpreadsheet(Request $request){
        $rows = $request->rows;
        foreach($rows as $row){        
            $spreadsheet = Spreadsheet::where('request_id', $row['Request Id'])->first();
            if(!empty($spreadsheet) && $spreadsheet->status == 3){ 
                continue;
            }
            else{
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
