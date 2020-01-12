@extends('report.index')
@section('contentreport')
<div class="example-box-wrapper">
    <table id="dt_barang" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>No Register</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Posisi</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Biaya</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
              <th></th>
              <th>No Register</th>
              <th>Kode</th>
              <th>Nama</th>
              <th>Posisi</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Biaya</th>
              <th>Keterangan</th>
            </tr>
        </tfoot>

        <tbody>
            @foreach ($arr_maintenance as $key => $maintenance)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{ $maintenance->no_register }}</td>
                <td>{{$maintenance->kode}}</td>
                <td>{{$maintenance->barang->b_nama}}</td>
                <td>{{$maintenance->posisi}}</td>
                <td>{{date('d-m-Y', strtotime($maintenance->tanggal_maintenance))}}</td>
                <td>{{$maintenance->status}}</td>
                <td>{{$maintenance->biaya}}</td>
                <td>{{$maintenance->keterangan}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-12 text-right">
      <h4>Total Keseluruhan : Rp. {{ number_format($arr_maintenance->sum('biaya'),2,",",".") }}</h4>
    </div>
</div>

@endsection
