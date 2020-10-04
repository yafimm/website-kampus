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
    public function index(){
        // $data_request = DB::table('request_barang')
        // ->join('users', 'request_barang.user_id', '=', 'users.id')
        // ->join('barang', 'request_barang.b_id', '=', 'barang.b_id')
        // ->select('request_barang.rb_id', 'users.name', 'barang.b_nama', 'request_barang.rb_jumlah', 'request_barang.rb_status', 'request_barang.created_at','request_barang.updated_at')
        // ->orderBy('rb_id', 'desc')->get();
        // dd(RequestBarang::all());
        $data_request = RequestBarang::orderBy('rb_status', 'asc')->orderBy('created_at', 'desc')->get();
        return view('request.index', compact('data_request'));
    }

    public function lihat($id){
        // $data_request = DB::table('request_barang')
        // ->join('users', 'request_barang.user_id', '=', 'users.id')
        // ->join('barang', 'request_barang.b_id', '=', 'barang.b_id')
        // ->select('request_barang.rb_id', 'users.name', 'barang.b_nama','barang.b_foto', 'request_barang.rb_jumlah', 'request_barang.rb_status', 'request_barang.created_at','request_barang.updated_at')
        // ->where('request_barang.rb_id','=', $id)
        // ->get();
        $data_request = RequestBarang::findOrFail($id);
        return view('request.lihatRequest', compact('data_request'));
    }

    public function prosesKonfirmasi(RequestBarangRequest $request){
        if($request->post('jenis') == 1){
            //Ini kalo ditolak
            $id = $request->post('idtolak');
            $jenis = 1;
            $data_request = RequestBarang::find($id);
            $data_request->update(['rb_status' => $jenis]);
            return redirect()->route('request.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data Request berhasil ditolak !!');
        }else if($request->post('jenis') == 2){
            //Ini kalo data disetujui
            $id = $request->post('idsetuju');
            $jenis = 2;
            $data_request = RequestBarang::find($id);
            $data_barang = Barang::find($data_request->b_id);
            if($data_barang->getStok() < $data_request->rb_jumlah){
              // gagal disetujui karena stok habis
              return redirect()->route('request.index')->with('alert-class', 'alert-danger')->with('flash_message', 'Gagal, Stock barang tidak mencukupi !!');
            }else{
              //Ini berhasil disetujui, dibawah stock permintannnya
              $data_request->update(['rb_status' => $jenis]);
              $jumlah_barang = $data_barang->b_stock - $data_request->rb_jumlah;
              $data_barang->update(['b_stock' => $jumlah_barang]);
              return redirect()->route('request.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data Request berhasil disetujui !!');
            }
        }
        else if($request->post('jenis') == 3){
            $id = $request->post('idsetuju');
            $jenis = 3;
            $data_request = RequestBarang::find($id);
            $data_request->update(['rb_status' => $jenis]);
            return redirect()->route('request.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data Request berhasil disetujui !!');
        }
        //Ini kalo ada kesalahan konfirmasi, penyebabnya dari id tolak dan disetujuinya
        return redirect()->route('request.index')->with('alert-class', 'alert-danger')->with('flash_message', 'Data Request Gagal dikonfirmasi !!');
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

    public function loadData(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $dataBarang = DB::table('barang')->select('b_id', 'b_kode', 'b_nama')->where('b_kode', 'LIKE', '%'.$cari.'%')->orWhere('b_nama', 'LIKE', '%'.$cari.'%')->take(10)->get();
            return response()->json($data);
        }
    }

    public function cetakTanggal(Request $request){
      $data_request = RequestBarang::where([['created_at','>=', date('Y-m-d', strtotime($request->mulai))], ['created_at','<=', date('Y-m-d', strtotime($request->akhir))]])->get();
      $pdf = PDF::loadview('request.laporan_request_tanggal_pdf', ['data_request'=>$data_request, 'mulai' => $request->mulai, 'akhir' => $request->akhir]);
      // return $pdf->download('laporan-data-request.pdf');
      return $pdf->stream();
    }

    public function cetak($id)
    {
        $data_request = RequestBarang::find($id);
        if(\Auth::user()->id == $data_request->user_id)
        {
            $pdf = PDF::loadview('request.laporan_request_pdf', ['data_request'=>$data_request]);
            // return $pdf->download('laporan-data-request-'.$data_request->rb_id.'.pdf');
            return $pdf->stream();
        }
    }




}
