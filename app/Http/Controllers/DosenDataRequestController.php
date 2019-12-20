<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class DosenDataRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:dosen');
    }

    public function index(){
        $data_request = DB::table('request_barang')
        ->join('users', 'request_barang.user_id', '=', 'users.id')
        ->join('barang', 'request_barang.b_id', '=', 'barang.b_id')
        ->select('request_barang.rb_id', 'users.name', 'barang.b_nama', 'request_barang.rb_jumlah', 'request_barang.rb_status', 'request_barang.created_at','request_barang.updated_at')
        ->where('request_barang.user_id',Auth::user()->id)
        ->get();
        return view('dosen.dataRequest', compact('data_request'));
    }

    public function prosesHapus(Request $request){
        $id = $request->post('idhapusRequest');
        DB::table('request_barang')->where('rb_id',$id)->delete();
        return redirect(url('/dosen/request'));
    }

    public function prosesTambah(Request $request){
        $status = $request->post('status');
        $iduser = $request->post('iduser');
        $idBarang = $request->post('idBarang');
        $jumlah = $request->post('jumlah');
        DB::table('request_barang')->insert(
            ['user_id' => $iduser,
            'b_id' => $idBarang,
            'rb_jumlah' => $jumlah, 
            'rb_status' => $status, 
            'created_at' => now(), 
            'updated_at' => now()]
        );
        return redirect(url('/dosen/request'));
    }

    public function lihat($id){
        $data_request = DB::table('request_barang')
        ->join('users', 'request_barang.user_id', '=', 'users.id')
        ->join('barang', 'request_barang.b_id', '=', 'barang.b_id')
        ->select('request_barang.rb_id', 'users.name', 'barang.b_nama','barang.b_foto', 'request_barang.rb_jumlah', 'request_barang.rb_status', 'request_barang.created_at','request_barang.updated_at')
        ->where('request_barang.rb_id', $id)
        ->get();
        return view('dosen.lihatRequest', compact('data_request'));
    }

    public function ajukan(){
        $data_barang = DB::table('barang')->get();
        return view('dosen.ajukanRequest', compact('data_barang'));
    }

    public function ubah($id){
        $data_request = DB::table('request_barang')
        ->join('users', 'request_barang.user_id', '=', 'users.id')
        ->join('barang', 'request_barang.b_id', '=', 'barang.b_id')
        ->select('request_barang.rb_id', 'users.name', 'request_barang.b_id','barang.b_nama','barang.b_foto', 'request_barang.rb_jumlah', 'request_barang.rb_status', 'request_barang.created_at','request_barang.updated_at')
        ->where('request_barang.rb_id', $id)
        ->get();
        $data_barang = DB::table('barang')->get();
        return view('dosen.ubahRequest', compact('data_request', 'data_barang'));
    }

    public function prosesUbah(Request $request){
        $idrequest = $request->post('idrequest');
        $status = $request->post('status');
        $iduser = $request->post('iduser');
        $idBarang = $request->post('idBarang');
        $jumlah = $request->post('jumlah');
        DB::table('request_barang')
        ->where('rb_id',$idrequest)
        ->update(
            ['user_id' => $iduser,
            'b_id' => $idBarang,
            'rb_jumlah' => $jumlah, 
            'rb_status' => $status, 
            'updated_at' => now()]
        );
        return redirect(url('/dosen/request'));
    }

}
