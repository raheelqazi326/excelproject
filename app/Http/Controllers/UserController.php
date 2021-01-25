<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\Role;
use App\Models\User;
use Hash;
use App\Models\Spreadsheet;
use Carbon\Carbon;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role_id','3')->get();
        return view('admin.user.index',compact('users'));
    }

    public function indexajax()
    {
        $users = User::where('role_id','3')->get();
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $adduser = new User;
        $adduser->first_name =$request->first_name;
        $adduser->last_name =$request->last_name;
        $adduser->username  =$request->user_name;
        $adduser->email   =$request->email;
        $adduser->password   =Hash::make($request->password);
        $adduser->role_id ='3';
        $adduser->status ='active';
        $adduser->save();
        return 1;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $updateuser = User::find($request->userid);
        $updateuser->first_name =$request->first_name;
        $updateuser->last_name =$request->last_name;
        $updateuser->username  =$request->user_name;
        $updateuser->email   =$request->email;
        if ($request->password !==null) {
            $updateuser->password   =Hash::make($request->password);
        }
        $updateuser->role_id ='3';
        $updateuser->save();
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        User::find($id)->delete();
        return 1;
    }

    public function status(Request $request){
        // return $request;
        $updatestatus = User::find($request->userid);
        $updatestatus->status=$request->status;
        $updatestatus->save();
        return 'updated';
    }

    public function emailavail(Request $request){
        $check = User::where('email',$request->email)->first();
        if ($check !=null) {
            $check = User::where('username',$request->username)->first();

            if ($check !=null) {    
                return "emailuserexist";
            }else{
                return "emailexist";
            }
        }else{
            $check = User::where('username',$request->username)->first();

            if ($check !=null) {    
                return "userexist";
            }else{
                return "notexist";
            }
        }
    }

    public function history(){
        return view("admin.user.history");
    }
    public function historydata(){
        $today = Carbon::now()->format('Y-m-d');
        
        $Spreadsheet = Spreadsheet::whereHas('status')->where('status_id',3)->whereDate('created_at', '=' , $today)->get();
        return $Spreadsheet;
    }
}
