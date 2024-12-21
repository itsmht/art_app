<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    function login()
    {
        return view('auth.login');
    }
    function loginSubmit(Request $req)
    {
        
        $req->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'Please Enter Your Email Address',
                //'email.email' => 'Please Enter A Valid Email Address',
                'password.required' => 'Please Enter Your Password',
            ]

        ); //Validating User Authentication Information
        $user = User::where('email', $req->email)->where('password',$req->password)->first(); //Authentication
        if($user)
        {
            session()->put('logged', $user->email);
            return redirect()->route('adminDashboard');
        }
        else
        {
            return redirect()->route("login")->with('message','The credentials does not match!');
        }
    }
    function logout()
    {
        session()->forget('logged'); //Session destroyed
        session()->flash('msg','Sucessfully Logged out');
        return redirect()->route('login');
    }
}
