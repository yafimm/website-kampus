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
            // if(Auth::user()->role == 'mahasiswa' || Auth::user()->role == 'ormawa'){
            //     return redirect('/user/dashboard');
            // }else if(Auth::user()->role == 'admin'){
            //     return redirect('/admin/dashboard');
            // }else if(Auth::user()->role == 'bagumum'){
            //     return redirect('/bagumum/dashboard');
            // }else if(Auth::user()->role == 'dosen'){
            //     return redirect('/dosen/dashboard');
            // }
            return redirect('dashboard');
        }else{
            return view('auth.viewLogin');
        }
    }

    public function postLogin(Request $request){
         //dd($request);
         $email = $request->post('email');
         $password = $request->post('password');
         if(Auth::attempt(['email' => $email, 'password' => $password])){
            // if(Auth::user()->role == 'mahasiswa' || Auth::user()->role == 'ormawa'){
            //     return redirect('/user/dashboard');
            // }else if(Auth::user()->role == 'admin'){
            //     return redirect('/admin/dashboard');
            // }else if(Auth::user()->role == 'bagumum'){
            //     return redirect('/bagumum/dashboard');
            // }else if(Auth::user()->role == 'dosen'){
            //     return redirect('/dosen/dashboard');
            // }
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
