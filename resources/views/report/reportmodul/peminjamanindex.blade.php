@extends('report.index')
@section('contentreport')
<section class="section-chart">
  <div class="row">
      <div class="col-md-12 col-sm-12 mt-5 mb-5">
          <div class="row">
              <div class="col-12">
                  <h2>Laporan Data Peminjaman</h2>
                  <hr>
              </div>
          </div>
      </div>
  </div>
</section>

<div class="example-box-wrapper">
    <table id="dt_peminjaman" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>NPM/NIP</th>
                <th>NAMA</th>
                <th>TGL PINJAM</th>
                <th>TGL KEMBALI</th>
                <th>NAMA BARANG</th>
                <th>STATUS</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th></th>
                <th>NPM/NIP</th>
                <th>NAMA</th>
                <th>TGL PINJAM</th>
                <th>TGL KEMBALI</th>
                <th>NAMA BARANG</th>
                <th>STATUS</th>
            </tr>
        </tfoot>

        <tbody>
            @foreach ($arr_peminjaman as $key => $peminjaman)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$peminjaman->user ? $peminjaman->user->npm ? $peminjaman->user->npm : ($peminjaman->user->nip ? $peminjaman->user->nip : '-') : '- Data Pengguna sudah dihapus -' }}</td>
                <td>{{$peminjaman->user ? $peminjaman->user->name : '- Data Pengguna sudah dihapus -' }}</td>
                <td>{{date('d-m-Y', strtotime($peminjaman->p_date))}}</td>
                <td>{{date('d-m-Y', strtotime($peminjaman->p_date_end))}}</td>
                <td>{{$peminjaman->barang ? $peminjaman->barang->b_nama : '- Data Barang sudah dihapus -' }}</td>
                <td>@if ($peminjaman->p_status == 0)
                                    <span class="bs-label label-warning">Menunggu</span>
                                @elseif($peminjaman->p_status == 1)
                                    <span class="bs-label label-primary">Diterima</span>
                                @elseif($peminjaman->p_status == 2)
                                    <span class="bs-label label-danger">Ditolak</span>
                                @else
                                    <span class="bs-label label-success">Selesai</span>
                                @endif
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
</div>

@endsection
