<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peminjaman;
use PDF;
use DB;
use Auth;
use File;
use Storage;

class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
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
          $today = date("Y-m-d");
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
          $today = date("Y-m-d");
        }

        return view('peminjaman.index', compact('data_peminjaman', 'data_peminjaman_sukses', 'today'));
    }

    public function lihat($id){
        // $data_peminjaman = DB::table('peminjaman')
        // ->join('users', 'peminjaman.user_id', '=', 'users.id')
        // ->select('peminjaman.p_id', 'users.name', 'peminjaman.p_date',
        // 'peminjaman.p_date_end', 'peminjaman.p_time_start', 'peminjaman.p_time_end',
        // 'peminjaman.p_scan_surat_peminjaman', 'peminjaman.p_status', 'peminjaman.created_at',
        // 'peminjaman.updated_at')
        // ->where('peminjaman.p_id', $id)
        // ->get();
        // $data_peminjaman[0]->detail_peminjaman = DB::table('table_data_detail_peminjaman')
        // ->join('peminjaman', 'table_data_detail_peminjaman.p_id', '=', 'peminjaman.p_id')
        // ->join('inventaris', 'table_data_detail_peminjaman.i_id', '=', 'inventaris.i_id')
        // ->select('table_data_detail_peminjaman.i_id', 'peminjaman.p_id', 'inventaris.i_nama',
        // 'table_data_detail_peminjaman.dp_jumlah', 'table_data_detail_peminjaman.created_at',
        // 'table_data_detail_peminjaman.updated_at')
        // ->where('table_data_detail_peminjaman.p_id', $data_peminjaman[0]->p_id)
        // ->get();
        $data_peminjaman = Peminjaman::find($id);
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
        else if($request->post('jenis') == 3){
            $id = $request->post('idsetuju');
            $jenis = 3;
        }
        DB::table('peminjaman')->where('p_id',$id)->update([
            'p_status' => $jenis
        ]);
        return redirect()->route('peminjaman.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data barang pinjaman berhasil disetujui !!');
    }

    public function prosesHapus(Request $request){
        Peminjaman::findOrFail($request->idhapus)->delete();
        return redirect()->route('peminjaman.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data peminjaman berhasil dihapus !!');
    }

    public function pinjam(){
      $data_inventaris = DB::table('inventaris')->get();
      return view('peminjaman.pinjam', compact('data_inventaris'));
    }

    public function prosesPinjam(Request $request){
      // dd($request->all());
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
             $peminjaman = Peminjaman::create(
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
                    ['p_id' => $peminjaman->p_id,
                    'i_id' => $idinventaris,
                    'dp_jumlah' => $inp_jumlahinventaris[$i],
                    'created_at' => now(),
                    'updated_at' => now()]
                );
                $i++;
            }
            return redirect()->route('peminjaman.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data peminjaman berhasil diajukan !!');
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
           'peminjaman.p_date_end', 'peminjaman.p_time_start', 'peminjaman.p_time_end', 'peminjaman.p_nama_event',
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
                return redirect()->route('peminjaman.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data peminjaman berhasil diubah !!');
            }else{
                echo "<script>alert('Gagal, Tidak memasukkan barang yang akan dipinjam')
                    ;window.location='".url('/dosen/peminjaman')."'</script>";
            }

        }else{
            echo "<script>alert('Gagal, Data Peminjaman tidak ditemukan')
                    ;window.location='".url('/dosen/peminjaman')."'</script>";
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

    //   public function cetak($id){
    //     $data_peminjaman = DB::table('peminjaman')
    //     ->join('users', 'peminjaman.user_id', '=', 'users.id')
    //     ->select('peminjaman.p_id', 'users.name', 'peminjaman.p_date',
    //     'peminjaman.p_date_end', 'peminjaman.p_time_start', 'peminjaman.p_time_end',
    //     'peminjaman.p_scan_surat_peminjaman', 'peminjaman.p_status', 'peminjaman.created_at',
    //     'peminjaman.updated_at', 'peminjaman.p_nama_event','users.name', 'users.npm', 'users.nip', 'users.role')
    //     ->where('peminjaman.p_id', $id)
    //     ->get();
    //     $data_peminjaman[0]->detail_peminjaman = DB::table('table_data_detail_peminjaman')
    //     ->join('peminjaman', 'table_data_detail_peminjaman.p_id', '=', 'peminjaman.p_id')
    //     ->join('inventaris', 'table_data_detail_peminjaman.i_id', '=', 'inventaris.i_id')
    //     ->select('table_data_detail_peminjaman.i_id', 'peminjaman.p_id', 'inventaris.i_nama',
    //     'table_data_detail_peminjaman.dp_jumlah', 'table_data_detail_peminjaman.created_at',
    //     'table_data_detail_peminjaman.updated_at')
    //     ->where('table_data_detail_peminjaman.p_id', $data_peminjaman[0]->p_id)
    //     ->get();
    //     $today = date("Y/m/d");
    //     $string_split = explode("/", $today);
    //     $get_data_tanggal_ttd = "".$string_split[2]." ".$this->getBulanHuruf($string_split[1])." ".$string_split[0];
    //     $data_peminjaman[0]->nomor_surat = "SPB/".$today."/".$data_peminjaman[0]->p_id;
    //     $data_peminjaman[0]->get_data_tanggal_ttd = $get_data_tanggal_ttd;
    //     $pdf = PDF::loadView('templateSuratKonfirmasi',['data_peminjaman'=>$data_peminjaman]);
    // 	return $pdf->download('surat_izin_peminjaman.pdf');
    // }

    public function cetakTanggal(Request $request){
        $data_peminjaman = Peminjaman::where([['created_at','>=', date('Y-m-d', strtotime($request->mulai))], ['created_at','<=', date('Y-m-d', strtotime($request->akhir))]])->get();
        $pdf = PDF::loadview('peminjaman.laporan_peminjaman_tanggal_pdf', ['data_peminjaman'=>$data_peminjaman, 'mulai' => $request->mulai, 'akhir' => $request->akhir]);
        return $pdf->download('laporan-data-peminjaman.pdf');
    }

    public function cetak($id)
    {
        $data_peminjaman = Peminjaman::find($id);
        if(\Auth::user()->id == $data_peminjaman->user_id)
        {
            $pdf = PDF::loadview('peminjaman.laporan_peminjaman_pdf', ['data_peminjaman'=>$data_peminjaman]);
            return $pdf->download('laporan-data-peminjaman.pdf');
        }
    }

    public function cetakSuratPengembalian($id)
    {
        $data_peminjaman = Peminjaman::findOrFail($id);
        if($data_peminjaman->p_status == 1 || $data_peminjaman->p_status == 3){
          $pdf = PDF::loadview('peminjaman.surat_pengembalian_pdf', ['data_peminjaman' => $data_peminjaman])->setPaper('a4', 'porttrait');
          // return $pdf->stream();
          return $pdf->download('surat_pengembalian_'.$data_peminjaman->p_id.'.pdf');
        }
        return abort(404);

    }



}
