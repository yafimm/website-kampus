<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Inventaris;
use App\Peminjaman;
use App\User;
use App\Maintenance;
use App\Pengadaan;
use App\Request as RequestBarang;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->jenis))
        {
            if($request->jenis == 'datapengadaan')
            {
                $arr_pengadaan = Pengadaan::where([['tanggal', '>=', date('Y-m-d', strtotime($request->mulai))], ['tanggal', '<=', date('Y-m-d', strtotime($request->akhir))]])->get();
                $arr_pengadaan_js = $arr_pengadaan->groupBy(function($data) {
                                      return date('d-m-Y', strtotime($data->tanggal));
                                  });

                $arr_pengadaan_js = $arr_pengadaan_js->map(function($data){
                                      return $data->sum('total');
                                  })->toArray();

                return view('report.reportmodul.pengadaanindex', compact('arr_pengadaan_js', 'arr_pengadaan'));
            }
            else if($request->jenis == 'datainventaris')
            {
                $arr_inventaris = Inventaris::whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)))->get();
                $arr_inventaris_js = $arr_inventaris->groupBy(function($data) {
                                        return $data->created_at->format('d-m-Y');
                                  });

                $arr_inventaris_js = $arr_inventaris_js->map(function($data){
                                      return $data->sum('total');
                                  })->toArray();
                return view('report.reportmodul.inventarisindex', compact('arr_inventaris_js','arr_inventaris'));
            }
            else if($request->jenis == 'databarang')
            {
                $arr_barang = Barang::whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)))->get();
                $arr_barang_js = $arr_barang->groupBy(function($data) {
                                      return $data->created_at->format('d-m-Y');
                                  });

                $arr_barang_js = $arr_barang_js->map(function($data){
                                      return $data->sum('total');
                                  })->toArray();

                return view('report.reportmodul.barangindex', compact('arr_barang_js', 'arr_barang'));
            }
            else if($request->jenis == 'datapeminjaman')
            {
                $arr_peminjaman = Peminjaman::whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)))->get();
                $arr_peminjaman_js = $arr_peminjaman->groupBy(function($data) {
                                      return date('d-m-Y', strtotime($data->p_date));
                                  });
                $arr_peminjaman_js = $arr_peminjaman_js->map(function($data){
                                      return count($data);
                                  })->toArray();
                return view('report.reportmodul.peminjamanindex', compact('arr_peminjaman_js', 'arr_peminjaman'));
            }
            else if($request->jenis == 'datapengguna')
            {
                $arr_pengguna = User::whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)))->get();
                $arr_pengguna_js = $arr_pengguna->groupBy(function($data) {
                                      return $data->role;
                                  });
                $arr_pengguna_js = $arr_pengguna_js->map(function($data){
                                      return count($data);
                                  })->toArray();
                return view('report.reportmodul.penggunaindex', compact('arr_pengguna_js','arr_pengguna'));
            }
            else if($request->jenis == 'datarequest')
            {
                $arr_request = RequestBarang::whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)))->get();
                $arr_request_js = $arr_request->groupBy(function($data) {
                                      return $data->created_at->format('d-m-Y');
                                  });

                $arr_request_js = $arr_request_js->map(function($data){
                                      return $data->sum('rb_jumlah');
                                  })->toArray();
                return view('report.reportmodul.requestindex', compact('arr_request_js','arr_request'));
            }
            else if($request->jenis == 'datamaintenance')
            {
                $arr_maintenance = Maintenance::whereDate('tanggal_maintenance', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('tanggal_maintenance', '<=', date('Y-m-d', strtotime($request->akhir)))->orderBy('no_register', 'asc')->get();
                $arr_maintenance_js = $arr_maintenance->groupBy(function($data) {
                                      return date('d-m-Y', strtotime($data->tanggal_maintenance));
                                  });

                $arr_maintenance_js = $arr_maintenance_js->map(function($data){
                                      return $data->sum('biaya');
                                  })->toArray();
                return view('report.reportmodul.maintenanceindex', compact('arr_maintenance_js','arr_maintenance'));
            }
        }

        return view('report.index');
    }
}
