@extends('report.index')
@section('contentreport')
<section class="section-chart">
    <div class="row">
        <div class="col-md-12 col-sm-12 mt-5 mb-5">
            <div class="row">
                <div class="col-12">
                    <h2>Laporan Data Maintenance</h2>
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
    <table id="dt_maintenance" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>No Register</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Posisi</th>
                <th>Tanggal</th>
                <th>Biaya</th>
                <th>Keterangan</th>
                <th>Status</th>
            </tr>
        </thead>

        <tfoot>
            <tr class="table-info">
              <th colspan="6" class="text-center">Total <br><small class="text-info text-sm">*Untuk <span id="totalPage"></span> Data, Harga * Stok</small></th>
              <th colspan="3" class="text-center" id="totalHarga"></th>
            </tr>
            <tr class="table-primary">
              <th colspan="6" class="text-center">Total Keseluruhan <br><small class="text-info text-sm">*Total Seluruh data.</small></th>
              <th colspan="3" class="text-center">
                  Rp. {{ number_format($arr_maintenance->sum('biaya'), 2, ',', '.') }}
              </th>
            </tr>
        </tfoot>

        <tbody>
            @foreach ($arr_maintenance as $key => $maintenance)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{ $maintenance->no_register }}</td>
                <td>{{$maintenance->kode}}</td>
                <td>@if($maintenance->barang)
                      {{$maintenance->barang->b_nama}}
                    @elseif($maintenance->inventaris)
                      {{$maintenance->inventaris->i_nama}}
                    @else
                      - Data Barang / Inventaris sudah dihapus -
                    @endif
                </td>
                <td>{{$maintenance->posisi}}</td>
                <td><span style="display:none;">{{date('Ymd', strtotime($maintenance->tanggal_maintenance))}}</span>{{date('d-m-Y', strtotime($maintenance->tanggal_maintenance))}}</td>
                <td>{{$maintenance->biaya != 0 ? 'Rp. '. number_format($maintenance->biaya, 2, ',', '.') : 'Free'}}</td>
                <td>{{$maintenance->keterangan}}</td>
                <td>{!! ($maintenance->status == 'SELESAI' ? '<span class="label label-success">'.$maintenance->status.'</span>' : ($maintenance->status == 'SEDANG BERJALAN' ? '<span class="label label-warning">'.$maintenance->status.'</span>': '<span class="label label-danger">'.$maintenance->status.'</span>'))!!}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>


    <script type="text/javascript">
      var dataMaintenance = {!! json_encode($arr_maintenance) !!};
    </script>

    {{-- chartjs --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

@endsection
