<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;
use Image;
use PDF;
use App\Inventaris;

class BagumumDataInventarisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:bagumum');
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
        $data_inventaris = DB::table('inventaris')->get();
        return view('bagumum.dataInventaris', compact('data_inventaris'));
    }

    public function cetakTahunan(Request $request){
        $parameter= $request->post('tahunan')."%";
        $data_inventaris = DB::table('inventaris')->where('created_at', 'like', $parameter)->get();
        $pdf = PDF::loadview('bagumum.laporan_inventaris_pdf',['data_inventaris'=>$data_inventaris, 'data_status'=>$request->post('tahunan')]);
    	return $pdf->download('laporan-data-inventaris.pdf');
    }
    public function cetakBulanan(Request $request){
        $myArray = explode(' ', $request->post('bulanan'));
        $parameter= $myArray[1]."-".$myArray[0]."%";
        $bulan = $this->getMonth($myArray[0]);
        $data_inventaris = DB::table('inventaris')->where('created_at', 'like', $parameter)->get();
        $pdf = PDF::loadview('bagumum.laporan_inventaris_pdf',['data_inventaris'=>$data_inventaris,'data_status'=>$bulan." ".$myArray[1]]);
    	return $pdf->download('laporan-data-inventaris.pdf');
    }
    public function cetakTanggal(Request $request){
        $myArray = explode('-', $request->post('harian'));
        $parameter= $myArray[2]."-".$myArray[0]."-".$myArray[1]."%";
        $bulan = $this->getMonth($myArray[0]);
        $data_inventaris = DB::table('inventaris')->where('created_at', 'like', $parameter)->get();
        $pdf = PDF::loadview('bagumum.laporan_inventaris_pdf',['data_inventaris'=>$data_inventaris,'data_status'=>$myArray[1]." ".$bulan." ".$myArray[1]]);
    	return $pdf->download('laporan-data-inventaris.pdf');
    }

    public function tambah(){
        return view('bagumum.tambahInventaris');
    }
    public function ubah($id){
        $data_inventaris = DB::table('inventaris')->where('i_id',$id)->get();
        return view('bagumum.ubahInventaris', compact('data_inventaris'));
    }
    public function lihat($id){
        $data_inventaris = DB::table('inventaris')->where('i_id',$id)->get();
        return view('bagumum.lihatInventaris', compact('data_inventaris'));
    }
    public function prosesTambah(Request $request){
        request()->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $i_nama = $request->post('nama');
        $i_unit = $request->post('unit');
        $i_posisi = $request->post('posisi');
        $i_keterangan = $request->post('keterangan');
        $i_foto = $request->file('foto');
        $imageName = time().'.'.$i_foto->getClientOriginalExtension();

        $canvas = Image::canvas(200, 200);
        $resizeImage  = Image::make($i_foto)->resize(200, 200, function($constraint) {
            $constraint->aspectRatio();
        });
        $canvas->insert($resizeImage, 'center');
        $url_resize_image = public_path('assets/images-resource/inventaris/resize_'.$imageName);
        $canvas->save($url_resize_image);
        
        $i_foto->move(public_path('assets/images-resource/inventaris'), $imageName);

        $Inventaris = new Inventaris();
        $Inventaris->i_nama = $i_nama;
        $Inventaris->i_unit = $i_unit;
        $Inventaris->i_posisi = $i_posisi;
        $Inventaris->i_keterangan = $i_keterangan;
        $Inventaris->i_foto = $imageName;
        $Inventaris->save();
        return redirect(url('/bagumum/inventaris'));
    }
    public function prosesUbah(Request $request){
        $i_id = $request->post('id');
        $i_nama = $request->post('nama');
        $i_unit = $request->post('unit');
        $i_posisi = $request->post('posisi');
        $i_keterangan = $request->post('keterangan');
        if(!empty($request->file('foto'))) {
            $i_foto = $request->file('foto');

            $imageName = time().'.'.$i_foto->getClientOriginalExtension();
            $canvas = Image::canvas(200, 200);
            $resizeImage  = Image::make($i_foto)->resize(200, 200, function($constraint) {
                $constraint->aspectRatio();
            });
            $canvas->insert($resizeImage, 'center');
            $url_resize_image = public_path('assets/images-resource/inventaris/resize_'.$imageName);
            $canvas->save($url_resize_image);
            
            $i_foto->move(public_path('assets/images-resource/inventaris'), $imageName);
            $data_inventaris = DB::table('inventaris')->where('i_id',$i_id)->get();

            $filename = public_path('/assets/images-resource/inventaris/'.$data_inventaris[0]->i_foto);
            $filename2 = public_path('/assets/images-resource/inventaris/resize_'.$data_inventaris[0]->i_foto);
            File::delete($filename, $filename2);
            DB::table('inventaris')->where('i_id',$i_id)->update([
                'i_nama' => $i_nama,
                'i_unit' => $i_unit,
                'i_posisi' => $i_posisi,
                'i_foto' => $imageName,
                'i_keterangan' => $i_keterangan
            ]);
        }else{
            DB::table('inventaris')->where('i_id',$i_id)->update([
                'i_nama' => $i_nama,
                'i_unit' => $i_unit,
                'i_posisi' => $i_posisi,
                'i_keterangan' => $i_keterangan

            ]);
        }
        return redirect(url('/bagumum/inventaris'));
    }

    public function prosesHapus(Request $request){
        $i_id = $request->post('id');
        $data_inventaris = DB::table('inventaris')->where('i_id',$i_id)->get();
        $filename = public_path('/assets/images-resource/inventaris/'.$data_inventaris[0]->i_foto);
        $filename2 = public_path('/assets/images-resource/inventaris/resize_'.$data_inventaris[0]->i_foto);
        File::delete($filename, $filename2);
        DB::table('inventaris')->where('i_id',$i_id)->delete();
        return redirect(url('/bagumum/inventaris'));
    }
}
