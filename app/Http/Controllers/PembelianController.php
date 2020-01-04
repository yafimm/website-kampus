<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembelian;

class PembelianController extends Controller
{
    public function index()
    {
        return view('pembelian.index');
    }
}
