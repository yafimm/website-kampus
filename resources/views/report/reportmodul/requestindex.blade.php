@extends('report.index')
@section('contentreport')
<section class="section-chart">
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-5 mb-5">
            <div class="card">
                <div class="card-body text-center">
                    <h2>Laporan Data Request</h2>
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
                <td>{{$request->created_at->format('d-m-Y') }}</td>
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
      var dateStart = new Date("{!! date('Y-m-d', strtotime(Request::get('mulai'))) !!}");
      var dateEnd = new Date("{!! date('Y-m-d', strtotime(Request::get('akhir'))) !!}");
      var rangeDate = (dateEnd - dateStart) / (1000 * 3600 * 24);
      var dataHarga = {!! json_encode($arr_request_js) !!};
      var dataChart = [[]];
      var dataDate = [];

      for (var i = 0; i < rangeDate; i++) {
        if(i == 0){
          dateStart.setDate(dateStart.getDate());
        }else{
          dateStart.setDate(dateStart.getDate() + 1);
        }
        let tanggal = dateStart.getDate() < 10 ? "0"+dateStart.getDate() : dateStart.getDate();
        let bulan = (dateStart.getMonth() < 10 ? "0":"") + (dateStart.getMonth() + 1);
        let tahun = dateStart.getFullYear();
        let formatTanggal = tanggal+"-"+bulan+"-"+tahun;
        let arrayData = [];
        dataDate.push(formatTanggal);
        for (key in dataHarga) {
          //isiin array dengan 0 dulu biar jalan
          dataChart.push([0]);
          if(formatTanggal == key){
            if(dataHarga[key][0] != null){
              dataChart[0][i] = dataHarga[key][0];
            }else{
              dataChart[0][i] = 0;
            }

            if(dataHarga[key][1] != null){
              dataChart[1][i] = dataHarga[key][1];
            }else{
              dataChart[1][i] = 0;
            }

            if(dataHarga[key][2] != null){
              dataChart[2][i] = dataHarga[key][2];
            }else{
              dataChart[2][i] = 0;
            }

          }else if(dataChart != 0){

          }else{
            dataChart[0][i] = 0;
            dataChart[1][i] = 0;
            dataChart[2][i] = 0;
          }
        }
      }
      console.log(dataChart);

    </script>
    {{-- chartjs --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: dataDate,
                datasets: [{
                    label: 'Menunggu',
                    backgroundColor: 'rgba(230, 126, 34, 1)',
                    data: dataChart[0]
                },
                {
                    label: 'Ditolak',
                    backgroundColor: 'rgba(235, 103, 89, 1)',
                    data: dataChart[1]
                },
                {
                    label: 'Disetujui',
                    backgroundColor: 'rgba(7, 155, 239, 1)',
                    data: dataChart[2]
                }]
            },

        });
    </script>


@endsection
