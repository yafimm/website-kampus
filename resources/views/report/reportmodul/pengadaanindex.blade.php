@extends('report.index')
@section('contentreport')

<section class="section-chart">
  <div class="row">
      <div class="col-md-12 col-sm-12 mt-5 mb-5">
          <div class="row">
              <div class="col-12">
                  <h2>Laporan Data Pengadaan</h2>
                  <hr>
              </div>
          </div>
      </div>
  </div>
</section>

<div class="example-box-wrapper">
    <table id="dt_pengadaan" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
            <tr class="table-info">
              <th colspan="5" class="text-center">Total <br><small class="text-info text-sm">*Untuk <span id="totalPage"></span> Data, Harga * Stok</small></th>
              <th colspan="4" class="text-center" id="totalHarga"></th>
            </tr>
            <tr class="table-primary">
              <th colspan="5" class="text-center">Total Keseluruhan <br><small class="text-info text-sm">*Total Seluruh data.</small></th>
              <th colspan="4" class="text-center">
                  Rp. {{ number_format($arr_pengadaan->sum('total'), 2, ',', '.') }}
              </th>
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
</div>
@endsection
