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
use DB;

class ReportController extends Controller
{

    public function grafik()
    {
        $dataTotal = ['barang' => DB::table('barang')->count(),
                 'inventaris' => DB::table('inventaris')->count(),
                 'maintenance' => DB::table('maintenance')->count(),
                 'peminjaman' => DB::table('peminjaman')->count(),
                 'pengadaan' => DB::table('pengadaan')->count(),
                 'request_barang' => DB::table('request_barang')->count(),
                 'users' => DB::table('users')->count(),
                  ];

        return view('report.grafik', compact('dataTotal'));
    }
    public function index(Request $request)
    {
        if(isset($request->jenis))
        {
            if($request->jenis == 'datapengadaan')
            {
                $arr_pengadaan = Pengadaan::with('barang','inventaris')->where([['tanggal', '>=', date('Y-m-d', strtotime($request->mulai))], ['tanggal', '<=', date('Y-m-d', strtotime($request->akhir))]])->get();
                return view('report.reportmodul.pengadaanindex', compact('arr_pengadaan'));
            }
            else if($request->jenis == 'datainventaris')
            {
                // $arr_inventaris = Inventaris::whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)))->get();
                $arr_inventaris = Inventaris::with(['pengadaan' => function($q) use($request){
                                                            $q->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)));
                                                      }])->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)))->get();
                return view('report.reportmodul.inventarisindex', compact('arr_inventaris'));
            }
            else if($request->jenis == 'databarang')
            {
                $arr_barang = Barang::with(['request' => function($q) use($request){
                                                              $q->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)));
                                                          },
                                                          'pengadaan' => function($q) use($request){
                                                              $q->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)));
                                                          }])->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)))->get();
                return view('report.reportmodul.barangindex', compact('arr_barang_js', 'arr_barang'));
            }
            else if($request->jenis == 'datapeminjaman')
            {
                $arr_peminjaman = Peminjaman::whereDate('p_date', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('p_date', '<=', date('Y-m-d', strtotime($request->akhir)))->get();
                return view('report.reportmodul.peminjamanindex', compact('arr_peminjaman'));
            }
            else if($request->jenis == 'datapengguna')
            {
                $arr_pengguna = User::whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)))->get();
                return view('report.reportmodul.penggunaindex', compact('arr_pengguna'));
            }
            else if($request->jenis == 'datarequest')
            {
                $arr_request = RequestBarang::with('user', 'barang')->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)))->get();
                return view('report.reportmodul.requestindex', compact('arr_request'));
            }
            else if($request->jenis == 'datamaintenance')
            {
                $arr_maintenance = Maintenance::with(['barang','inventaris'])->whereDate('tanggal_maintenance', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('tanggal_maintenance', '<=', date('Y-m-d', strtotime($request->akhir)))->orderBy('no_register', 'asc')->get();
                return view('report.reportmodul.maintenanceindex', compact('arr_maintenance_js','arr_maintenance'));
            }
        }

        return view('report.index');
    }
}
