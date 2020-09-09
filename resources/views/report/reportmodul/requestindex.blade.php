@extends('report.index')
@section('contentreport')
<section class="section-chart">
  <div class="row">
      <div class="col-md-12 col-sm-12 mt-5 mb-5">
          <div class="row">
              <div class="col-12">
                  <h2>Laporan Data Request</h2>
                  <hr>
              </div>
          </div>
          <div class="row">
              <div class="col-md-6 col-md-offset-3 col-sm-12" id="chartDiv">
                  <canvas id="pieChart" width="200px" height="150px"></canvas>
              </div>
              <div class="col-md-3 col-md-offset-9 col-sm-12">
                <select class="form-control" name="sort" id="sortChart">
                  <option value="tertinggi">Tertinggi</option>
                  <option value="terendah">Terendah</option>
                </select>
              </div>
          </div>
      </div>
  </div>
</section>

<div class="example-box-wrapper">
    <table id="dt_request" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
              <th></th>
              <th>NPK</th>
              <th>NAMA</th>
              <th>NAMA BARANG</th>
              <th>JUMLAH</th>
              <th>TANGGAL</th>
              <th>STATUS</th>
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
            </tr>
        </tfoot>

        <tbody>
            @foreach ($arr_request as $key => $request)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$request->user ? $request->user->npm ? $request->user->npm : ($request->user->npk ? $request->user->npk  : '-') : '- Data Pengguna sudah dihapus -'}}</td>
                <td>{{$request->user ? $request->user->name : '- Data Pengguna sudah dihapus -'}}</td>
                <td>{{$request->barang ? $request->barang->b_nama : '- Data Barang sudah dihapus -'}}</td>
                <td>{{$request->rb_jumlah}}</td>
                <td><span style="display:none;">{{date('Ymd', strtotime($request->created_at))}}</span>{{$request->created_at->format('d-m-Y') }}</td>
                <td>  @if ($request->rb_status == 0)
                  <span class="bs-label label-warning">Menunggu</span>
                  @elseif($request->rb_status == 1)
                  <span class="bs-label label-danger">Ditolak</span>
                  @elseif($request->rb_status == 2)
                  <span class="bs-label label-primary">Disetujui</span>
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

    <script type="text/javascript">
      var dataRequest = {!! json_encode($arr_request) !!};
    </script>
    {{-- chartjs --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


@endsection
