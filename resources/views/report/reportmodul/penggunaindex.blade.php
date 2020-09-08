@extends('report.index')
@section('contentreport')
<section class="section-chart">
  <div class="row">
      <div class="col-md-12 col-sm-12 mt-5 mb-5">
          <div class="row">
              <div class="col-12">
                  <h2>Laporan Data Pengguna</h2>
                  <hr>
              </div>
          </div>
      </div>
  </div>
</section>

<div class="example-box-wrapper">
    <table id="dt_pengguna" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
              <th></th>
              <th>NPM/NPK</th>
              <th>NAMA</th>
              <th>EMAIL</th>
              <th>NO TELEPON</th>
              <th>KETERANGAN</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th></th>
                <th>NPM/NPK</th>
                <th>NAMA</th>
                <th>EMAIL</th>
                <th>NO TELEPON</th>
                <th>KETERANGAN</th>
            </tr>
        </tfoot>

        <tbody>
            @foreach ($arr_pengguna as $key => $pengguna)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$pengguna->npm}}</td>
                <td>{{$pengguna->name}}</td>
                <td>{{$pengguna->email}}</td>
                <td>{{$pengguna->no_telpon}}</td>
                <td>{{ $pengguna->role }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
</div>
@endsection
