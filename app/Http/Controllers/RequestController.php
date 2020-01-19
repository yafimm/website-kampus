<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestBarangRequest;
use PDF;
use DB;
use App\Request as RequestBarang;
use App\Barang;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('role:admin');
    }

    public function index(){
        $data_request = DB::table('request_barang')
        ->join('users', 'request_barang.user_id', '=', 'users.id')
        ->join('barang', 'request_barang.b_id', '=', 'barang.b_id')
        ->select('request_barang.rb_id', 'users.name', 'barang.b_nama', 'request_barang.rb_jumlah', 'request_barang.rb_status', 'request_barang.created_at','request_barang.updated_at')
        ->orderBy('rb_id', 'desc')->get();
        return view('request.index', compact('data_request'));
    }

    public function lihat($id){
        $data_request = DB::table('request_barang')
        ->join('users', 'request_barang.user_id', '=', 'users.id')
        ->join('barang', 'request_barang.b_id', '=', 'barang.b_id')
        ->select('request_barang.rb_id', 'users.name', 'barang.b_nama','barang.b_foto', 'request_barang.rb_jumlah', 'request_barang.rb_status', 'request_barang.created_at','request_barang.updated_at')
        ->where('request_barang.rb_id', $id)
        ->get();
        return view('request.lihatRequest', compact('data_request'));
    }

    public function prosesKonfirmasi(RequestBarangRequest $request){
        if($request->post('jenis') == 1){
            $id = $request->post('idtolak');
            $jenis = 1;
        }else if($request->post('jenis') == 2){
            $id = $request->post('idsetuju');
            $jenis = 2;
            $data_request = RequestBarang::find($id);
            $data_barang = Barang::find($data_request->b_id);
            if($data_barang->b_stock < $data_request->rb_jumlah){
              echo "<script>alert('Gagal, Stock barang tidak cukup')
              ;window.location='".route('request.index')."'</script>";
            }else{
              $data_request->update(['rb_status' => $jenis]);
              $jumlah_barang = $data_barang->b_stock - $data_request->rb_jumlah;
              $data_barang->update(['b_stock' => $jumlah_barang]);
            }
        }

        return redirect()->route('request.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data Request berhasil disetujui !!');
    }

    public function prosesHapus(RequestBarangRequest $request){
        RequestBarang::findOrFail($request->idhapus)->delete();
        return redirect()->route('request.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data berhasil dihapus !!');
    }

    public function tambah(){
        $data_barang = Barang::all();
        return view('request.tambah', compact('data_barang'));
    }

    public function prosesTambah(Request $request){
        // kenapa pake requesst all, karena kolom sama name di input tambahnya sesuai
        RequestBarang::create(['user_id' => $request->iduser,
                              'b_id' => $request->idBarang,
                              'rb_jumlah' => $request->jumlah,
                              'rb_status' => $request->status]);

        return redirect()->route('request.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data berhasil ditambahkan !!');
    }

    public function ubah($id){
        $data_request = DB::table('request_barang')
        ->join('users', 'request_barang.user_id', '=', 'users.id')
        ->join('barang', 'request_barang.b_id', '=', 'barang.b_id')
        ->select('request_barang.rb_id', 'users.name', 'request_barang.b_id','barang.b_nama','barang.b_foto', 'request_barang.rb_jumlah', 'request_barang.rb_status', 'request_barang.created_at','request_barang.updated_at')
        ->where('request_barang.rb_id', $id)
        ->first();
        $data_barang = Barang::all();
        return view('request.ubahRequest', compact('data_request', 'data_barang'));
    }

    public function prosesUbah(Request $request, $id){

        RequestBarang::findOrFail($id)
                      ->update(['user_id' => $request->iduser,
                                'b_id' => $request->idBarang,
                                'rb_jumlah' => $request->jumlah,
                                'rb_status' => $request->status,
                                ]);

        return redirect()->route('request.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data Request Barang berhasil diubah !!');
    }

    public function cetakTahunan(Request $request){
        $parameter= $request->post('tahunan')."%";
        $data_request = DB::table('request_barang')
        ->join('users', 'request_barang.user_id', '=', 'users.id')
        ->join('barang', 'request_barang.b_id', '=', 'barang.b_id')
        ->select('request_barang.rb_id', 'users.name', 'barang.b_nama', 'request_barang.rb_jumlah', 'request_barang.rb_status', 'request_barang.created_at','request_barang.updated_at')
        ->where('request_barang.created_at', 'like', $parameter)
        ->get();
        $pdf = PDF::loadView('admin.laporan_request_pdf',['data_request'=>$data_request, 'data_status'=>$request->post('tahunan')]);
    	return $pdf->download('laporan-data-request.pdf');
    }
    public function cetakBulanan(Request $request){
        $myArray = explode(' ', $request->post('bulanan'));
        $parameter= $myArray[1]."-".$myArray[0]."%";
        $bulan = $this->getMonth($myArray[0]);
        $data_request = DB::table('request_barang')
        ->join('users', 'request_barang.user_id', '=', 'users.id')
        ->join('barang', 'request_barang.b_id', '=', 'barang.b_id')
        ->select('request_barang.rb_id', 'users.name', 'barang.b_nama', 'request_barang.rb_jumlah', 'request_barang.rb_status', 'request_barang.created_at','request_barang.updated_at')
        ->where('request_barang.created_at', 'like', $parameter)
        ->get();
        $pdf = PDF::loadView('admin.laporan_request_pdf',['data_request'=>$data_request,'data_status'=>$bulan." ".$myArray[1]]);
    	return $pdf->download('laporan-data-request.pdf');
    }
    public function cetakTanggal(Request $request){
        $myArray = explode('-', $request->post('harian'));
        $parameter= $myArray[2]."-".$myArray[0]."-".$myArray[1]."%";
        $bulan = $this->getMonth($myArray[0]);
        $data_request = DB::table('request_barang')
        ->join('users', 'request_barang.user_id', '=', 'users.id')
        ->join('barang', 'request_barang.b_id', '=', 'barang.b_id')
        ->select('request_barang.rb_id', 'users.name', 'barang.b_nama', 'request_barang.rb_jumlah', 'request_barang.rb_status', 'request_barang.created_at','request_barang.updated_at')
        ->where('request_barang.created_at', 'like', $parameter)
        ->get();
        $pdf = PDF::loadView('admin.laporan_request_pdf',['data_request'=>$data_request,'data_status'=>$myArray[1]." ".$bulan." ".$myArray[1]]);
    	return $pdf->download('laporan-data-request.pdf');
    }


}
