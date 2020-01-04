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
                <th>Satuan</th>
                <th>Harga</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th></th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Stock</th>
                <th>Satuan</th>
                <th>Harga</th>
            </tr>
        </tfoot>

        <tbody>
            @foreach ($arr_barang as $key => $barang)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$barang->b_kode}}</td>
                <td>{{$barang->b_nama}}</td>
                <td>{{$barang->b_stock}}</td>
                <td>{{$barang->b_satuan}}</td>
                <td>{{$barang->b_harga}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
