<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use DB;
use Image;
use PDF;

class BarangController extends Controller
{

      private function _getMonth($month) {
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
           $data_barang = DB::table('barang')->get();
           return view('barang.index', compact('data_barang'));
       }

       public function cetakTahunan(Request $request){
           $parameter= $request->post('tahunan')."%";
           $data_barang = DB::table('barang')->where('created_at', 'like', $parameter)->get();
           $pdf = PDF::loadview('barang.laporan_barang_pdf',['data_barang'=>$data_barang, 'data_status'=>$request->post('tahunan')]);
           return $pdf->download('laporan-data-barang.pdf');
       }
       public function cetakBulanan(Request $request){
           $myArray = explode(' ', $request->post('bulanan'));
           $parameter= $myArray[1]."-".$myArray[0]."%";
           $bulan = $this->_getMonth($myArray[0]);
           $data_barang = DB::table('barang')->where('created_at', 'like', $parameter)->get();
           $pdf = PDF::loadview('barang.laporan_barang_pdf',['data_barang'=>$data_barang,'data_status'=>$bulan." ".$myArray[1]]);
           return $pdf->download('laporan-data-barang.pdf');
       }
       public function cetakTanggal(Request $request){
           $myArray = explode('-', $request->post('harian'));
           $parameter= $myArray[2]."-".$myArray[0]."-".$myArray[1]."%";
           $bulan = $this->_getMonth($myArray[0]);
           $data_barang = DB::table('barang')->where('created_at', 'like', $parameter)->get();
           dd($data_barang);
           $pdf = PDF::loadview('barang.laporan_barang_pdf',['data_barang'=>$data_barang,'data_status'=>$myArray[1]." ".$bulan." ".$myArray[1]]);
           return $pdf->download('laporan-data-barang.pdf');
       }

       public function tambah(){
           return view('barang.tambahBarang');
       }
       public function ubah($id){
           $data_barang = DB::table('barang')->where('b_id',$id)->first();
           return view('barang.ubahBarang', compact('data_barang'));
       }
       public function lihat($id){
           $data_barang = DB::table('barang')->where('b_id',$id)->first();
           return view('barang.lihatBarang', compact('data_barang'));
       }
       public function prosesTambah(Request $request){
           request()->validate([
               'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           ]);
           $b_nama = $request->post('nama');
           $b_stock = $request->post('stock');
           $b_kode = $request->post('kode');
           $b_satuan = $request->post('satuan');
           $b_foto = $request->file('foto');
           $b_harga = $request->post('harga');
           $imageName = time().'.'.$b_foto->getClientOriginalExtension();

           $canvas = Image::canvas(200, 200);
           $resizeImage  = Image::make($b_foto)->resize(200, 200, function($constraint) {
               $constraint->aspectRatio();
           });
           $canvas->insert($resizeImage, 'center');
           $url_resize_image = public_path('assets/images-resource/barang/resize_'.$imageName);
           $canvas->save($url_resize_image);

           $b_foto->move(public_path('assets/images-resource/barang'), $imageName);

           $barang = new Barang();
           $barang->b_nama = $b_nama;
           $barang->b_stock = $b_stock;
           $barang->b_kode = $b_kode;
           $barang->b_harga = $b_harga;
           $barang->b_satuan = $b_satuan;
           $barang->b_foto = $imageName;
           $barang->save();
           return redirect()->route('barang.index');
       }
       public function prosesUbah(Request $request){
           $b_id = $request->post('id');
           $b_nama = $request->post('nama');
           $b_stock = $request->post('stock');
           $b_satuan = $request->post('satuan');
           $b_harga = $request->post('harga');
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
               DB::table('barang')->where('b_id',$b_id)->update([
                   'b_nama' => $b_nama,
                   'b_stock' => $b_stock,
                   'b_satuan' => $b_satuan,
                   'b_foto' => $imageName,
                   'b_harga' => $b_harga,
               ]);
           }else{
               DB::table('barang')->where('b_id',$b_id)->update([
                   'b_nama' => $b_nama,
                   'b_stock' => $b_stock,
                   'b_satuan' => $b_satuan,
                   'b_harga' => $b_harga,
               ]);
           }
           return redirect()->route('barang.index');
       }

       public function prosesHapus($id){
           $b_id = $id;
           dd($b_id);
           $data_barang = DB::table('barang')->where('b_id',$b_id)->get();
           $filename = public_path('/assets/images-resource/barang/'.$data_barang[0]->b_foto);
           $filename2 = public_path('/assets/images-resource/barang/resize_'.$data_barang[0]->b_foto);
           File::delete($filename, $filename2);
           DB::table('barang')->where('b_id',$b_id)->delete();
           return redirect()->route('barang.index');
       }

       public function prosesRestock(Request $request){
           $b_id = $request->post('id');
           $b_stock = $request->post('stock');
           $data_barang = DB::table('barang')->where('b_id',$b_id)->get();
           $b_stock = $b_stock + $data_barang[0]->b_stock;
           DB::table('barang')->where('b_id',$b_id)->update([
               'b_stock' => $b_stock
           ]);
           return redirect()->route('barang.index');
       }
}