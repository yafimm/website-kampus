@extends('report.index')
@section('contentreport')
<section class="section-chart">
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-5 mb-5">
            <div class="card">
                <div class="card-body text-center">
                    <h2>Laporan Data Inventaris</h2>
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
                <th>Kode</th>
                <th>Nama</th>
                <th>Unit</th>
                <th>Harga</th>
                <th>Tanggal</th>
                <th>Total</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th></th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Unit</th>
                <th>Harga</th>
                <th>Tanggal</th>
                <th>Total</th>
            </tr>
        </tfoot>

        <tbody>
            @foreach ($arr_inventaris as $key => $inventaris)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$inventaris->i_kode}}</td>
                <td>{{$inventaris->i_nama}}</td>
                <td>{{$inventaris->i_unit}}</td>
                <td>Rp. {{number_format($inventaris->i_harga, 2, ',','.')}}</td>
                <td>{{$inventaris->created_at->format('d-m-Y')}}</td>
                <td>Rp. {{number_format($inventaris->total, 2, ',','.')}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-12 text-right">
      <h4>Total Keseluruhan : Rp. {{ number_format($arr_inventaris->sum('total'),2,",",".") }}</h4>
    </div>
</div>


  <script type="text/javascript">
    var dateStart = new Date("{!! date('Y-m-d', strtotime(Request::get('mulai'))) !!}");
    var dateEnd = new Date("{!! date('Y-m-d', strtotime(Request::get('akhir'))) !!}");
    var rangeDate = (dateEnd - dateStart) / (1000 * 3600 * 24);
    var dataHarga = {!! json_encode($arr_inventaris_js) !!};
    var dataChart = [];
    var dataDate = [];
    console.log(dataChart);

    for (var i = 0; i <= rangeDate; i++) {
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
      dataChart[i] = 0;

      for (key in dataHarga) {
        if(formatTanggal == key){
          dataChart[i] += dataHarga[key];
        }else{
          dataChart[i] += 0;
        }
      }
    }

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
                  label: 'Data Pengadaan',
                  backgroundColor: 'rgba(7, 155, 239, 1)',
                  data: dataChart
              }]
          },

          // Configuration options go here
          options: {
             scales: {
                 yAxes: [{
                     ticks: {
                         // Include a dollar sign in the ticks
                         callback: function(value, index, values) {
                             return 'Rp.' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");;
                         }
                     }
                 }]
             },
             tooltips: {
                  callbacks: {
                      label: function(tooltipItem, data) {
                          return 'Rp.' + tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&.');
                      }
                  }
              }
         }
      });
  </script>


@endsection
