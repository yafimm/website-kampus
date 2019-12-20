<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class UserDashboardController extends Controller
{
    public function __construct()
    {
        if(Auth::check()){
            if(Auth::user()->role == 'mahasiswa' || Auth::user()->role == 'ormawa'){
                return redirect('/user/dashboard');
            }else{
                return redirect('/400');
            }
        }else{
            return view('auth.viewLogin');
        }
    }
    public function dashboardUser(){
        $data_peminjaman = DB::table('peminjaman')
        ->join('users', 'peminjaman.user_id', '=', 'users.id')
        ->select('peminjaman.p_id', 'users.name', 'peminjaman.p_date', 
        'peminjaman.p_date_end', 'peminjaman.p_time_start', 'peminjaman.p_time_end', 
        'peminjaman.p_scan_surat_peminjaman', 'peminjaman.p_status', 'peminjaman.created_at',
        'peminjaman.updated_at')
        ->where('peminjaman.user_id',Auth::user()->id)
        ->get();
        return view('user.dashboardUser', compact('data_peminjaman'));
    }
}
