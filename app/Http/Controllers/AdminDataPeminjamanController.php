<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class AdminDataPeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
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
        $data_peminjaman = DB::table('peminjaman')
        ->join('users', 'peminjaman.user_id', '=', 'users.id')
        ->select('peminjaman.p_id', 'users.name', 'peminjaman.p_date', 
        'peminjaman.p_date_end', 'peminjaman.p_time_start', 'peminjaman.p_time_end', 
        'peminjaman.p_scan_surat_peminjaman', 'peminjaman.p_status', 'peminjaman.created_at',
        'peminjaman.updated_at')
        ->get();

        $data_peminjaman_sukses = DB::table('peminjaman')
        ->join('users', 'peminjaman.user_id', '=', 'users.id')
        ->select('peminjaman.p_id', 'users.name', 'peminjaman.p_date', 
        'peminjaman.p_date_end', 'peminjaman.p_time_start', 'peminjaman.p_time_end', 
        'peminjaman.p_scan_surat_peminjaman', 'peminjaman.p_status', 'peminjaman.created_at',
        'peminjaman.updated_at', 'peminjaman.p_nama_event')
        ->where('peminjaman.p_status','1')
        ->get();
        $today = date("Y-m-d"); 
        return view('admin.dataPeminjaman', compact('data_peminjaman', 'data_peminjaman_sukses', 'today'));
    }

    public function lihat($id){
        $data_peminjaman = DB::table('peminjaman')
        ->join('users', 'peminjaman.user_id', '=', 'users.id')
        ->select('peminjaman.p_id', 'users.name', 'peminjaman.p_date', 
        'peminjaman.p_date_end', 'peminjaman.p_time_start', 'peminjaman.p_time_end', 
        'peminjaman.p_scan_surat_peminjaman', 'peminjaman.p_status', 'peminjaman.created_at',
        'peminjaman.updated_at')
        ->where('peminjaman.p_id', $id)
        ->get();
        $data_peminjaman[0]->detail_peminjaman = DB::table('table_data_detail_peminjaman')
        ->join('peminjaman', 'table_data_detail_peminjaman.p_id', '=', 'peminjaman.p_id')
        ->join('inventaris', 'table_data_detail_peminjaman.i_id', '=', 'inventaris.i_id')
        ->select('table_data_detail_peminjaman.i_id', 'peminjaman.p_id', 'inventaris.i_nama', 
        'table_data_detail_peminjaman.dp_jumlah', 'table_data_detail_peminjaman.created_at',
        'table_data_detail_peminjaman.updated_at')
        ->where('table_data_detail_peminjaman.p_id', $data_peminjaman[0]->p_id)
        ->get();
        return view('admin.lihatPeminjaman', compact('data_peminjaman'));
    }

    public function prosesKonfirmasi(Request $request){
        $id = null;
        $jenis = null;
        if($request->post('jenis') == 1){
            $id = $request->post('idtolak');
            $jenis = 2;
        }else if($request->post('jenis') == 2){
            $id = $request->post('idsetuju');
            $jenis = 1;
        }
        DB::table('peminjaman')->where('p_id',$id)->update([
            'p_status' => $jenis
        ]);
        return redirect(url('/admin/peminjaman'));
    }

    public function cetakTahunan(Request $request){
        $parameter= $request->post('tahunan')."%";
        $data_peminjaman = DB::table('peminjaman')
        ->join('users', 'peminjaman.user_id', '=', 'users.id')
        ->select('peminjaman.p_id', 'users.name', 'peminjaman.p_date', 
        'peminjaman.p_date_end', 'peminjaman.p_time_start', 'peminjaman.p_time_end', 
        'peminjaman.p_scan_surat_peminjaman', 'peminjaman.p_status', 'peminjaman.created_at',
        'peminjaman.updated_at')
        ->where('peminjaman.created_at', 'like', $parameter)
        ->get();
        for($i = 0; $i < count($data_peminjaman); $i++){
            $data_peminjaman[$i]->detail_peminjaman = DB::table('table_data_detail_peminjaman')
            ->join('peminjaman', 'table_data_detail_peminjaman.p_id', '=', 'peminjaman.p_id')
            ->join('inventaris', 'table_data_detail_peminjaman.i_id', '=', 'inventaris.i_id')
            ->select('table_data_detail_peminjaman.i_id', 'peminjaman.p_id', 'inventaris.i_nama', 
            'table_data_detail_peminjaman.dp_jumlah', 'table_data_detail_peminjaman.created_at',
            'table_data_detail_peminjaman.updated_at')
            ->where('table_data_detail_peminjaman.p_id', $data_peminjaman[$i]->p_id)
            ->get();
        }
        $pdf = PDF::loadView('admin.laporan_peminjaman_pdf',['data_peminjaman'=>$data_peminjaman, 'data_status'=>$request->post('tahunan')]);
    	return $pdf->download('laporan-data-peminjaman.pdf');
    }
    public function cetakBulanan(Request $request){
        $myArray = explode(' ', $request->post('bulanan'));
        $parameter= $myArray[1]."-".$myArray[0]."%";
        $bulan = $this->getMonth($myArray[0]);
        $data_peminjaman = DB::table('peminjaman')
        ->join('users', 'peminjaman.user_id', '=', 'users.id')
        ->select('peminjaman.p_id', 'users.name', 'peminjaman.p_date', 
        'peminjaman.p_date_end', 'peminjaman.p_time_start', 'peminjaman.p_time_end', 
        'peminjaman.p_scan_surat_peminjaman', 'peminjaman.p_status', 'peminjaman.created_at',
        'peminjaman.updated_at')
        ->where('peminjaman.created_at', 'like', $parameter)
        ->get();
        for($i = 0; $i < count($data_peminjaman); $i++){
            $data_peminjaman[$i]->detail_peminjaman = DB::table('table_data_detail_peminjaman')
            ->join('peminjaman', 'table_data_detail_peminjaman.p_id', '=', 'peminjaman.p_id')
            ->join('inventaris', 'table_data_detail_peminjaman.i_id', '=', 'inventaris.i_id')
            ->select('table_data_detail_peminjaman.i_id', 'peminjaman.p_id', 'inventaris.i_nama', 
            'table_data_detail_peminjaman.dp_jumlah', 'table_data_detail_peminjaman.created_at',
            'table_data_detail_peminjaman.updated_at')
            ->where('table_data_detail_peminjaman.p_id', $data_peminjaman[$i]->p_id)
            ->get();
        }
        $pdf = PDF::loadView('admin.laporan_peminjaman_pdf',['data_peminjaman'=>$data_peminjaman, 'data_status'=>$bulan." ".$myArray[1]]);
    	return $pdf->download('laporan-data-peminjaman.pdf');
    }
    public function cetakTanggal(Request $request){
        $myArray = explode('-', $request->post('harian'));
        $parameter= $myArray[2]."-".$myArray[0]."-".$myArray[1]."%";
        $bulan = $this->getMonth($myArray[0]);
        $data_peminjaman = DB::table('peminjaman')
        ->join('users', 'peminjaman.user_id', '=', 'users.id')
        ->select('peminjaman.p_id', 'users.name', 'peminjaman.p_date', 
        'peminjaman.p_date_end', 'peminjaman.p_time_start', 'peminjaman.p_time_end', 
        'peminjaman.p_scan_surat_peminjaman', 'peminjaman.p_status', 'peminjaman.created_at',
        'peminjaman.updated_at')
        ->where('peminjaman.created_at', 'like', $parameter)
        ->get();
        for($i = 0; $i < count($data_peminjaman); $i++){
            $data_peminjaman[$i]->detail_peminjaman = DB::table('table_data_detail_peminjaman')
            ->join('peminjaman', 'table_data_detail_peminjaman.p_id', '=', 'peminjaman.p_id')
            ->join('inventaris', 'table_data_detail_peminjaman.i_id', '=', 'inventaris.i_id')
            ->select('table_data_detail_peminjaman.i_id', 'peminjaman.p_id', 'inventaris.i_nama', 
            'table_data_detail_peminjaman.dp_jumlah', 'table_data_detail_peminjaman.created_at',
            'table_data_detail_peminjaman.updated_at')
            ->where('table_data_detail_peminjaman.p_id', $data_peminjaman[$i]->p_id)
            ->get();
        }
        $pdf = PDF::loadView('admin.laporan_peminjaman_pdf',['data_peminjaman'=>$data_peminjaman, 'data_status'=>$myArray[1]." ".$bulan." ".$myArray[1]]);
    	return $pdf->download('laporan-data-peminjaman.pdf');
    }

    public function prosesHapus(Request $request){
        $id = $request->post('idhapus');
        DB::table('peminjaman')->where('p_id',$id)->delete();
        return redirect(url('/admin/peminjaman'));
    }
}
