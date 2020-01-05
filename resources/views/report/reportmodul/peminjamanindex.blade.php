@extends('report.index')
@section('contentreport')
<div class="example-box-wrapper">
    <table id="dt_barang" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>NPM/NPK</th>
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
                <th>NPM/NPK<</th>
                <th>NAMA</th>
                <th>TGL PINJAM</th>
                <th>TGL KEMBALI</th>
                <th>NAMA BARANG</th>
                <th>STATUS/th>
            </tr>
        </tfoot>

        <tbody>
            @foreach ($arr_peminjaman as $key => $peminjaman)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$peminjaman->user->npm}}</td>
                <td>{{$peminjaman->user->name}}</td>
                <td>{{$peminjaman->p_time_start}}</td>
                <td>{{$peminjaman->p_time_end}}</td>
                <td>{{ $peminjaman->barang->b_nama }}</td>
                <td>{{ $peminjaman->status }}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
</div>

@endsection
