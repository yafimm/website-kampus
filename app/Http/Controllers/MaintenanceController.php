<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maintenance;
use App\Barang;

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
        $arr_barang = Barang::all();
        return view('maintenance.create', compact('arr_barang'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        //Patokan total arraynya dari jumlah barang
        for ($i=0; $i < count($request->barang_id); $i++) {
          $maintenance[] = [
              'no_register' => $request->no_register,
              'kode' => $request->kode[$i],
              'barang_id' => $request->barang_id[$i],
              'tanggal_maintenance' => date('Y-m-d', strtotime($request->tanggal_maintenance)),
              'biaya' => $request->biaya[$i],
              'keterangan' => $request->keterangan[$i],
              'posisi' => $request->posisi[$i],
          ];
        }
        // dd($maintenance);

        $store = Maintenance::insert($maintenance);
        if($store){
              return redirect()->route('maintenance.index');
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
        $arr_barang = Barang::all();
        if(!$arr_maintenance->isEmpty())
        {
            return view('maintenance.edit', compact('arr_maintenance', 'arr_barang'));
        }
        return abort(404);
    }

    public function update(Request $request, $id)
    {
      $data = $request->all();
      //Patokan total arraynya dari jumlah barang
      for ($i=0; $i < count($request->barang_id); $i++) {
        $maintenance[] = [
            'no_register' => $id,
            'kode' => $request->kode[$i],
            'barang_id' => $request->barang_id[$i],
            'tanggal_maintenance' => date('Y-m-d', strtotime($request->tanggal_maintenance)),
            'biaya' => $request->biaya[$i],
            'keterangan' => $request->keterangan[$i],
            'posisi' => $request->posisi[$i],
        ];
      }
      Maintenance::where('no_register', $id)->delete();
      // dd($maintenance);
      $store = Maintenance::insert($maintenance);
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
}
