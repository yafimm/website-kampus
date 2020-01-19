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
            var table = $('#dt_pengadaan').DataTable();
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
        <h2>Halaman Data Pengadaan</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">
                <a href="{{ route('pengadaan.create') }}" class="btn btn-primary">
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
                <table id="dt_pengadaan" class="table table-striped table-bordered" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No Register</th>
                            <th>Nama Suplier / Toko</th>
                            <th>Total Keseluruhan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th></th>
                            <th>No Register</th>
                            <th>Nama Suplier / Toko</th>
                            <th>Total Keseluruhan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        <tr>
                          @foreach($arr_pengadaan as $key => $pengadaan)
                            <td>{{ $key + 1 }}</td>
                            <td>{{$pengadaan->no_register}}</td>
                            <td>{{$pengadaan->supplier}}</td>
                            <td>Rp. {{number_format($pengadaan->totalkeseluruhan, 2,',','.')}}</td>
                            <td>{{date('d-m-Y', strtotime($pengadaan->tanggal))}}</td>
                            <td>
                                <a href="{{ route('pengadaan.show', $pengadaan->no_register) }}" class="btn btn-info">
                                    <i class="glyph-icon icon-circle-o"></i> Lihat
                                </a>
                                <a href="{{ route('pengadaan.edit', $pengadaan->no_register) }}"
                                    class="btn btn-warning">
                                    <i class="glyph-icon icon-pencil"></i> Ubah
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
