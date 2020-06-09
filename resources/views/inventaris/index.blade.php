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
            var table = $('#dt_inventaris').DataTable();
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
                <a href="{{ route('inventaris.tambah') }}" class="btn btn-primary">
                    <i class="glyph-icon icon-plus-circle"></i> Tambah
                </a>
                @if(Auth::user()->hasRole('admin'))
                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#modalReportTahunan">
                    <i class="glyph-icon icon-clipboard"></i> Cetak Laporan
                </button>
                @endif
            </h3>
            <div class="example-box-wrapper">
                <div class="container" style="overflow: auto">
                    <table id="dt_inventaris" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Unit</th>
                                <th>Harga</th>
                                <th>Posisi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Unit</th>
                                <th>Harga</th>
                                <th>Posisi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>

                        <tbody>
                            @foreach ($data_inventaris as $key => $inventaris)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$inventaris->i_kode}}</td>
                                <td>{{$inventaris->i_nama}}</td>
                                <td>{{$inventaris->i_unit}}</td>
                                <td>{{$inventaris->i_harga}}</td>
                                <td>{{$inventaris->i_posisi}}</td>
                                <td>{{$inventaris->i_keterangan}}</td>
                                <td>
                                    <a href="{{ route('inventaris.lihat', $inventaris->i_id) }}"
                                        class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top"
                                        title="Lihat Data">
                                        <i class="glyph-icon icon-eye"></i>
                                    </a>
                                    <a href="{{ route('inventaris.ubah', $inventaris->i_id) }}"
                                        class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"
                                        title="Ubah Data">
                                        <i class="glyph-icon icon-pencil"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus"
                                        data-inventarisid="{{$inventaris->i_id}}" data-toggle="tooltip"
                                        data-placement="top" title="Hapus Data">
                                        <i class="glyph-icon icon-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
                <form name="deleteForm" id="deleteForm" action="{{ route('inventaris.prosesHapus') }}" method="POST"
                    class="form-horizontal">
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
                    var id = button.data('inventarisid');
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
                    <h4 class="modal-title"><strong>Cetak Laporan</strong></h4>
                </div>
                <form name="reportTahunan" id="reportTahunan" action="{{ route('inventaris.cetak') }}" method="POST"
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
                                        class="bootstrap-datepicker form-control" value=""
                                        data-date-format="dd-mm-yyyy">
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
                                        class="bootstrap-datepicker form-control" value=""
                                        data-date-format="dd-mm-yyyy">
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
</div>

@endsection