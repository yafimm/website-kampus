<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\BarangRequest;
use App\Barang;
use DB;
use Image;
use PDF;
use File;

class BarangController extends Controller
{
     public function index(Request $request)
     {
         $data_barang = Barang::with('pengadaan','request', 'request.user')->orderBy('b_id', 'desc');
         // if($request->query){
         //    $data_barang = $data_barang->where('')
         // }
         $data_barang = $data_barang->paginate(20);
         return Response()->json(['status'  => 200,
                                  'data'    => $data_barang,
                                  'message' => 'Successfully load !!']);
     }


     public function lihat($id)
     {
         $data_barang = Barang::with(['pengadaan', 'request', 'request.user'])->find($id);
         if($data_barang){
            return Response()->json(['status'   => 200,
                                      'data'     => $data_barang,
                                      'message'  => 'Success, data found !!']);
         }
         return Response()->json(['status'   => 404,
                                   'data'    => null,
                                   'message' => 'Failed, Data not found !!']);
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

         $barang = Barang::create(['b_nama'   => $request->nama,
                                   'b_stock'  => 0,
                                   'b_kode'   => $request->kode,
                                   'b_satuan' => $request->satuan,
                                   'b_harga'  => $request->b_harga,
                                   'b_foto'   => $imageName]);
         if($barang){
             return Response()->json(['status'  => 204,
                                      'data'    => null,
                                      'message' => 'Success, data successfully created !!']);
         }
         return Response()->json(['status'  => 500,
                                  'data'    => null,
                                  'message' => 'Failed, data failed to create !!']);
     }

     public function prosesUbah(BarangRequest $request, $id){
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
             $data_barang = DB::table('barang')->where('b_id',$id)->get();

             $filename = public_path('/assets/images-resource/barang/'.$data_barang[0]->b_foto);
             $filename2 = public_path('/assets/images-resource/barang/resize_'.$data_barang[0]->b_foto);
             File::delete($filename, $filename2);
             $data['b_foto'] = $imageName;
         }
         $barang = Barang::where('b_id',$request->id)->update($data);
         if($barang){
             return Response()->json(['status'  => 200,
                                      'data'    => $barang,
                                      'message' => 'Success, data successfully updated !!']);
         }
         return Response()->json(['status'  => 404,
                                  'data'    => null,
                                  'message' => 'Failed, data failed to update !!']);
     }

     public function prosesHapus(Request $request){
         $barang = Barang::where('b_id',$request->id)->first();
         if($barang){
             return Response()->json(['status'  => 404,
                                      'data'    => null,
                                      'message' => 'Failed, data not found !!']);
         }
         $filename = public_path('/assets/images-resource/barang/'.$data_barang->b_foto);
         $filename2 = public_path('/assets/images-resource/barang/resize_'.$data_barang->b_foto);
         File::delete($filename, $filename2);
         $delete = $data_barang->delete();
         if($delete){
             return Response()->json(['status'  => 200,
                                      'data'    => $delete,
                                      'message' => 'Success, data successfully deleted !!']);
         }
         return Response()->json(['status'  => 500,
                                  'data'    => null,
                                  'message' => 'Failed, data failed to delete !!']);
     }

     public function cetak(Request $request)
     {
         $data_barang = Barang::with('pengadaan','request', 'request.user')->where([['created_at','>=', date('Y-m-d', strtotime($request->mulai))], ['created_at','<=', date('Y-m-d', strtotime($request->akhir))]])->get();
         if($data_barang){
             $pdf = PDF::loadview('barang.laporan_barang_pdf', ['data_barang'=>$data_barang, 'mulai' => $request->mulai, 'akhir' => $request->akhir]);
             return Response()->json(['status'  => 200,
                                      'data'    => $pdf->stream(),
                                      'message' => 'Success, data is found !!']);
         }
         return Response()->json(['status'  => 404,
                                  'data'    => null,
                                  'message' => 'Failed, data not found !!']);

     }



}
