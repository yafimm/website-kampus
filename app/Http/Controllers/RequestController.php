<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('role:admin');
    }

    public function getMonth($month) {
        $bulan = 'none';
        switch ($month) {
            case '01':
                $bulan = 'Januari';
                break;
            case '02':
                $bulan = 'Februari';
                break;
            case '03':
                $bulan = 'Maret';
                break;
            case '04':
                $bulan = 'April';
                break;
            case '05':
                $bulan = 'Maret';
                break;
            case '06':
                $bulan = 'Juni';
                break;
            case '07':
                $bulan = 'Juli';
                break;
            case '08':
                $bulan = 'Agustus';
                break;
            case '09':
                $bulan = 'September';
                break;
            case '10':
                $bulan = 'Oktober';
                break;
            case '11':
                $bulan = 'November';
                break;
            case '12':
                $bulan = 'Desember';
                break;
            default:
                $bulan = 'Gak Ada';
                break;
        }
        return $bulan;
     }

    public function index(){
        $data_request = DB::table('request_barang')
        ->join('users', 'request_barang.user_id', '=', 'users.id')
        ->join('barang', 'request_barang.b_id', '=', 'barang.b_id')
        ->select('request_barang.rb_id', 'users.name', 'barang.b_nama', 'request_barang.rb_jumlah', 'request_barang.rb_status', 'request_barang.created_at','request_barang.updated_at')
        ->get();
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

    public function prosesKonfirmasi(Request $request){
        $id = null;
        $jenis = null;
        if($request->post('jenis') == 1){
            $id = $request->post('idtolak');
            $jenis = 1;
        }else if($request->post('jenis') == 2){
            $id = $request->post('idsetuju');
            $jenis = 2;
        }
        if($jenis == 2){
            $data_request = DB::table('request_barang')
            ->where('request_barang.rb_id', $id)
            ->get();
            $data_barang = DB::table('barang')
            ->where('barang.b_id', $data_request[0]->b_id)
            ->get();
            if($data_barang[0]->b_stock < $data_request[0]->rb_jumlah){
                echo "<script>alert('Gagal, Stock barang tidak cukup')
                    ;window.location='".url('/admin/request')."'</script>";
            }else{
                DB::table('request_barang')->where('rb_id',$id)->update([
                    'rb_status' => $jenis
                ]);
                $jumlah_barang = $data_barang[0]->b_stock - $data_request[0]->rb_jumlah;
                DB::table('barang')->where('b_id',$data_barang[0]->b_id)->update([
                    'b_stock' => $jumlah_barang
                ]);
            }
        }else{
            DB::table('request_barang')->where('rb_id',$id)->update([
                'rb_status' => $jenis
            ]);
        }
        return redirect()->route('request.indexx');
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

    public function prosesHapus(Request $request){
        $id = $request->post('idhapus');
        DB::table('request_barang')->where('rb_id',$id)->delete();
        return redirect()->route('request.index');
    }

    public function tambah(){
        $data_barang = DB::table('barang')->get();
        return view('request.tambah', compact('data_barang'));
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
        return redirect()->route('request.index');
    }

    public function ubah($id){
        $data_request = DB::table('request_barang')
        ->join('users', 'request_barang.user_id', '=', 'users.id')
        ->join('barang', 'request_barang.b_id', '=', 'barang.b_id')
        ->select('request_barang.rb_id', 'users.name', 'request_barang.b_id','barang.b_nama','barang.b_foto', 'request_barang.rb_jumlah', 'request_barang.rb_status', 'request_barang.created_at','request_barang.updated_at')
        ->where('request_barang.rb_id', $id)
        ->get();
        $data_barang = DB::table('barang')->get();
        return view('request.ubahRequest', compact('data_request', 'data_barang'));
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
        return redirect()->route('request.index');
    }

}
