<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use File;
use Image;

class UserDataPeminjamanController extends Controller
{
    public function __construct()
    {
        if(Auth::check()){
            if(Auth::user()->role == 'mahasiswa' || Auth::user()->role == 'ormawa'){

            }else{
                return redirect('/400');
            }
        }else{
            return view('auth.viewLogin');
        }
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
        ->where('peminjaman.user_id',Auth::user()->id)
        ->get();
        return view('user.dataPeminjaman', compact('data_peminjaman'));
    }

    public function prosesHapus(Request $request){
        $id = $request->post('idhapus');
        DB::table('peminjaman')->where('p_id',$id)->delete();
        return redirect(url('/user/peminjaman'));
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
        return view('user.lihatPeminjaman', compact('data_peminjaman'));
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
        return view('user.ubahPeminjaman', compact('data_peminjaman','data_inventaris'));
    }
    public function pinjam(){
        $data_inventaris = DB::table('inventaris')->get();
        return view('user.pinjam', compact('data_inventaris'));
    }

    public function prosesPinjam(Request $request){
        $inp_status = $request->post('status');
        $inp_iduser = $request->post('iduser');
        $inp_namaevent = $request->post('inp_nama_event');
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
                'p_date' => $inp_datestart,
                'p_nama_event' => $inp_namaevent,
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
            return redirect(url('/user/peminjaman'));
        }else{
            echo "<script>alert('Gagal, Tidak memasukkan barang yang akan dipinjam')
                    ;window.location='".url('/user/peminjaman')."'</script>";
        }
    }

    public function prosesUbah(Request $request){
        $inp_namaevent = $request->post('inp_nama_event');
        $inp_status = $request->post('status');
        $inp_iduser = $request->post('iduser');
        $inp_pid = $request->post('pid');
        $inp_datestart = $this->getDate($request->post('datestart'));
        $inp_timestart = $this->getTime($request->post('timestart'));
        $inp_dateend = $this->getDate($request->post('dateend'));
        $inp_timeend = $this->getTime($request->post('timeend'));
        $fileNameAdded = "";
        $data_peminjaman = DB::table('peminjaman')->where('p_id',$inp_pid)->get();
        if(!empty($data_peminjaman)){
            if(!empty($request->file('file'))){
                $filenameDelete = public_path('suratpeminjaman/'.$data_peminjaman[0]->p_scan_surat_peminjaman);
                File::delete($filenameDelete);
                $b_file = $request->file('file');
                $fileNameAdded = time().'.'.$b_file->getClientOriginalExtension();
                $b_file->move(public_path('suratpeminjaman'), $fileNameAdded);
                DB::table('peminjaman')->where('p_id',$inp_pid)->update([
                    'p_nama_event' => $inp_namaevent,
                    'p_date' => $inp_datestart,
                    'p_date_end' => $inp_dateend,
                    'p_time_start' => $inp_timestart,
                    'p_time_end' => $inp_timeend,
                    'p_scan_surat_peminjaman' => $fileNameAdded,
                    'updated_at' => NOW()
                ]);
            }else{
                DB::table('peminjaman')->where('p_id',$inp_pid)->update([
                    'p_nama_event' => $inp_namaevent,
                    'p_date' => $inp_datestart,
                    'p_date_end' => $inp_dateend,
                    'p_time_start' => $inp_timestart,
                    'p_time_end' => $inp_timeend,
                    'updated_at' => NOW()
                ]);
            }
            $inp_idinventaris = null;
            $inp_jumlahinventaris = null;
            $i=0;
            if($request->exists('idinventaris') && $request->exists('jumlahinventaris')){
                $inp_idinventaris = $request->post('idinventaris');
                $inp_jumlahinventaris = $request->post('jumlahinventaris');
                foreach($inp_idinventaris as $idinventaris){
                    $data_Inventaris_peminjaman = DB::table('table_data_detail_peminjaman')->where([
                        ['p_id', $inp_pid],
                        ['i_id', $idinventaris],])->get();
                    if(!empty($data_Inventaris_peminjaman)){
                        DB::table('table_data_detail_peminjaman')->where('dp_id',$data_Inventaris_peminjaman[0]->dp_id)->update([
                            'dp_jumlah' => $inp_jumlahinventaris[$i]
                        ]);
                    }else{
                        DB::table('table_data_detail_peminjaman')->insert(
                            ['p_id' => $inp_pid,
                            'i_id' => $idinventaris,
                            'dp_jumlah' => $inp_jumlahinventaris[$i], 
                            'created_at' => now(), 
                            'updated_at' => now()]
                        );
                    }
                    $i++;
                }
                return redirect(url('/user/peminjaman'));
            }else{
                echo "<script>alert('Gagal, Tidak memasukkan barang yang akan dipinjam')
                    ;window.location='".url('/user/peminjaman')."'</script>";
            }
            
        }else{
            echo "<script>alert('Gagal, Data Peminjaman tidak ditemukan')
                    ;window.location='".url('/user/peminjaman')."'</script>";
        }

    }

    public function getBulanHuruf($month){
        $bulan = "";
        switch($month){
            case '01' : 
            $bulan = "Januari";
            break;
            case '02' : 
            $bulan = "Februari";
            break;
            case '03' : 
            $bulan = "Maret";
            break;
            case '04' : 
            $bulan = "April";
            break;
            case '05' : 
            $bulan = "Mei";
            break;
            case '06' : 
            $bulan = "Juni";
            break;
            case '01' : 
            $bulan = "Januari";
            break;
            case '07' : 
            $bulan = "Juli";
            break;
            case '08' : 
            $bulan = "Agustus";
            break;
            case '09' : 
            $bulan = "September";
            break;
            case '10' : 
            $bulan = "Oktober";
            break;
            case '11' : 
            $bulan = "November";
            break;
            case '12' : 
            $bulan = "Desember";
            break;
        }
        return $bulan;
    }

    public function cetak($id){
        $data_peminjaman = DB::table('peminjaman')
        ->join('users', 'peminjaman.user_id', '=', 'users.id')
        ->select('peminjaman.p_id', 'users.name', 'peminjaman.p_date', 
        'peminjaman.p_date_end', 'peminjaman.p_time_start', 'peminjaman.p_time_end', 
        'peminjaman.p_scan_surat_peminjaman', 'peminjaman.p_status', 'peminjaman.created_at',
        'peminjaman.updated_at', 'peminjaman.p_nama_event','users.name', 'users.npm', 'users.nip', 'users.role')
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
        $today = date("Y/m/d"); 
        $string_split = explode("/", $today);
        $get_data_tanggal_ttd = "".$string_split[2]." ".$this->getBulanHuruf($string_split[1])." ".$string_split[0];
        $data_peminjaman[0]->nomor_surat = "SPB/".$today."/".$data_peminjaman[0]->p_id;
        $data_peminjaman[0]->get_data_tanggal_ttd = $get_data_tanggal_ttd;
        $pdf = PDF::loadView('templateSuratKonfirmasi',['data_peminjaman'=>$data_peminjaman]);
    	return $pdf->download('surat_izin_peminjaman.pdf');
    }
}
