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
                <th>Biaya</th>
                <th>Keterangan</th>
                <th>Status</th>
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
              <th>Biaya</th>
              <th>Keterangan</th>
              <th>Status</th>
            </tr>
        </tfoot>

        <tbody>
            @foreach ($arr_maintenance as $key => $maintenance)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{ $maintenance->no_register }}</td>
                <td>{{$maintenance->kode}}</td>
                <td>@if($maintenance->barang)
                      {{$maintenance->barang->b_nama}}
                    @elseif($maintenance->inventaris)
                      {{$maintenance->inventaris->i_nama}}
                    @else
                      - Data Barang / Inventaris sudah dihapus -
                    @endif
                </td>
                <td>{{$maintenance->posisi}}</td>
                <td>{{date('d-m-Y', strtotime($maintenance->tanggal_maintenance))}}</td>
                <td>{{$maintenance->biaya != 0 ? 'Rp. '. number_format($maintenance->biaya, 2, ',', '.') : 'Free'}}</td>
                <td>{{$maintenance->keterangan}}</td>
                <td>{!! ($maintenance->status == 'SELESAI' ? '<span class="label label-success">'.$maintenance->status.'</span>' : ($maintenance->status == 'SEDANG BERJALAN' ? '<span class="label label-warning">'.$maintenance->status.'</span>': '<span class="label label-danger">'.$maintenance->status.'</span>'))!!}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-12 text-right">
      <h4>Total Keseluruhan : Rp. {{ number_format($arr_maintenance->sum('biaya'),2,",",".") }}</h4>
    </div>
</div>

@endsection
