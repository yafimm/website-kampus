@extends('bagumum.app')
@section('content')
<div id="page-content-wrapper">
    <div id="page-content">

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
                    var table = $('#dt_barang').DataTable();
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
                <h2>Halaman Data Barang</h2>
                <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <h3 class="title-hero">
                        <a href="{{ url('/bagumum/barang/tambah') }}" class="btn btn-primary">
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
                        <table id="dt_barang" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Stock</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Stock</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>

                            <tbody>
                                @php
                                $count = 0;
                                @endphp
                                @foreach ($data_barang as $key => $barang)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$barang->b_nama}}</td>
                                    <td>{{$barang->b_nama}}</td>
                                    <td>{{$barang->b_stock}}</td>
                                    <td>{{$barang->b_satuan}}</td>
                                    <td>{{$barang->b_harga}}</td>
                                    <td>
                                        <a href="{{ url('/bagumum/barang/lihat/'.$barang->b_id) }}" class="btn btn-info">
                                            <i class="glyph-icon icon-circle-o"></i> Lihat
                                        </a>
                                        <a href="{{ url('/bagumum/barang/ubah/'.$barang->b_id) }}"
                                            class="btn btn-warning">
                                            <i class="glyph-icon icon-pencil"></i> Ubah
                                        </a>
                                        <button class="btn btn-danger btn-md" data-toggle="modal"
                                            data-target="#modalHapus" data-barangid="{{$barang->b_id}}">
                                            <i class="glyph-icon icon-remove"></i> Hapus
                                        </button>
                                        <button class="btn btn-primary btn-md" data-toggle="modal"
                                            data-target="#modalRestock" data-barangid="{{$barang->b_id}}">
                                            <i class="glyph-icon icon-refresh"></i> Tambah Stock
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Kumpulan Modal -->
            <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#e74c3c;color:#fff">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Hapus Data</h4>
                        </div>
                        <form name="deleteForm" id="deleteForm" action="{{ url('/bagumum/barang/prosesHapus') }}"
                            method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="id">
                            <div class="modal-body">
                                <p>Yakin ingin menghapus Data ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                $('#modalHapus').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('barangid');
                    var modal = $(this);
                    modal.find('#id').val(id);
                });

            </script>

            <div class="modal fade" id="modalReportTahunan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><strong>Cetak Laporan Tahunan</strong></h4>
                        </div>
                        <form name="reportTahunan" id="reportTahunan" action="{{ url('/bagumum/barang/cetakTahunan') }}"
                            method="POST" class="form-horizontal bordered-row">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Pilih Tahun</label>
                                    <div class="col-sm-6">
                                        <div class="input-prepend input-group">
                                            <span class="add-on input-group-addon">
                                                <i class="glyph-icon icon-calendar"></i>
                                            </span>
                                            <input id="tahunan" name="tahunan" type="text" class="bootstrap-datepicker form-control" value=""
                                                data-date-format="yyyy">
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

            <div class="modal fade" id="modalReportBulanan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><strong>Cetak Laporan Bulanan</strong></h4>
                        </div>
                        <form name="reportBulanan" id="reportBulanan" action="{{ url('/bagumum/barang/cetakBulanan') }}"
                            method="POST" class="form-horizontal bordered-row">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Pilih Bulan</label>
                                    <div class="col-sm-6">
                                        <div class="input-prepend input-group">
                                            <span class="add-on input-group-addon">
                                                <i class="glyph-icon icon-calendar"></i>
                                            </span>
                                            <input id="bulanan" name="bulanan" type="text" class="bootstrap-datepicker form-control" value=""
                                                data-date-format="mm/yyyy">
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

            <div class="modal fade" id="modalReportTanggal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><strong>Cetak Laporan Harian</strong></h4>
                        </div>
                        <form name="reportHarian" id="reportHarian" action="{{ url('/bagumum/barang/cetakHarian') }}"
                            method="POST" class="form-horizontal bordered-row">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Pilih Tanggal</label>
                                    <div class="col-sm-6">
                                        <div class="input-prepend input-group">
                                            <span class="add-on input-group-addon">
                                                <i class="glyph-icon icon-calendar"></i>
                                            </span>
                                            <input id="harian" name="harian" type="text" class="bootstrap-datepicker form-control" value=""
                                                data-date-format="mm/dd/yyyy">
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

            <div class="modal fade" id="modalRestock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#357ef2;color:#fff">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Tambah Stock Barang</h4>
                        </div>
                        <form name="restockForm" id="restockForm" action="{{ url('/bagumum/barang/prosesRestock') }}"
                            method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="id">
                            <div class="modal-body">
                                <p>Masukkan penambahan stock</p>
                                <br>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tambah Stock</label>
                                    <div class="col-sm-6">
                                        <input required name="stock" type="number" class="form-control" id="stock"
                                            placeholder="Kolom Stock Barang">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Tambahkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                $('#modalRestock').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('barangid');
                    var modal = $(this);
                    modal.find('#id').val(id);
                });
            </script>


        </div>
    </div>
</div>
@endsection
