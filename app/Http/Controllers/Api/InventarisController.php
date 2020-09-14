<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\InventarisRequest;
use File;
use Image;
use PDF;
use DB;
use App\Inventaris;

class InventarisController extends Controller
{
    public function index()
    {
        $data_inventaris = Inventaris::with('pengadaan')->orderBy('i_id','desc')->paginate(20);
        return Response()->json(['status'  => 200,
                                 'data'    => $data_inventaris,
                                 'message' => 'Successfully load !!']);
    }

    public function lihat($id)
    {
        $inventaris = Inventaris::with('pengadaan')->find($id);
        if($inventaris){
            return Response()->json(['status'   => 200,
                                      'data'    => $inventaris,
                                      'message' => 'Success, data found !!']);
        }
        return Response()->json(['status'   => 404,
                                  'data'    => null,
                                  'message' => 'Failed, Data not found !!']);
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

        $inventaris = Inventaris::create(['i_nama'       => $request->nama,
                                          'i_unit'       => 0,
                                          'i_kode'       => $request->kode,
                                          'i_harga'      => $request->harga,
                                          'i_posisi'     => $request->posisi,
                                          'i_keterangan' => $request->keterangan,
                                          'i_foto'       => $imageName]);

        if($inventaris){
            return Response()->json(['status'  => 201,
                                     'data'    => $inventaris,
                                     'message' => 'Success, data successfully created !!']);
        }
        return Response()->json(['status'  => 500,
                                 'data'    => null,
                                 'message' => 'Failed, data failed to create !!']);
    }

    public function prosesUbah(InventarisRequest $request, $i_id){
        $data = ['i_nama' => $request->nama,
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
