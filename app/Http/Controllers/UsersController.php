<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('role:admin');
    }

    public function index(){
        //$data_pengguna = DB::table('users')->get();
        $data_pengguna = DB::table('users')->where('role','!=', 'admin')->get();
        return view('user.dataPengguna', compact('data_pengguna'));
    }

    public function dashboard(){
        $data_request = DB::table('request_barang')
        ->join('users', 'request_barang.user_id', '=', 'users.id')
        ->join('barang', 'request_barang.b_id', '=', 'barang.b_id')
        ->select('request_barang.rb_id', 'users.name', 'barang.b_nama', 'request_barang.rb_jumlah', 'request_barang.rb_status', 'request_barang.created_at','request_barang.updated_at')
        ->get();

        $data_peminjaman = DB::table('peminjaman')
        ->join('users', 'peminjaman.user_id', '=', 'users.id')
        ->select('peminjaman.p_id', 'users.name', 'peminjaman.p_date',
        'peminjaman.p_date_end', 'peminjaman.p_time_start', 'peminjaman.p_time_end',
        'peminjaman.p_scan_surat_peminjaman', 'peminjaman.p_status', 'peminjaman.created_at',
        'peminjaman.updated_at')
        ->get();
        return view('user.dashboard', compact('data_request','data_peminjaman'));
    }

    public function tambah($jenis){
        return view('user.tambahPengguna', compact('jenis'));
    }
    public function ubah($id){
        $data_pengguna = DB::table('users')->where('id',$id)->get();
        return view('user.ubahPengguna', compact('data_pengguna'));
    }
    public function lihat($id){
        $data_pengguna = DB::table('users')->where('id',$id)->get();
        return view('user.lihatPengguna', compact('data_pengguna'));
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
        return redirect()->route('user.index');
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
        return redirect()->route('user.index');
    }

    public function prosesUbahPassword(Request $request){
        $id = $request->post('iduser');
        $password = bcrypt($request->post('password'));
        DB::table('users')->where('id',$id)->update([
            'password' => $password
        ]);
        return redirect()->route('user.index');
    }

    public function prosesHapus(Request $request){
        $id = $request->post('id');
        DB::table('users')->where('id',$id)->delete();
        return redirect()->route('user.index');
    }
}
