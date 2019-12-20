<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class AdminDataPenggunaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index(){
        //$data_pengguna = DB::table('users')->get();
        $data_pengguna = DB::table('users')->where('role','!=', 'admin')->get();
        return view('admin.dataPengguna', compact('data_pengguna'));
    }
    public function tambah($jenis){
        return view('admin.tambahPengguna', compact('jenis'));
    }
    public function ubah($id){
        $data_pengguna = DB::table('users')->where('id',$id)->get();
        return view('admin.ubahPengguna', compact('data_pengguna'));
    }
    public function lihat($id){
        $data_pengguna = DB::table('users')->where('id',$id)->get();
        return view('admin.lihatPengguna', compact('data_pengguna'));
    }

    public function prosesTambah(Request $request){
        //dd($request);
        $user = new User();
        $user->role = $request->post('role');
        $user->npm = $request->post('npm');
        $user->nip = $request->post('nip');
        $user->name = $request->post('nama');
        $user->email = $request->post('email');
        $user->password = bcrypt($request->post('password'));
        $user->save();
        return redirect(url('/admin/pengguna'));
    }

    public function prosesUbah(Request $request){
        $u_role = $request->post('role');
        $u_npm = $request->post('npm');
        $u_nip = $request->post('nip');
        $u_nama = $request->post('nama');
        $u_email = $request->post('email');
        $u_id = $request->post('id');

        DB::table('users')->where('id',$u_id)->update([
            'role' => $u_role,
            'npm' => $u_npm,
            'nip' => $u_nip,
            'name' => $u_nama,
            'email' => $u_email
        ]);
        return redirect(url('/admin/pengguna'));
    }

    public function prosesUbahPassword(Request $request){
        $id = $request->post('iduser');
        $password = bcrypt($request->post('password'));
        DB::table('users')->where('id',$id)->update([
            'password' => $password
        ]);
        return redirect(url('/admin/pengguna'));
    }

    public function prosesHapus(Request $request){
        $id = $request->post('id');
        DB::table('users')->where('id',$id)->delete();
        return redirect(url('/admin/pengguna'));
    }

}
