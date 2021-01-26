<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Histories;
use App\Models\Spreadsheet;
use App\Models\excel_files;
use Carbon\Carbon;
use DataTables;

class HistoryController extends Controller
{
    public function history(){
        return view("admin.file.history");
    }
    public function historyDelete(Request $request){
        return $request->all();
    }
    public function historydata(){
        // $today = Carbon::now()->format('Y-m-d');
        // $Spreadsheet = Histories::with('status')->get();
        return DataTables::of(Histories::with('status'))->toJson();

        // $Spreadsheet = Spreadsheet::whereHas('status')->where('status_id',3)->whereDate('created_at', '=' , $today)->get();
       
    }
     public function move(){
        Spreadsheet::query()
        ->each(function ($oldRecord) {
          $newRecord = $oldRecord->replicate();
          $newRecord->setTable('histories');
          $newRecord->save();
          $oldRecord->delete();
        });
        return redirect()->route('file.history')->with('message', "all record has been moved there");
     }

     public function SheetSave(Request $request){

        $file = $request->file('file');
        $onlyfilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filename = md5($onlyfilename).'-'.time().'.'.$file->getClientOriginalExtension();
        $destinationPath = 'uploads';
        $file->move($destinationPath,$filename);
        $filepath = $destinationPath.'/'.$filename;
        $savefile = new excel_files;
        $savefile->filename=$onlyfilename.'-'.Carbon::now()->format('d-m-Y h:i:sa');
        $savefile->filepath=$filepath;
        $savefile->save();
        return "file save";
     }

     public function downloadfile(){
        return view("admin.file.download");
    }

    public function filedata(){
        return excel_files::all();
    }
}
