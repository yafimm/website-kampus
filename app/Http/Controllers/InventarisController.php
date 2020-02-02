<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InventarisRequest;
use File;
use Image;
use PDF;
use DB;
use App\Inventaris;

class InventarisController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('role:admin');
    }

    public function index(){
        $data_inventaris = Inventaris::orderBy('i_id','desc')->get();
        return view('inventaris.index', compact('data_inventaris'));
    }

    public function tambah(){
        return view('inventaris.tambahInventaris');
    }
    public function ubah($id){
        $data_inventaris = Inventaris::findOrFail($id);
        return view('inventaris.ubahInventaris', compact('data_inventaris'));
    }
    public function lihat($id){
        $data_inventaris = Inventaris::findOrFail($id);
        return view('inventaris.lihatInventaris', compact('data_inventaris'));
    }
    public function prosesTambah(InventarisRequest $request){
        request()->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


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

        $data = ['i_nama' => $request->nama,
                  'i_unit' => $request->unit,
                  'i_kode' => $request->kode,
                  'i_harga' => $request->harga,
                  'i_posisi' => $request->posisi,
                  'i_keterangan' => $request->keterangan,
                  'i_foto' => $imageName
                ];

        Inventaris::create($data);

        return redirect()->route('inventaris.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data Berhasil ditambahkan ke database !!');
    }

    public function prosesUbah(InventarisRequest $request, $i_id){
        $data = ['i_nama' => $request->nama,
                  'i_unit' => $request->unit,
                  'i_kode' => $request->kode,
                  'i_harga' => $request->harga,
                  'i_posisi' => $request->posisi,
                  'i_keterangan' => $request->keterangan,
                ];
        $data_inventaris = Inventaris::findOrFail($i_id);

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

            $filename = public_path('/assets/images-resource/inventaris/'.$data_inventaris->i_foto);
            $filename2 = public_path('/assets/images-resource/inventaris/resize_'.$data_inventaris->i_foto);
            File::delete($filename, $filename2);
            $data['i_foto'] = $imageName;
         }

         $data_inventaris->update($data);

         return redirect()->route('inventaris.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data Berhasil diubah !!');
    }

    public function prosesHapus(Request $request){
        $data_inventaris = Inventaris::findOrFail($request->id);
        $filename = public_path('/assets/images-resource/inventaris/'.$data_inventaris->i_foto);
        $filename2 = public_path('/assets/images-resource/inventaris/resize_'.$data_inventaris->i_foto);
        File::delete($filename, $filename2);
        $data_inventaris->delete();
        return redirect()->route('inventaris.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data berhasil dihapus dari database !!');
    }

    public function cetak(Request $request){
        $data_inventaris = Inventaris::where([['created_at','>=', date('Y-m-d', strtotime($request->mulai))], ['created_at','<=', date('Y-m-d', strtotime($request->akhir))]])->get();
        $pdf = PDF::loadview('inventaris.laporan_inventaris_pdf', ['data_inventaris'=>$data_inventaris, 'mulai' => $request->mulai, 'akhir' => $request->akhir]);
        return $pdf->download('laporan-data-inventaris.pdf');
    }
    // public function cetakTanggal(Request $request){
    //     $myArray = explode('-', $request->post('harian'));
    //     $parameter= $myArray[2]."-".$myArray[0]."-".$myArray[1]."%";
    //     $bulan = $this->getMonth($myArray[0]);
    //     $data_inventaris = DB::table('inventaris')->where('created_at', 'like', $parameter)->get();
    //     $pdf = PDF::loadView('inventaris.laporan_inventaris_pdf',['data_inventaris'=>$data_inventaris,'data_status'=>$myArray[1]." ".$bulan." ".$myArray[1]]);
    //   return $pdf->download('laporan-data-inventaris.pdf');
    // }

}
