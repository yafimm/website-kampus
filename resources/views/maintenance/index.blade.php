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
        <h2>Halaman Data Inventaris</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">
                <a href="{{ route('maintenance.create') }}" class="btn btn-primary">
                    <i class="glyph-icon icon-plus-circle"></i> Tambah
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
            <div class="example-box-wrapper">
                <table id="dt_maintenance" class="table table-striped table-bordered" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No Register</th>
                            <th>Total Keseluruhan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th></th>
                            <th>No Register</th>
                            <th>Total Keseluruhan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        <tr>
                          @foreach($arr_maintenance as $key => $maintenance)
                            <td>{{ $key + 1 }}</td>
                            <td>{{$maintenance->no_register}}</td>
                            <td>Rp. {{number_format($maintenance->total, 2,',','.')}}</td>
                            <td>{{date('d-m-Y', strtotime($maintenance->tanggal_maintenance))}}</td>
                            <td>
                                <a href="{{ route('maintenance.show', $maintenance->no_register) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Lihat Data">
                                    <i class="glyph-icon icon-eye"></i>
                                </a>
                                <a href="{{ route('maintenance.edit', $maintenance->no_register) }}"
                                    class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Ubah Data">
                                    <i class="glyph-icon icon-pencil"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
