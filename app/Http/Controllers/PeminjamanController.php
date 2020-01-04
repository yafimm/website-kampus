<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;

class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

     public function getTime($time){
        $in_time = explode(" ",$time);
        $fixTime = '';
        if($in_time[1] == "AM"){
            if($in_time[0] < 10){
                $fixTime = "0".$in_time[0].":00";
            }else{
                $fixTime = $in_time[0].":00";
            }
        }else{
            $plusTime = explode(":",$in_time[0]);
            $realTime = $plusTime[0]+12;
            $fixTime = $realTime.":".$plusTime[1].":00";
        }
        return $fixTime;
    }
    public function getDate($date){
        $in_date = explode("-",$date);
        $fixDate = $in_date[2].'-'.$in_date[0].'-'.$in_date[1];
        return $fixDate;
    }
    public function backDate($date){
        $in_date = explode("-",$date);
        $fixDate = $in_date[1]."-".$in_date[2]."-".$in_date[0];
        return $fixDate;
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
        return view('peminjaman.index', compact('data_peminjaman', 'data_peminjaman_sukses', 'today'));
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
        return view('peminjaman.lihatPeminjaman', compact('data_peminjaman'));
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
        return redirect()->route('peminjaman.index');
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
        return redirect()->route('peminjaman.index');
    }

    public function pinjam(){
      $data_inventaris = DB::table('inventaris')->get();
      return view('peminjaman.pinjam', compact('data_inventaris'));
    }

    public function prosesPinjam(Request $request){
        $inp_namaevent = $request->post('inp_nama_event');
        $inp_status = $request->post('status');
        $inp_iduser = $request->post('iduser');
        $inp_datestart = $this->getDate($request->post('datestart'));
        $inp_timestart = $this->getTime($request->post('timestart'));
        $inp_dateend = $this->getDate($request->post('dateend'));
        $inp_timeend = $this->getTime($request->post('timeend'));
        if(!empty($request->file('file'))){
            $b_file = $request->file('file');
            $fileName = time().'.'.$b_file->getClientOriginalExtension();
            $b_file->move(public_path('suratpeminjaman'), $fileName);
        }else{
        }
        $inp_idinventaris = null;
        $inp_jumlahinventaris = null;
        if($request->exists('idinventaris') && $request->exists('jumlahinventaris')){
             $inp_idinventaris = $request->post('idinventaris');
             $inp_jumlahinventaris = $request->post('jumlahinventaris');
             $id = DB::table('peminjaman')->insertGetId(
                ['user_id' => $inp_iduser,
                'p_nama_event' => $inp_namaevent,
                'p_date' => $inp_datestart,
                'p_scan_surat_peminjaman' => $fileName,
                'p_status' => $inp_status,
                'created_at' => now(),
                'updated_at' => now(),
                'p_date_end' => $inp_dateend,
                'p_time_start' => $inp_timestart,
                'p_time_end' => $inp_timeend]
            );
            $i = 0;
            foreach($inp_idinventaris as $idinventaris){
                DB::table('table_data_detail_peminjaman')->insert(
                    ['p_id' => $id,
                    'i_id' => $idinventaris,
                    'dp_jumlah' => $inp_jumlahinventaris[$i],
                    'created_at' => now(),
                    'updated_at' => now()]
                );
                $i++;
            }
            return redirect()->route('peminjaman.index');
        }else{
            echo "<script>alert('Gagal, Tidak memasukkan barang yang akan dipinjam')
                    ;window.location='".route('peminjaman.index')."'</script>";
        }
      }

      public function ubah($id){
           $data_inventaris = DB::table('inventaris')->get();
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
           ->select('table_data_detail_peminjaman.i_id', 'peminjaman.p_id', 'inventaris.i_id','inventaris.i_nama',
           'table_data_detail_peminjaman.dp_jumlah', 'table_data_detail_peminjaman.created_at',
           'table_data_detail_peminjaman.updated_at')
           ->where('table_data_detail_peminjaman.p_id', $data_peminjaman[0]->p_id)
           ->get();
           $data_date_start = $data_peminjaman[0]->p_date;
           $data_peminjaman[0]->p_date = $this->backDate($data_date_start);
           $data_date_end= $data_peminjaman[0]->p_date_end;
           $data_peminjaman[0]->p_date_end = $this->backDate($data_date_end);
           return view('peminjaman.ubahPeminjaman', compact('data_peminjaman','data_inventaris'));
       }
}
