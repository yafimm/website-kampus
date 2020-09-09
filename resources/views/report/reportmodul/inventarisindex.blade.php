@extends('report.index')
@section('contentreport')
<section class="section-chart">
  <div class="row">
      <div class="col-md-12 col-sm-12 mt-5 mb-5">
          <div class="row">
              <div class="col-12">
                  <h2>Laporan Data Inventaris</h2>
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
    <table id="dt_inventaris" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
            <tr class="table-info">
              <th colspan="4" class="text-center">Total <br><small class="text-info text-sm">*Untuk <span id="totalPage"></span> Data, Harga * Stok</small></th>
              <th colspan="3" class="text-center" id="totalHarga"></th>
            </tr>
            <tr class="table-primary">
              <th colspan="4" class="text-center">Total Keseluruhan <br><small class="text-info text-sm">*Total Seluruh data.</small></th>
              <th colspan="3" class="text-center">
                  Rp. {{ number_format($arr_inventaris->sum('total'), 2, ',', '.') }}
              </th>
            </tr>
        </tfoot>

        <tbody>
            @foreach ($arr_inventaris as $key => $inventaris)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$inventaris->i_kode}}</td>
                <td>{{$inventaris->i_nama}}</td>
                <td>{{$inventaris->stok}}</td>
                <td>Rp. {{number_format($inventaris->i_harga, 2, ',','.')}}</td>
                <td><span style="display:none;">{{date('Ymd', strtotime($inventaris->created_at))}}</span>{{$inventaris->created_at->format('d-m-Y')}}</td>
                <td>Rp. {{number_format($inventaris->total, 2, ',','.')}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

  <script type="text/javascript">
      var dataInventaris = {!! json_encode($arr_inventaris) !!};
  </script>
  {{-- chartjs --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

@endsection
