<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BarangRequest;
use App\Barang;
use DB;
use Image;
use PDF;
use File;

class BarangController extends Controller
{
     public function index(){
         $data_barang = Barang::orderBy('b_id', 'desc')->get();
         return view('barang.index', compact('data_barang'));
     }

     public function tambah(){
         return view('barang.tambahBarang');
     }

     public function ubah($id){
         $data_barang = Barang::findOrFail($id);
         return view('barang.ubahBarang', compact('data_barang'));
     }

     public function lihat($id){
         $data_barang = Barang::findOrFail($id);
         return view('barang.lihatBarang', compact('data_barang'));
     }

     public function prosesTambah(BarangRequest $request){

         $imageName = time().'.'.$request->foto->getClientOriginalExtension();

         $canvas = Image::canvas(200, 200);
         $resizeImage  = Image::make($request->foto)->resize(200, 200, function($constraint) {
             $constraint->aspectRatio();
         });
         $canvas->insert($resizeImage, 'center');
         $url_resize_image = public_path('assets/images-resource/barang/resize_'.$imageName);
         $canvas->save($url_resize_image);

         $request->foto->move(public_path('assets/images-resource/barang'), $imageName);

         $barang = new Barang();
         $barang->b_nama = $request->nama;
         $barang->b_stock = $request->stock;
         $barang->b_kode = $request->kode;
         $barang->b_satuan = $request->satuan;
         $barang->b_harga = $request->harga;
         $barang->b_foto = $imageName;
         $barang->save();

         return redirect()->route('barang.index')->with('alert-class', 'alert-success')->with('flash_message','Data Barang berhasil ditambah ke database !!');
     }

     public function prosesUbah(BarangRequest $request){
         $data = ['b_nama' => $request->nama,
                  'b_stock' => $request->stock,
                  'b_satuan' => $request->satuan,
                  'b_harga' => $request->harga];

         if(!empty($request->file('foto'))) {
             $b_foto = $request->file('foto');

             $imageName = time().'.'.$b_foto->getClientOriginalExtension();
             $canvas = Image::canvas(200, 200);
             $resizeImage  = Image::make($b_foto)->resize(200, 200, function($constraint) {
                 $constraint->aspectRatio();
             });
             $canvas->insert($resizeImage, 'center');
             $url_resize_image = public_path('assets/images-resource/barang/resize_'.$imageName);
             $canvas->save($url_resize_image);

             $b_foto->move(public_path('assets/images-resource/barang'), $imageName);
             $data_barang = DB::table('barang')->where('b_id',$b_id)->get();

             $filename = public_path('/assets/images-resource/barang/'.$data_barang[0]->b_foto);
             $filename2 = public_path('/assets/images-resource/barang/resize_'.$data_barang[0]->b_foto);
             File::delete($filename, $filename2);
             $data['b_foto'] = $imageName;
         }
         Barang::where('b_id',$request->id)->update($data);
         return redirect()->route('barang.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data berhasil diubah !!');
     }

     public function prosesHapus($id){
         $data_barang = Barang::where('b_id',$id)->first();
         $filename = public_path('/assets/images-resource/barang/'.$data_barang->b_foto);
         $filename2 = public_path('/assets/images-resource/barang/resize_'.$data_barang->b_foto);
         File::delete($filename, $filename2);
         $data_barang->delete();
         return redirect()->route('barang.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data berhasil dihapus !!');
     }

     public function prosesRestock(Request $request){
         $b_id = $request->post('id');
         $b_stock = $request->post('stock');
         $data_barang = DB::table('barang')->where('b_id',$b_id)->get();
         $b_stock = $b_stock + $data_barang[0]->b_stock;
         DB::table('barang')->where('b_id',$b_id)->update([
             'b_stock' => $b_stock
         ]);
         return redirect()->route('barang.index')->with('alert-class', 'alert-success')->with('flash_message','Data berhasil ditambah stoknya !!');
     }

     public function cetak(Request $request){
       // $parameter= $request->post('tahunan')."%";
       // $data_barang = DB::table('barang')->where('created_at', 'like', $parameter)->get();
       $data_barang = Barang::where([['created_at','>=', date('Y-m-d', strtotime($request->mulai))], ['created_at','<=', date('Y-m-d', strtotime($request->akhir))]])->get();
       $pdf = PDF::loadview('barang.laporan_barang_pdf', ['data_barang'=>$data_barang, 'mulai' => $request->mulai, 'akhir' => $request->akhir]);
       return $pdf->download('laporan-data-barang.pdf');
     }

}
