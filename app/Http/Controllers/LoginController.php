<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {

    }

    public function getLogin(){
        if(Auth::check()){
            return redirect('dashboard');
        }else{
            return view('auth.viewLogin');
        }
    }

    public function postLogin(Request $request){
         $email = $request->post('email');
         $password = $request->post('password');
         if(Auth::attempt(['email' => $email, 'password' => $password])){
            return redirect('dashboard');
         }else{
            return redirect()->route('login')->with('alert-class', 'alert-danger')->with('flash_message', 'Email atau password salah !!');
         }
    }

    public function postLogout(){
        Auth::logout();
        return redirect('/login');
   }
}
