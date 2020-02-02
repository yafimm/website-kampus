@extends('report.index')
@section('contentreport')
<div class="example-box-wrapper">
    <table id="dt_barang" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
              <th></th>
              <th>NPK</th>
              <th>NAMA</th>
              <th>NAMA BARANG</th>
              <th>JUMLAH</th>
              <th>TANGGAL</th>
              <th>STATUS</th>
              <th>KETERANGAN</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
              <th></th>
              <th>NPK</th>
              <th>NAMA</th>
              <th>NAMA BARANG</th>
              <th>JUMLAH</th>
              <th>TANGGAL</th>
              <th>STATUS</th>
              <th>KETERANGAN</th>
            </tr>
        </tfoot>

        <tbody>
            @foreach ($arr_request as $key => $request)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$request->user->npm}}</td>
                <td>{{$request->user->nama}}</td>
                <td>{{$request->barang->nama}}</td>
                <td>{{$request->rb_jumlah}}</td>
                <td>{{$request->created_at->format('d-m-Y') }}</td>
                <td>{{$request->status}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
</div>

@endsection
