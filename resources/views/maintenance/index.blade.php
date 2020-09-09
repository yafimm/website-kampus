@extends('template.layout')
@section('content')
<div class="container">

    <script type="text/javascript" src="{{ asset('assets/widgets/datepicker/datepicker.js') }}"></script>
    <script type="text/javascript">
        /* Datepicker bootstrap */

        $(function () {
            "use strict";
            $('#dari-tanggal').bsdatepicker({
                format: 'dd-mm-yyyy'
            });
        });

        $(function () {
            "use strict";
            $('#sampai-tanggal').bsdatepicker({
                format: 'dd-mm-yyyy'
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

            dataTableTotal();

            table.on('search.dt', function () {
                  dataTableTotal();
            });

            $('#dt_inventaris_paginate').click(function () {
              $('.tag').tooltip();
              dataTableTotal();
            });

            $('#dt_inventaris_length').on('change', function () {
              $('.tag').tooltip();
              dataTableTotal();
            });

            // function sum total harga
            function dataTableTotal(){
              let startPage = table.page.info().start;
              let endPage = table.page.info().end;
              let totalHarga = 0;
              let totalData = parseInt(table.page.info().end - table.page.info().start);

              // console.log(table.page.info().start);
              for (let i = startPage; i < endPage; i++) {
                  row = table.rows(i).data();
                  // Karena kolom 5 menyesuaikan dengan kolom didatatable, untuk 0 adalah data dari dalam datatable
                  totalHarga += convertRupiahToNumber(row[0][3]);
                  console.log(totalHarga);
              }
              $('#totalPage').html(totalData);
              $('#totalHarga').html(convertNumberToRupiah(totalHarga));
            }


            $('.btn-cetak').click(function(){
              // alert($(this).data('no_register'));
              $('#no_register').val($(this).data('no_register'));
            });
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
        <h2>Halaman Data Maintenance</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">
                <a href="{{ route('maintenance.create') }}" class="btn btn-primary">
                    <i class="glyph-icon icon-plus-circle"></i> Tambah
                </a>
                @if(Auth::user()->hasRole('admin') || Auth::user()->hasrole('staff_inventaris'))
                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#modalReportTanggal">
                    <i class="glyph-icon icon-clipboard"></i> Cetak
                </button>
                @endif
            </h3>
            <div class="example-box-wrapper" style="overflow: auto">
                <table id="dt_maintenance" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No Register</th>
                            <th>Tanggal</th>
                            <th>Total Keseluruhan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr class="table-info">
                          <th colspan="3" class="text-center">Total <br><small class="text-info text-sm">*Untuk <span id="totalPage"></span> Data</small></th>
                          <th colspan="2" class="text-center" id="totalHarga"></th>
                        </tr>
                        <tr class="table-primary">
                          <th colspan="3" class="text-center">Total Keseluruhan <br><small class="text-info text-sm">*Total Seluruh data.</small></th>
                          <th colspan="2" class="text-center">
                              Rp. {{ number_format($arr_maintenance->sum('total'), 2, ',', '.') }}
                          </th>
                        </tr>
                    </tfoot>

                    <tbody>
                      @foreach($arr_maintenance as $key => $maintenance)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{$maintenance->no_register}}</td>
                            <td><span style="display:none;">{{date('Ymd', strtotime($maintenance->tanggal_maintenance))}}</span>{{date('d-m-Y', strtotime($maintenance->tanggal_maintenance))}}</td>
                            <td>Rp. {{number_format($maintenance->total, 2,',','.')}}</td>
                            <td>
                                <a href="{{ route('maintenance.show', $maintenance->no_register) }}"
                                    class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat Data">
                                    <i class="glyph-icon icon-eye"></i>
                                </a>
                                <a href="{{ route('maintenance.edit', $maintenance->no_register) }}"
                                    class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"
                                    title="Ubah Data">
                                    <i class="glyph-icon icon-pencil"></i>
                                </a>
                                @if(Auth::user()->hasRole('admin') || Auth::user()->hasrole('staff_inventaris'))
                                <button class="btn btn-primary btn-sm btn-cetak"
                                    data-no_register="{{ $maintenance->no_register }}" data-toggle="modal"
                                    data-target="#modalReportTahunan" data-toggle="tooltip" data-placement="top"
                                    title="Cetak">
                                    <i class="glyph-icon icon-clipboard"></i>
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="modalReportTanggal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><strong>Cetak Laporan</strong></h4>
            </div>
            <form name="reportTahunan" id="reportTahunan" action="{{ route('maintenance.cetakTanggal') }}" method="POST"
                class="form-horizontal bordered-row">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Dari Tanggal</label>
                        <div class="col-sm-6">
                            <div class="input-prepend input-group">
                                <span class="add-on input-group-addon">
                                    <i class="glyph-icon icon-calendar"></i>
                                </span>
                                <input id="dari-tanggal" name="mulai" type="text"
                                    class="bootstrap-datepicker form-control" value="" data-date-format="dd-mm-yyyy">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Sampai Tanggal</label>
                        <div class="col-sm-6">
                            <div class="input-prepend input-group">
                                <span class="add-on input-group-addon">
                                    <i class="glyph-icon icon-calendar"></i>
                                </span>
                                <input id="sampai-tanggal" name="akhir" type="text"
                                    class="bootstrap-datepicker form-control" value="" data-date-format="dd-mm-yyyy">
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" formtarget="_blank">Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modalReportTahunan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><strong>Cetak Laporan</strong></h4>
            </div>
            <form name="reportTahunan" id="reportTahunan" action="{{ route('maintenance.cetak') }}" method="POST"
                class="form-horizontal bordered-row">
                {{ csrf_field() }}
                <input type="hidden" id="no_register" name="no_register" value="">
                <div class="modal-body">
                    Apakah anda yakin akan mencetak Data ?
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" formtarget="_blank">Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
