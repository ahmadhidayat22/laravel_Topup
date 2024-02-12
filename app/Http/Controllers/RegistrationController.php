<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class RegistrationController extends Controller
{
    public function index(){
        return view('register.index');
    }

    public function store(Request $request){
        $rules = [
            'name' => 'required|max:255',
            'username' => 'required|min:4|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:6|max:255',
            'policy' => 'required'

        ];

        $validatedData = $request->validate($rules);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $newdata = ['saldo' => 0, 'role' => 'user'];
        $newvalidate = array_merge($validatedData , $newdata);
        // dd($newvalidate);
        // dd($validatedData);
        User::create($newvalidate);
        
        // $request->session()->flash('success','Registration successfull! Please login');
        
        return redirect('/login')->with('success','Registration successfull! Please login');

    }


}
