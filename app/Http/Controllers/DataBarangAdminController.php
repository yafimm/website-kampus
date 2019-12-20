<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataBarangAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function dashboard(){
        return 'Ini Halaman Dashboard Admin';
    }

}
