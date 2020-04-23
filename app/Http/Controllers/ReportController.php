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
                return view('report.reportmodul.pengadaanindex', compact('arr_pengadaan'));
            }
            else if($request->jenis == 'datainventaris')
            {
                $arr_inventaris = Inventaris::whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)))->get();
                return view('report.reportmodul.inventarisindex', compact('arr_inventaris'));
            }
            else if($request->jenis == 'databarang')
            {
                $arr_barang = Barang::whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)))->get();
                return view('report.reportmodul.barangindex', compact('arr_barang'));
            }
            else if($request->jenis == 'datapeminjaman')
            {
                $arr_peminjaman = Peminjaman::whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)))->get();
                return view('report.reportmodul.peminjamanindex', compact('arr_peminjaman'));
            }
            else if($request->jenis == 'datapengguna')
            {
                $arr_pengguna = User::whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)))->get();
                return view('report.reportmodul.penggunaindex', compact('arr_pengguna'));
            }
            else if($request->jenis == 'datarequest')
            {
                $arr_request = RequestBarang::whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)))->get();
                return view('report.reportmodul.requestindex', compact('arr_request'));
            }
            else if($request->jenis == 'datamaintenance')
            {
                $arr_maintenance = Maintenance::whereDate('tanggal_maintenance', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('tanggal_maintenance', '<=', date('Y-m-d', strtotime($request->akhir)))->orderBy('no_register', 'asc')->get();
                return view('report.reportmodul.maintenanceindex', compact('arr_maintenance'));
            }
        }

        return view('report.index');
    }
}
