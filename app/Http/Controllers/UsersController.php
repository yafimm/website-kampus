<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Peminjaman;
use DB;
use Auth;
use PDF;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('role:admin');
    }

    public function index(){
        //$data_pengguna = DB::table('users')->get();
        $data_pengguna = User::where('role','!=', 'admin')->orderBy('id', 'desc')->get();
        return view('user.dataPengguna', compact('data_pengguna'));
    }

    public function dashboard(){
        $data_request = DB::table('request_barang')
        ->join('users', 'request_barang.user_id', '=', 'users.id')
        ->join('barang', 'request_barang.b_id', '=', 'barang.b_id')
        ->select('request_barang.rb_id', 'users.name', 'barang.b_nama', 'request_barang.rb_jumlah', 'request_barang.rb_status', 'request_barang.created_at','request_barang.updated_at')
        ->orderBy('rb_status', 'asc')
        ->get();

        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('staff_inventaris')){
          $data_peminjaman = Peminjaman::orderBy('created_at','desc')->orderBy('p_status', 'asc')->get();
          $data_peminjaman_sukses = DB::table('peminjaman')
          ->join('users', 'peminjaman.user_id', '=', 'users.id')
          ->select('peminjaman.p_id', 'users.name', 'peminjaman.p_date',
          'peminjaman.p_date_end', 'peminjaman.p_time_start', 'peminjaman.p_time_end',
          'peminjaman.p_scan_surat_peminjaman', 'peminjaman.p_status', 'peminjaman.created_at',
          'peminjaman.updated_at', 'peminjaman.p_nama_event')
          ->where('peminjaman.p_status','1')
          ->get();
        }else{
          $data_peminjaman = Peminjaman::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->orderBy('p_status', 'asc')->get();
          $data_peminjaman_sukses = DB::table('peminjaman')
          ->join('users', 'peminjaman.user_id', '=', 'users.id')
          ->select('peminjaman.p_id', 'users.name', 'peminjaman.p_date',
          'peminjaman.p_date_end', 'peminjaman.p_time_start', 'peminjaman.p_time_end',
          'peminjaman.p_scan_surat_peminjaman', 'peminjaman.p_status', 'peminjaman.created_at',
          'peminjaman.updated_at', 'peminjaman.p_nama_event')
          ->where('peminjaman.p_status','1')
          ->get();
        }
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
        $user = new User();
        $user->role = $request->post('role');
        $user->npm = $request->post('npm');
        $user->nip = $request->post('nip');
        $user->name = $request->post('nama');
        $user->email = $request->post('email');
        $user->password = bcrypt($request->post('password'));
        $user->save();
        return redirect()->route('user.index')->with('alert-class','alert-success')->with('flash_message', 'Data Pengguna berhasil ditambahkan !!');
    }

    public function prosesUbah(Request $request){
        User::findOrFail($request->id)->update([
            'role' => $request->role,
            'npm' => $request->npm,
            'nip' => $request->nip,
            'name' => $request->nama,
            'email' => $request->email
        ]);
        return redirect()->route('user.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data pengguna berhasil diubah !!');
    }

    public function prosesUbahPassword(Request $request){
        $password = bcrypt($request->post('password'));
        User::findOrFail($request->iduser)->update([
            'password' => $password
        ]);
        return redirect()->route('user.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data pengguna berhasil diubah kata sandinya !!');
    }

    public function prosesHapus(Request $request){
        User::findOrFail($request->id)->delete();
        return redirect()->route('user.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data pengguna berhasil dihapus');
    }

    public function cetak(Request $request)
    {
      $data_users = User::where([['created_at','>=', date('Y-m-d', strtotime($request->mulai))], ['created_at','<=', date('Y-m-d', strtotime($request->akhir))]])->orderBy('role', 'desc')->get();
      $pdf = PDF::loadview('user.laporan_user_pdf', ['data_users'=>$data_users, 'mulai' => $request->mulai, 'akhir' => $request->akhir]);
      return $pdf->download('laporan-data-user.pdf');
    }
}
