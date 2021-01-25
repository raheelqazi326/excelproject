<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spreadsheet;
use App\Events\SheetUpdate;
use DataTables;

class SpreadsheetController extends Controller
{
    public function index(){   
        return view('admin.sheet.index');
    }

    public function uploadSpreadsheet(Request $request){
        $rows = $request->rows;
        
        
        // return response()->json($rows, 500);
            
        foreach($rows as $row){        
            $spreadsheet = Spreadsheet::where('request_id', $row['Request Id'])->first();
            if(!empty($spreadsheet)){
                if($spreadsheet->status_id == 3){
                    continue;
                }
                $spreadsheet->delete();
            }
            
            $spreadsheet = new Spreadsheet;
            $spreadsheet->request_id = $row['Request Id']??$row['Request+Id']??"";
            $spreadsheet->date = date('Y-m-d', strtotime($row['Date']));
            $spreadsheet->start = date('H:i:s', strtotime($row['Start']));
            $spreadsheet->end = date('H:i:s', strtotime($row['End']));
            $spreadsheet->ward = $row['Ward'];
            $spreadsheet->request_grade = $row['Request Grade']??$row['Request+Grade']??"";
            $spreadsheet->status_id = 1;
            $spreadsheet->save();
        
        
            // $spreadsheet = new Spreadsheet;
            // $spreadsheet->request_id = $row[0];
            // $spreadsheet->date = date('Y-m-d', strtotime($row[1]));
            // $spreadsheet->start = $row[2];
            // $spreadsheet->end = $row[3];
            // $spreadsheet->ward = $row[4];
            // $spreadsheet->request_grade = $row[5];
            // $spreadsheet->status_id = 1;
            // $spreadsheet->save();
        
        
            
        }
        return response()->json(['status' => true, 'message' => 'successfully uploaded']);
    }

    public function datatableSpreadsheet(){
        // dd($request->all());
        return DataTables::of(Spreadsheet::with('status')->whereHas('status')->whereDate('created_at', date('Y-m-d', time())))->toJson();
    }

    public function sheetUploadNotification($total_requests){
        $data = [
            "interests" => ["sheet_upload"],
            "web" => [
                "notification" => [
                    "icon" => asset('notification-icon.png'),
                    "deep_link" => route('sheet.datatable'),
                    "title" => "Sheet Uploaded By Colette",
                    "body" => "{$total_requests} Requests Uploaded by Colette"
                ]
            ]
        ];
        $this->sendPushNotification($data);
        event(new SheetUpdate('reload'));
    }
    
    public function updateRequestStatus(Request $request){
        if(isset($request->id) && isset($request->status_id)){
            $is_colette = auth()->user()->role_id == 2?1:0;
            if($is_colette && ($request->status_id == 3 || $request->status_id == 4)){
                $spreadsheet = Spreadsheet::find($request->id);
                $spreadsheet->status_id = $request->status_id;
                $spreadsheet->save();
                $data = [
                    "interests" => ["approved"],
                    "web" => [
                        "notification" => [
                            "icon" => asset('notification-icon.png'),
                            "deep_link" => route('sheet.datatable'),
                            "title" => "Request Status Updated By Colette",
                            "body" => "Request ID #{$spreadsheet->request_id} Approved by Colette"
                        ]
                    ]
                ];
                if($request->status_id == 4){
                    $data["interests"] = ["rejected"];
                    $data["web"]["notification"]["body"] = "Request ID #{$spreadsheet->request_id} Rejected by Colette";
                }
                $this->sendPushNotification($data);
            }
            else if(!$is_colette && ($request->status_id == 1)){
                $spreadsheet = Spreadsheet::find($request->id);
                // $spreadsheet->candidate = "";
                $spreadsheet->status_id = $request->status_id;
                $spreadsheet->save();
            }
            event(new SheetUpdate('reload'));
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
                            $data = [
                                "interests" => ["comment_from_colette"],
                                "web" => [
                                    "notification" => [
                                        "icon" => asset('notification-icon.png'),
                                        "deep_link" => route('sheet.datatable'),
                                        "title" => "Comment From Colette",
                                        "body" => "Request ID #{$spreadsheet->request_id}: {$value}"
                                    ]
                                ]
                            ];
                            $this->sendPushNotification($data);
                        }
                        else{
                            if(($key == "candidate" || $key == "national_insurance") && ($spreadsheet->status_id == 1 || $spreadsheet->status_id == 2)){
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
                    if($spreadsheet->status_id == 1 && (!empty($spreadsheet->candidate) || !empty($spreadsheet->national_insurance))){
                        $spreadsheet->status_id = 2;
                        $data = [
                            "interests" => ["waiting_for_approve"],
                            "web" => [
                                "notification" => [
                                    "icon" => asset('notification-icon.png'),
                                    "deep_link" => route('sheet.datatable'),
                                    "title" => "Candidate Added",
                                    "body" => "Request ID #{$spreadsheet->request_id} Waiting for approve"
                                ]
                            ]
                        ];
                        $this->sendPushNotification($data);
                        // echo $response;                        
                    }
                    else if($spreadsheet->status_id == 2 && (empty($spreadsheet->candidate) && empty($spreadsheet->national_insurance))){
                        $spreadsheet->status_id = 1;
                    }
                    $spreadsheet->save();
                }
            }
            event(new SheetUpdate('reload'));
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
    public function sendPushNotification($data){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://9bbe1ce1-37b6-4263-b669-e8528a3a8630.pushnotifications.pusher.com/publish_api/v1/instances/9bbe1ce1-37b6-4263-b669-e8528a3a8630/publishes',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer D1B07D8791285F6578C019EBFD7F60CD6E784084483411AF13A31E6B018323D7'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
    }
}
