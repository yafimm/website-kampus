<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maintenance;

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
        return view('maintenance.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //$id sama dengan no register
        $arr_maintenance = Maintenance::where('no_register', $id)->get();
        return view('maintenance.show', compact('arr_maintenance'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
