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
              var table = $('#dt_pengadaan').DataTable();
              var tt = new $.fn.dataTable.TableTools(table);

              $('.dataTables_filter input').attr("placeholder", "Search...");

              dataTableTotal();

              table.on('search.dt', function () {
                    dataTableTotal();
              });

              $('#dt_pengadaan_paginate').click(function () {
                $('.tag').tooltip();
                dataTableTotal();
              });

              $('#dt_pengadaan_length').on('change', function () {
                $('.tag').tooltip();
                dataTableTotal();
              });

              $('.btn-cetak').click(function(){
                // alert($(this).data('no_register'));
                $('#no_register').val($(this).data('no_register'));
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
                    totalHarga += convertRupiahToNumber(row[0][4]);
                    console.log(totalHarga);
                }
                $('#totalPage').html(totalData);
                $('#totalHarga').html(convertNumberToRupiah(totalHarga));
              }

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
                @if(Auth::user()->hasRole('admin') || Auth::useR()->hasRole('staff_inventaris'))
                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#modalReportTanggal">
                    <i class="glyph-icon icon-clipboard"></i> Cetak
                </button>
                @endif
            </h3>
            <div class="example-box-wrapper" style="overflow: auto">
                <table id="dt_pengadaan" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No Register</th>
                            <th>Nama Suplier / Toko</th>
                            <th>Tanggal</th>
                            <th>Total Keseluruhan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr class="table-info">
                          <th colspan="4" class="text-center">Total <br><small class="text-info text-sm">*Untuk <span id="totalPage"></span> Data, Harga * Stok</small></th>
                          <th colspan="2" class="text-center" id="totalHarga"></th>
                        </tr>
                        <tr class="table-primary">
                          <th colspan="4" class="text-center">Total Keseluruhan <br><small class="text-info text-sm">*Total Seluruh data.</small></th>
                          <th colspan="2" class="text-center">
                              Rp. {{ number_format($arr_pengadaan->sum('total'), 2, ',', '.') }}
                          </th>
                        </tr>
                    </tfoot>

                    <tbody>
                      @foreach($arr_pengadaan as $key => $pengadaan)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{$pengadaan->no_register}}</td>
                            <td>{{$pengadaan->supplier}}</td>
                            <td><span style="display:none;">{{date('Ymd', strtotime($pengadaan->tanggal))}}</span>{{date('d-m-Y', strtotime($pengadaan->tanggal))}}</td>
                            <td>Rp. {{number_format($pengadaan->totalkeseluruhan, 2,',','.')}}</td>
                            <td>
                                <a href="{{ route('pengadaan.show', $pengadaan->no_register) }}" class="btn btn-info btn-sm"
                                    data-toggle="tooltip" data-placement="top" title="Lihat Data">
                                    <i class="glyph-icon icon-eye"></i>
                                </a>
                                <a href="{{ route('pengadaan.edit', $pengadaan->no_register) }}" data-toggle="tooltip"
                                    data-placement="top" title="Ubah Data" class="btn btn-warning btn-sm">
                                    <i class="glyph-icon icon-pencil"></i>
                                </a>
                                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('staff_inventaris'))
                                <button class="btn btn-primary btn-md btn-cetak btn-sm"
                                    data-no_register="{{ $pengadaan->no_register }}" data-toggle="modal"
                                    data-target="#modalReportSatuan" data-toggle="tooltip" data-placement="top"
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

    <div class="modal fade" id="modalReportTanggal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>Cetak Laporan</strong></h4>
                </div>
                <form name="reportTahunan" id="reportTahunan" action="{{ route('pengadaan.cetakTanggal') }}" method="POST"
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

    <div class="modal fade" id="modalReportSatuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>Cetak Laporan</strong></h4>
                </div>
                <form name="reportTahunan" id="reportTahunan" action="{{ route('pengadaan.cetak') }}" method="POST"
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
  </div>

@endsection
