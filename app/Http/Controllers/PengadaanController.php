<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengadaan;
use PDF;

class PengadaanController extends Controller
{
    public function index()
    {
        $arr_pengadaan = Pengadaan::select('no_register', 'tanggal', 'supplier', \DB::raw("SUM(biaya) as totalkeseluruhan"))->groupBy('no_register', 'tanggal', 'supplier')->get();
        return view('pengadaan.index', compact('arr_pengadaan'));
    }

    public function create()
    {
        $arr_pengadaan = collect(new Pengadaan);
        return view('pengadaan.create', compact('arr_pengadaan'));
    }

    public function show($id)
    {
        //$id sama dengan no register
        $arr_pengadaan = Pengadaan::where('no_register', $id)->get();
        return view('pengadaan.show', compact('arr_pengadaan'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // dd($request->all());
        //Patokan total arraynya dari jumlah barang
        for ($i=0; $i < count($request->barang_id); $i++) {
          $pengadaan[] = [
              'no_register' => $request->no_register,
              'supplier' => $request->supplier,
              'kode' => $request->kode[$i],
              'barang_id' => $request->barang_id[$i],
              'tanggal' => date('Y-m-d', strtotime($request->tanggal)),
              'biaya' => $request->biaya[$i],
              'qty' => $request->qty[$i]
          ];
        }

        $store = Pengadaan::insert($pengadaan);
        if($store){
              return redirect()->route('pengadaan.show', $request->no_register)
                              ->with('alert-class', 'alert-success')
                              ->with('flash_message', 'Data Pengadaan berhasil ditambahkan !!');
        }
        return redirect()->route('pengadaan.show', $request->no_register)
                          ->with('alert-class', 'alert-danger')
                          ->with('flash_message', 'Data Gagal ditambahkan !!');

    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        //Patokan total arraynya dari jumlah barang
        for ($i=0; $i < count($request->barang_id); $i++) {
          $pengadaan[] = [
              'no_register' => $id,
              'supplier' => $request->supplier,
              'kode' => $request->kode[$i],
              'barang_id' => $request->barang_id[$i],
              'tanggal' => date('Y-m-d', strtotime($request->tanggal)),
              'biaya' => $request->biaya[$i],
              'qty' => $request->qty[$i]
          ];
        }
        Pengadaan::where('no_register', $id)->delete();
        // dd($pengadaan);
        $store = Pengadaan::insert($pengadaan);
        if($store){
              return redirect()->route('pengadaan.show', $id)
                              ->with('alert-class', 'alert-success')
                              ->with('flash_message', 'Data Berhasil diubah !!');
        }
        return redirect()->route('pengadaan.show', $id)
                          ->with('alert-class', 'alert-danger')
                          ->with('flash_message', 'Data Gagal diubah !!');

    }

    public function edit($id)
    {
        $arr_pengadaan = Pengadaan::where('no_register', $id)->get();
        if(!$arr_pengadaan->isEmpty())
        {
            return view('pengadaan.edit', compact('arr_pengadaan'));
        }
        return abort(404);
    }

    public function destroy()
    {

    }

    public function cetak(Request $request){
      $data_pengadaan = Pengadaan::where([['no_register','=', $request->no_register]])->get();
      $pdf = PDF::loadview('pengadaan.laporan_pengadaan_pdf', ['data_pengadaan'=>$data_pengadaan]);
      return $pdf->download('laporan-data-pengadaan'.$request->no_register.'.pdf');
    }

}
