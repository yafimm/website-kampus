@extends('report.index')
@section('contentreport')
<section class="section-chart">
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-5 mb-5">
            <div class="card">
                <div class="card-body text-center">
                    <h2>Laporan Data Pengguna</h2>
                    <hr>
                </div>
                <div class="card-body">
                    <canvas id="myChart" width="200px" height="150px"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="example-box-wrapper">
    <table id="dt_barang" class="table table-striped table-bordered" cellspacing="0" width="100%">
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

<script type="text/javascript">

  var dataPengguna = {!! json_encode($arr_pengguna_js) !!};
  var dataChart = [];
  var dataRole = [];
  var i = 0;
  for (key in dataPengguna) {
      dataRole[i] = key;
      dataChart[i] = dataPengguna[key];
      i++;
  }


    </script>
    {{-- chartjs --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'pie',

            // The data for our dataset
            data: {
                labels: dataRole,
                datasets: [{
                    label: 'Data Pengguna',
                    backgroundColor: ["#0074D9", "#FF4136", "#2ECC40", "#FF851B"],
                    data: dataChart
                }]
            },

            // Configuration options go here
        });
    </script>

@endsection
