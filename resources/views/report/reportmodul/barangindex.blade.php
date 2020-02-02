@extends('report.index')
@section('contentreport')
<div class="example-box-wrapper">
    <table id="dt_barang" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Stock</th>
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
                <th>Stock</th>
                <th>Harga</th>
                <th>Tanggal</th>
                <th>Total</th>
            </tr>
        </tfoot>

        <tbody>
            @foreach ($arr_barang as $key => $barang)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$barang->b_kode}}</td>
                <td>{{$barang->b_nama}}</td>
                <td>{{$barang->b_stock}}</td>
                <td>Rp. {{ number_format($barang->b_harga,2,",",".") }}</td>
                <td>{{$barang->created_at->format('d-m-Y')}}</td>
                <td>Rp. {{ number_format($barang->total,2,",",".")}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-12 text-right">
      <h4>Total Keseluruhan : Rp. {{ number_format($arr_barang->sum('total'),2,",",".") }}</h4>
    </div>
</div>

@endsection
