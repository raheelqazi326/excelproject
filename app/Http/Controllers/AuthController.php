<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
class AuthController extends Controller
{
    public function index(){
        return view('admin.auth.login');
    }

    public function password(Request $request){
        $changepass = User::find($request->userid);
        $changepass->password=Hash::make($request->password);
        $changepass->save();
        return 1;
    }

    public function login(Request $request){

        $credentials = [
            "email" => $request->email,
            "password" => $request->password
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('sheet.list');
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
        

    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }
}
