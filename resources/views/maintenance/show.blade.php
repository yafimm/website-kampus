 @extends('template.layout')
@section('content')
<div class="container">

    <script type="text/javascript" src="{{ asset('assets/widgets/datepicker/datepicker.js') }}"></script>
    <script type="text/javascript">
        /* Datepicker bootstrap */

        $(function () {
            "use strict";
            $('#tahunan').bsdatepicker({
                autoclose: true,
                format: " yyyy",
                viewMode: "years",
                minViewMode: "years",
                startDate: '2019',
                endDate: new Date(),
            });
        });

        $(function () {
            "use strict";
            $('#bulanan').bsdatepicker({
                autoclose: true,
                format: " mm-yyyy",
                viewMode: "months",
                minViewMode: "months",
                startDate: '2019',
                endDate: new Date(),
            });
        });

        $(function () {
            "use strict";
            $('#harian').bsdatepicker({
                format: 'mm-dd-yyyy'
            });
        });

    </script>
    <!-- Bootstrap Datepicker -->
    <script type="text/javascript" src="{{ asset('assets/widgets/datepicker-ui/datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datepicker-ui/datepicker-demo.js') }}">
    </script>


    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-bootstrap.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-tabletools.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-reorder.js') }}"></script>

    <script type="text/javascript">
        /* Datatables export */

        $(document).ready(function () {
            var table = $('#dt_maintenance').DataTable();
            var tt = new $.fn.dataTable.TableTools(table);


            $('.dataTables_filter input').attr("placeholder", "Search...");

        });

    </script>
    <!-- Sparklines charts -->

    <script type="text/javascript" src="{{ asset('assets/widgets/charts/sparklines/sparklines.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/charts/sparklines/sparklines-demo.js') }}">
    </script>

    <!-- Flot charts -->

    <script type="text/javascript" src="{{ asset('assets/widgets/charts/flot/flot.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/charts/flot/flot-resize.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/charts/flot/flot-stack.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/charts/flot/flot-pie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/charts/flot/flot-tooltip.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/charts/flot/flot-demo-1.js') }}"></script>

    <!-- PieGage charts -->

    <script type="text/javascript" src="{{ asset('assets/widgets/charts/piegage/piegage.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/charts/piegage/piegage-demo.js') }}"></script>

    <div id="page-title">
        <h2>Halaman Data Maintenance #{{$arr_maintenance[0]->no_register }}</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero my-2">
                <a href="{{ route('maintenance.create',['no_register' => $arr_maintenance[0]->no_register, 'tanggal_maintenance' => date('d-m-Y', strtotime($arr_maintenance[0]->tanggal_maintenance))]) }}" class="btn btn-primary">
                    <i class="glyph-icon icon-plus-circle"></i> Tambah
                </a>
                <a href="{{ route('maintenance.edit', $arr_maintenance[0]->no_register) }}" class="btn btn-primary">
                    <i class="glyphicon glyphicon-edit"></i> Ubah
                </a>
                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#modalReportTahunan">
                    <i class="glyph-icon icon-clipboard"></i> Cetak Laporan Tahunan
                </button>
                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#modalReportBulanan">
                    <i class="glyph-icon icon-clipboard"></i> Cetak Laporan Bulanan
                </button>
                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#modalReportTanggal">
                    <i class="glyph-icon icon-clipboard"></i> Cetak Laporan Harian
                </button>
            </h3>

            <h3 class="title-hero">
              <div class="col-12 my-3">
                <h5>No Register : {{ $arr_maintenance[0]->no_register }}</h5>
                <h5>Tanggal Maintenance : {{ date('d-m-Y', strtotime($arr_maintenance[0]->tanggal_maintenance)) }}</h5>
                <h5>Total Keseluruhan : Rp. {{ number_format($arr_maintenance->sum('biaya'), 2,',','.') }}</h5>
              </div>
            </h3>
            <div class="example-box-wrapper">

                <table id="dt_maintenance" class="table table-striped table-bordered" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Posisi</th>
                            <th>Tanggal Maintenance</th>
                            <th>Biaya</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                          <th></th>
                          <th>Kode</th>
                          <th>Nama Barang</th>
                          <th>Posisi</th>
                          <th>Tanggal Maintenance</th>
                          <th>Biaya</th>
                          <th>Keterangan</th>
                          <th>Status</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        <tr>
                          @foreach($arr_maintenance as $key => $maintenance)
                            <td>{{ $key + 1 }}</td>
                            <td>{{$maintenance->kode}}</td>
                            <td>{{ $maintenance->barang ? $maintenance->barang->b_nama : '- Data barang sudah dihapus -'  }}</td>
                            <td>{{$maintenance->posisi}}</td>
                            <td>{{date('d-m-Y', strtotime($maintenance->tanggal_maintenance))}}</td>
                            <td>{{$maintenance->biaya != 0 ? 'Rp. '. number_format($maintenance->biaya, 2, ',', '.') : 'Free'}}</td>
                            <td>{{$maintenance->keterangan}}</td>
                            <td>{!! ($maintenance->status == 'SELESAI' ? '<span class="label label-success">'.$maintenance->status.'</span>' : ($maintenance->status == 'SEDANG BERJALAN' ? '<span class="label label-warning">'.$maintenance->status.'</span>': '<span class="label label-danger">'.$maintenance->status.'</span>'))!!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
