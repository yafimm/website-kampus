<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maintenance;
use App\Barang;
use App\Inventaris;
use PDF;

class MaintenanceController extends Controller
{
    public function index()
    {
        $arr_maintenance = Maintenance::select('no_register', 'tanggal_maintenance', \DB::raw("SUM(biaya) as total"))->groupBy('no_register', 'tanggal_maintenance')->get();
        // dd($arr_maintenance[0]);
        return view('maintenance.index', compact('arr_maintenance'));
    }

    public function create()
    {
        $arr_barang = collect(Barang::all()); // Nyatu sama inventaris
        $arr_inventaris = collect(Inventaris::all());
        $arr_barang_inventaris = $arr_inventaris->merge($arr_barang);
        $maintenance = new Maintenance();
        return view('maintenance.create', compact('arr_barang_inventaris', 'maintenance'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        //Patokan total arraynya dari jumlah barang
        for ($i=0; $i < count($request->barang_inventaris); $i++) {
          $maintenance[] = [
              'no_register' => $request->no_register,
              'kode' => $request->kode[$i],
              'tanggal_maintenance' => date('Y-m-d', strtotime($request->tanggal_maintenance)),
              'biaya' => $request->biaya[$i],
              'keterangan' => $request->keterangan[$i],
              'posisi' => $request->posisi[$i],
              'status' => ucfirst($request->status[$i]),
          ];

          if(substr($request->barang_inventaris[$i], 0, 3) == 'BRG' ){
              //Kalo barang inventaris id sama dengan barang id
              $maintenance[$i]['barang_id'] = substr($request->barang_inventaris[$i], 3);
          }else{
              //Kalo barang inventaris id sama dengan inventaris id
              $maintenance[$i]['inventaris_id'] = substr($request->barang_inventaris[$i], 3);
          }

          $store = Maintenance::create($maintenance[$i]);
        }

        if($store){
              return redirect()->route('maintenance.index')->with('alert-class', 'alert-success')->with('flash_message', 'Data Maintenance berhasil dibuat !!');
        }
        return redirect()->route('maintenance.index');


    }

    public function show($id)
    {
        //$id sama dengan no register
        $arr_maintenance = Maintenance::where('no_register', $id)->get();
        return view('maintenance.show', compact('arr_maintenance'));
    }

    public function edit($id)
    {
        $arr_maintenance = Maintenance::where('no_register', $id)->get();
        $arr_barang = collect(Barang::all()); // Nyatu sama inventaris
        $arr_inventaris = collect(Inventaris::all());
        $arr_barang_inventaris = $arr_inventaris->merge($arr_barang);

        if(!$arr_maintenance->isEmpty())
        {
            return view('maintenance.edit', compact('arr_maintenance', 'arr_barang_inventaris'));
        }
        return abort(404);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        //Patokan total arraynya dari jumlah barang
        Maintenance::where('no_register', $id)->delete();
        for ($i=0; $i < count($request->barang_inventaris); $i++) {
          $maintenance[] = [
              'no_register' => $id,
              'kode' => $request->kode[$i],
              'tanggal_maintenance' => date('Y-m-d', strtotime($request->tanggal_maintenance)),
              'biaya' => $request->biaya[$i],
              'keterangan' => $request->keterangan[$i],
              'posisi' => $request->posisi[$i],
              'status' => ucfirst($request->status[$i]),
          ];

          if(substr($request->barang_inventaris[$i], 0, 3) == 'BRG' ){
              //Kalo barang inventaris id sama dengan barang id
              $maintenance[$i]['barang_id'] = substr($request->barang_inventaris[$i], 3);
          }else{
              //Kalo barang inventaris id sama dengan inventaris id
              $maintenance[$i]['inventaris_id'] = substr($request->barang_inventaris[$i], 3);
          }

          $store = Maintenance::create($maintenance[$i]);

        }
        if($store){
              return redirect()->route('maintenance.show', $id)
                              ->with('alert-class', 'alert-success')
                              ->with('flash_message', 'Data Berhasil diubah !!');
        }
        return redirect()->route('maintenance.show', $id)
                          ->with('alert-class', 'alert-danger')
                          ->with('flash_message', 'Data Gagal diubah !!');
    }

    public function destroy($id)
    {
        //
    }

    public function cetak(Request $request){
      $data_maintenance = Maintenance::where([['no_register','=', $request->no_register]])->get();
      $pdf = PDF::loadview('maintenance.laporan_maintenance_pdf', ['data_maintenance'=>$data_maintenance]);
      return $pdf->download('laporan-data-maintenance'.$request->no_register.'.pdf');
    }

    public function cetakTanggal(Request $request){
      $data_maintenance = Maintenance::where([['tanggal_maintenance','>=', date('Y-m-d', strtotime($request->mulai))], ['tanggal_maintenance','<=', date('Y-m-d', strtotime($request->akhir))]])->orderBy('tanggal_maintenance', 'asc')->with('barang', 'inventaris')->get();
      $data_maintenance = $data_maintenance->mapToGroups(function ($item, $key) {
          return [$item['no_register'] => $item];
      });

      $pdf = PDF::loadview('maintenance.laporan_maintenance_tanggal_pdf', ['data_maintenance'=>$data_maintenance, 'mulai' => $request->mulai, 'akhir' => $request->akhir]);
      return $pdf->download('laporan-data-maintenance-'.$request->mulai.'_'.$request->mulai.'.pdf');
    }
}
