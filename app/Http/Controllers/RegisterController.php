<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct()
    {

    }

    public function getRegisterBagUmum(){
        return view('auth.petugasRegister');
    }
    public function getRegisterMahasiswa(){
        return view('auth.mahasiswaRegister');
    }
    public function getRegisterOrmawa(){
        return view('auth.ormawaRegister');
    }
    public function getRegisterDosen(){
        return view('auth.dosenRegister');
    }

    public function postRegister(Request $request){
        //dd($request);
        $user = new User();
        $user->role = $request->post('role');
        $user->npm = $request->post('npm');
        $user->nip = $request->post('nip');
        $user->name = $request->post('nama');
        $user->email = $request->post('email');
        $user->password = bcrypt($request->post('password'));
        $user->save();

        Auth::loginUsingId($user->id);
        return redirect('/login');
    }
}
