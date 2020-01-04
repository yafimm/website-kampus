<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembelian;
use App\Barang;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->jenis))
        {
            if($request->jenis == 'datapembelian')
            {

            }
            else if($request->jenis == 'datainventaris')
            {

            }
            else if($request->jenis == 'databarang')
            {
                $arr_barang = Barang::whereDate('created_at', '>=', date('Y-m-d', strtotime($request->mulai)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->akhir)))->get();
                return view('report.barangindex', compact('arr_barang'));
            }
            else if($request->jenis == 'datapeminjaman')
            {
                $peminjaman = Peminjaman::whereDate('created_at', '>=', $request->mulai)->whereDate('created_at', '<=', $request->akhir)->get();
                return view('', compact('peminjaman'));
            }
            else if($request->jenis == 'datapengguna')
            {
                $user = User::whereDate('created_at', '>=', $request->mulai)->whereDate('created_at', '<=', $request->akhir)->get();
                return view('', compact('user'));
            }
            else if($request->jenis == 'datarequest')
            {
                $request = Request::whereDate('created_at', '>=', $request->mulai)->whereDate('created_at', '<=', $request->akhir)->get();
                return view('', compact('request'));
            }
            else if($request->jenis == 'datamaintenance')
            {
                $maintenance = Maintenance::whereDate('created_at', '>=', $request->mulai)->whereDate('created_at', '<=', $request->akhir)->get();
                return view('', compact('maintenance'));
            }
        }

        return view('report.index');
    }
}
