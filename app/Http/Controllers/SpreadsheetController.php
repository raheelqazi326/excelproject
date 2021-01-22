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
    
    public function updateRequestStatus(Request $request){
        if(isset($request->id) && isset($request->status_id)){
            $is_colette = auth()->user()->role_id == 2?1:0;
            if($is_colette && ($request->status_id == 3 || $request->status_id == 4)){
                $spreadsheet = Spreadsheet::find($request->id);
                $spreadsheet->status_id = $request->status_id;
                $spreadsheet->save();
            }
            else if(!$is_colette && ($request->status_id == 1)){
                $spreadsheet = Spreadsheet::find($request->id);
                $spreadsheet->candidate = "";
                $spreadsheet->national_insurance = "";
                $spreadsheet->status_id = $request->status_id;
                $spreadsheet->save();
            }
        }
    }

    public function editSpreadsheet(Request $request){
        $rows = $request->data;
        $i = (array_keys($rows))[0];
        $errors = [];
        $is_colette = $request->role_id == 2?1:0;
        try {
            //code...
            foreach($rows as $key => $row){
                $spreadsheet = Spreadsheet::find($key);
                if(!empty($spreadsheet)){
                    foreach ($row as $key => $value) {
                        if($is_colette){
                            if($key == "comment_from_colette"){
                                $spreadsheet->$key = $value;
                            }
                            else{
                                return response()->json([
                                    "data" => [],
                                    "fieldErrors" => [
                                        "name" => $key,
                                        "status" => "you can not update this column"
                                    ]
                                ]);
                            }
                        }
                        else{
                            if(($key == "candidate" || $key == "national_insurance") && ($spreadsheet->status_id == 1 && $spreadsheet->status_id == 2)){
                                $spreadsheet->$key = $value;
                            }
                            else{
                                return response()->json([
                                    "data" => [],
                                    "fieldErrors" => [[
                                        "name" => $key,
                                        "status" => !($key == "candidate" || $key == "national_insurance")?"you can not update this column":"You can not update when request is ".($spreadsheet->status_id == 3?"approved":"reject")
                                    ]]
                                ]);
                            }
                        }
                    }
                    if($spreadsheet->status_id == 1 && !empty($spreadsheet->candidate) && !empty($spreadsheet->national_insurance)){
                        $spreadsheet->status_id = 2;
                    }
                    else if($spreadsheet->status_id == 2 && (empty($spreadsheet->candidate) || empty($spreadsheet->national_insurance))){
                        $spreadsheet->status_id = 1;
                    }
                    $spreadsheet->save();
                }
            }
            return DataTables::of(Spreadsheet::with('status')->whereHas('status')->find(array_keys($rows)))->toJson();
        } catch (\Throwable $th) {
            //throw $th;
            // dd($th->getMessage());
            foreach($rows[$i] as $key => $value){
                $errors[] = [
                    "name" => $key,
                    "status" => "invalid value"
                ];
            }
            return response()->json([
                "data" => [],
                "fieldErrors" => $errors
            ]);
        }
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
