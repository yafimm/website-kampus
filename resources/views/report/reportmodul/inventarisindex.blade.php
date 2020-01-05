@extends('report.index')
@section('contentreport')
<div class="example-box-wrapper">
    <table id="dt_barang" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Unit</th>
                <th>Harga</th>
                <th>Tanggal</th>
                <th>Total</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th></th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Unit</th>
                <th>Harga</th>
                <th>Tanggal</th>
                <th>Total</th>
            </tr>
        </tfoot>

        <tbody>
            @foreach ($arr_inventaris as $key => $inventaris)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$inventaris->i_kode}}</td>
                <td>{{$inventaris->i_nama}}</td>
                <td>{{$inventaris->i_unit}}</td>
                <td>{{$inventaris->i_harga}}</td>
                <td>{{$inventaris->created_at->format('d-m-Y')}}</td>
                <td>{{$inventaris->total}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-12 text-right">
      <h4>Total Keseluruhan : Rp. {{ number_format($arr_inventaris->sum('total'),2,",",".") }}</h4>
    </div>
</div>

@endsection
