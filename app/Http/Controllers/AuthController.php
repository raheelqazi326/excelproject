<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
class AuthController extends Controller
{
    public function index(){
        return view('admin.auth.login');
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
