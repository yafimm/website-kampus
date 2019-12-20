<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class BagumumDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:bagumum');
    }

    public function dashboardBagUmum(){
        $data_request = DB::table('request_barang')
        ->join('users', 'request_barang.user_id', '=', 'users.id')
        ->join('barang', 'request_barang.b_id', '=', 'barang.b_id')
        ->select('request_barang.rb_id', 'users.name', 'barang.b_nama', 'request_barang.rb_jumlah', 'request_barang.rb_status', 'request_barang.created_at','request_barang.updated_at')
        ->get();

        $data_peminjaman = DB::table('peminjaman')
        ->join('users', 'peminjaman.user_id', '=', 'users.id')
        ->select('peminjaman.p_id', 'users.name', 'peminjaman.p_date', 
        'peminjaman.p_date_end', 'peminjaman.p_time_start', 'peminjaman.p_time_end', 
        'peminjaman.p_scan_surat_peminjaman', 'peminjaman.p_status', 'peminjaman.created_at',
        'peminjaman.updated_at')
        ->get();
        return view('bagumum.dashboardBagumum', compact('data_request','data_peminjaman'));
    }
}
