<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index(){
        return view('login.login');
    }

    public function auth(Request $request){
        $creds = $request->validate([
            // 'email' => 'required|email:dns',
            'username' => 'required',
            'password' => 'required'

        ]);

        $remember_me = $request->has('remember_me') ? true : false; 

        if (Auth::attempt($creds,$remember_me)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginEror', 'Login Failed!');
    }

    public function logout(request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
