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

    public function datatableSpreadsheet(Request $request){
        // dd($request->all());
        return DataTables::of(Spreadsheet::where('type', $request->type)
            ->where('user_id', auth()->user()->id)
            ->where('category', 'LIKE', "%{$request->category}%")
            ->whereBetween('date', [
                date('Y-m-d 00:00:00', strtotime($request->start)),
                date('Y-m-d 23:59:59', strtotime($request->end))
            ]))->toJson();
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
        // dd($request->all());
        try {
            //code...
            foreach($rows as $key => $row){
                $spreadsheet = Spreadsheet::find($key);
                if($key == 0){
                    $spreadsheet = new Spreadsheet();
                    $spreadsheet->user_id = $request->user_id;
                    $spreadsheet->type = $request->type;
                }
                if(!empty($spreadsheet)){
                    foreach ($row as $key => $value) {
                        $spreadsheet->$key = $value;
                    }
                    $spreadsheet->save();
                }
            }
            // event(new SheetUpdate('reload'));
            return DataTables::of(Spreadsheet::find(array_keys($rows)))->toJson();
        } catch (\Throwable $th) {
            throw $th;
            // dd($th);
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
