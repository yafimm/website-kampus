<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class WelcomeController extends Controller
{

    public function __construct()
    {
        if(Auth::check()){
            if(Auth::user()->role == 'mahasiswa' || Auth::user()->role == 'ormawa'){
                return redirect('/user/dashboard');
            }else if(Auth::user()->role == 'admin'){
                return redirect('/admin/dashboard');
            }else if(Auth::user()->role == 'dosen'){
                return redirect('/dosen/dashboard');
            }else if(Auth::user()->role == 'bagumum'){
                return redirect('/bagumum/dashboard');
            }else{

            }
        }else{

        }
    }
    public function getMonth($month) {
        $bulan = 'none';
        switch ($month) {
            case '01':
                $bulan = 'Januari';
                break;
            case '02':
                $bulan = 'Februari';
                break;
            case '03':
                $bulan = 'Maret';
                break;
            case '04':
                $bulan = 'April';
                break;
            case '05':
                $bulan = 'Maret';
                break;
            case '06':
                $bulan = 'Juni';
                break;
            case '07':
                $bulan = 'Juli';
                break;
            case '08':
                $bulan = 'Agustus';
                break;
            case '09':
                $bulan = 'September';
                break;
            case '10':
                $bulan = 'Oktober';
                break;
            case '11':
                $bulan = 'November';
                break;
            case '12':
                $bulan = 'Desember';
                break;
            default:
                $bulan = 'Gak Ada';
                break;
        }
        return $bulan;
     }

     public function index(){
        $data_peminjaman = DB::table('peminjaman')
        ->join('users', 'peminjaman.user_id', '=', 'users.id')
        ->select('peminjaman.p_id', 'users.name', 'peminjaman.p_date',
        'peminjaman.p_date_end', 'peminjaman.p_time_start', 'peminjaman.p_time_end',
        'peminjaman.p_scan_surat_peminjaman', 'peminjaman.p_status', 'peminjaman.created_at',
        'peminjaman.updated_at')
        ->get();

        $data_peminjaman_sukses = DB::table('peminjaman')
        ->join('users', 'peminjaman.user_id', '=', 'users.id')
        ->select('peminjaman.p_id', 'users.name', 'peminjaman.p_date',
        'peminjaman.p_date_end', 'peminjaman.p_time_start', 'peminjaman.p_time_end',
        'peminjaman.p_scan_surat_peminjaman', 'peminjaman.p_status', 'peminjaman.created_at',
        'peminjaman.updated_at', 'peminjaman.p_nama_event')
        ->where('peminjaman.p_status','1')
        ->get();
        $today = date("Y-m-d");
        return view('first', compact('data_peminjaman', 'data_peminjaman_sukses', 'today'));
    }
}
