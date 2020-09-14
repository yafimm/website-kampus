<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PengadaanRequest;
use App\Pengadaan;
use App\Barang;
use App\Inventaris;
use PDF;
use DB;

class PengadaanController extends Controller
{
    public function index()
    {
        $arr_pengadaan = Pengadaan::select('no_register', 'tanggal', 'supplier', \DB::raw("SUM(biaya * qty) as totalkeseluruhan"))->with(['barang', 'inventaris'])->groupBy('no_register', 'tanggal', 'supplier')->orderBy('tanggal','desc')->get();
        return view('pengadaan.index', compact('arr_pengadaan'));
    }

    public function create()
    {
        $arr_pengadaan = collect(new Pengadaan);
        // dd($arr_pengadaan);
        return view('pengadaan.create', compact('arr_pengadaan'));
    }

    public function show($id)
    {
        //$id sama dengan no register
        $arr_pengadaan = Pengadaan::with('barang','inventaris')->where('no_register', $id)->get();

        return view('pengadaan.show', compact('arr_pengadaan'));
    }

    public function store(PengadaanRequest $request)
    {
        $data = $request->all();
        for ($i=0; $i < count($request->barang_inventaris); $i++) {
          $pengadaan[] = [
              'no_register' => $request->no_register,
              'supplier' => $request->supplier,
              'tanggal' => date('Y-m-d', strtotime($request->tanggal)),
              'biaya' => $request->harga[$i],
              'qty' => $request->qty[$i],
          ];

          if(substr($request->barang_inventaris[$i], 0, 3) == 'BRG' ){
              //Kalo barang inventaris id sama dengan barang id
              $pengadaan[$i]['barang_id'] = substr($request->barang_inventaris[$i], 3);
          }else{
              //Kalo barang inventaris id sama dengan inventaris id
              $pengadaan[$i]['inventaris_id'] = substr($request->barang_inventaris[$i], 3);
          }

          $store = Pengadaan::create($pengadaan[$i]);
        }
        // dd($pengadaan);

        // $store = Pengadaan::insert($pengadaan);

        if($store){
              return redirect()->route('pengadaan.show', $request->no_register)
                              ->with('alert-class', 'alert-success')
                              ->with('flash_message', 'Data Pengadaan berhasil ditambahkan !!');
        }
        return redirect()->route('pengadaan.show', $request->no_register)
                          ->with('alert-class', 'alert-danger')
                          ->with('flash_message', 'Data Gagal ditambahkan !!');

    }

    public function update(PengadaanRequest $request, $id)
    {
        $data = $request->all();
        //Patokan total arraynya dari jumlah barang
        Pengadaan::where('no_register', $id)->delete();
        for ($i=0; $i < count($request->barang_inventaris); $i++) {
          $pengadaan[] = [
              'no_register' => $id,
              'supplier' => $request->supplier,
              'tanggal' => date('Y-m-d', strtotime($request->tanggal)),
              'biaya' => $request->harga[$i],
              'qty' => $request->qty[$i]
          ];

          if(substr($request->barang_inventaris[$i], 0, 3) == 'BRG' ){
              //Kalo barang inventaris id sama dengan barang id
              $pengadaan[$i]['barang_id'] = substr($request->barang_inventaris[$i], 3);
          }else{
              //Kalo barang inventaris id sama dengan inventaris id
              $pengadaan[$i]['inventaris_id'] = substr($request->barang_inventaris[$i], 3);
          }
          $store = Pengadaan::create($pengadaan[$i]);

        }
        // dd($pengadaan);
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
        $arr_pengadaan = Pengadaan::with(['barang','inventaris'])->where('no_register', $id)->get();
        if(!$arr_pengadaan->isEmpty())
        {
            return view('pengadaan.edit', compact('arr_pengadaan'));
        }
        return abort(404);
    }

    public function destroy()
    {

    }

    public function loadData(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $dataBarang = DB::table('barang')->select('b_id', 'b_kode', 'b_nama')->where('b_kode', 'LIKE', '%'.$cari.'%')->orWhere('b_nama', 'LIKE', '%'.$cari.'%')->take(10)->get();
            $dataInventaris = DB::table('inventaris')->select('i_id', 'i_kode', 'i_nama')->where('i_kode', 'LIKE', '%'.$cari.'%')->orWhere('i_nama', 'LIKE', '%'.$cari.'%')->take(10)->get();
            $data = $dataBarang->merge($dataInventaris);
            return response()->json($data);
        }
    }

    public function getBarang(Request $request)
    {
        if($request->kode){
            $jenisBarang = substr($request->kode, 0, 3);
            if($jenisBarang == 'INV'){
                $data = Inventaris::where('i_kode', substr($request->kode, 3))->first();
            }else{
                $data = Barang::where('b_kode', substr($request->kode, 3))->first();
            }
            if(count($data->pengadaan) > 0){
                $barangPengadaan = $data->pengadaan->where('no_register', $request->no_register)->first();
                if($barangPengadaan){
                    return response()->json(['message' => 'Gagal menambahkan data, karena data ini sudah digunakan dipengadaan ini ('.$request->no_register.') !!', 'status' => false]);
                }
            }
            return response()->json($data);
        }
        return response()->json(['message' => 'Gagal menambahkan data, karena data tidak ditemukan', 'status' => false]);
    }

    public function cetak(Request $request)
    {
        $data_pengadaan = Pengadaan::where([['no_register','=', $request->no_register]])->get();
        $pdf = PDF::loadview('pengadaan.laporan_pengadaan_pdf', ['data_pengadaan'=>$data_pengadaan]);
        return $pdf->stream();
    }

    public function cetakTanggal(Request $request)
    {
        $data_pengadaan = Pengadaan::where([['tanggal','>=', date('Y-m-d', strtotime($request->mulai))], ['tanggal','<=', date('Y-m-d', strtotime($request->akhir))]])->orderBy('tanggal', 'asc')->with('barang', 'inventaris')->get();
        $data_pengadaan = $data_pengadaan->mapToGroups(function ($item, $key) {
            return [$item['no_register'] => $item];
        });

        $pdf = PDF::loadview('pengadaan.laporan_pengadaan_tanggal_pdf', ['data_pengadaan'=>$data_pengadaan, 'mulai' => $request->mulai, 'akhir' => $request->akhir]);
        return $pdf->stream();
    }

}
