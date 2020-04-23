@extends('report.index')
@section('contentreport')
<div class="example-box-wrapper">
    <table id="dt_barang" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>No Register</th>
                <th>Supplier/Toko</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Tanggal</th>
                <th>Total</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th></th>
                <th>No Register</th>
                <th>Supplier/Toko</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Tanggal</th>
                <th>Total</th>
            </tr>
        </tfoot>

        <tbody>
            @foreach ($arr_pengadaan as $key => $pengadaan)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$pengadaan->no_register}}</td>
                <td>{{$pengadaan->supplier}}</td>
                <td>@if($pengadaan->barang)
                      {{$pengadaan->barang->b_kode}}
                    @elseif($pengadaan->inventaris)
                      {{$pengadaan->inventaris->i_kode}}
                    @else
                      - Data Barang / Inventaris sudah dihapus -
                    @endif
                </td>
                <td>@if($pengadaan->barang)
                      {{$pengadaan->barang->b_nama}}
                    @elseif($pengadaan->inventaris)
                      {{$pengadaan->inventaris->i_nama}}
                    @else
                      - Data Barang / Inventaris sudah dihapus -
                    @endif
                </td>
                <td>{{$pengadaan->qty}}</td>
                <td>Rp. {{ number_format($pengadaan->biaya,2,",",".") }}</td>
                <td>{{date('d/m/Y', strtotime($pengadaan->tanggal))}}</td>
                <td>Rp. {{ number_format($pengadaan->total,2,",",".")}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-12 text-right">
      <h4>Total Keseluruhan : Rp. {{ number_format($arr_pengadaan->sum('total'),2,",",".") }}</h4>
    </div>
</div>

@endsection
