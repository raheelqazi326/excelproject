<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Histories;
use App\Models\Spreadsheet;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function history(){
        return view("admin.user.history");
    }
    public function historydata(){
        // $today = Carbon::now()->format('Y-m-d');
        $Spreadsheet = Histories::with('status')->get();
        // $Spreadsheet = Spreadsheet::whereHas('status')->where('status_id',3)->whereDate('created_at', '=' , $today)->get();
        return $Spreadsheet;
    }
     public function move(){
        Spreadsheet::query()
        ->each(function ($oldRecord) {
          $newRecord = $oldRecord->replicate();
          $newRecord->setTable('histories');
          $newRecord->save();
          $oldRecord->delete();
        });
        return redirect()->route('user.history')->with('message', "all record has been moved there");
     }
}
