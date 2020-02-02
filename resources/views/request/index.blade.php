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
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-tabletools.js') }}"></script>
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
        <h2>Halaman Data Request Barang</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('bagumum'))
            <h3 class="title-hero">
              @if(Auth::user()->hasRole('admin'))
              <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#modalReportTahunan">
                  <i class="glyph-icon icon-clipboard"></i> Cetak Laporan
              </button>
              @endif
            </h3>
            @endif
            <div class="example-box-wrapper">
                <table id="dt_barang" class="table table-striped table-bordered" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>User</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th></th>
                            <th>User</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @foreach ($data_request as $key => $request)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$request->name}}</td>
                            <td>{{$request->b_nama}}</td>
                            <td>{{$request->rb_jumlah}}</td>
                            <td>
                                @if ($request->rb_status == 0)
                                    <span class="bs-label label-blue-alt">Menunggu</span>
                                @elseif($request->rb_status == 1)
                                    <span class="bs-label label-danger">Ditolak</span>
                                @elseif($request->rb_status == 2)
                                    <span class="bs-label label-success">Disetujui</span>
                                @endif
                            </td>
                            <td>
                                @if ($request->rb_status == 0)
                                    <a href="{{ route('request.lihat',$request->rb_id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Lihat Data">
                                        <i class="glyph-icon icon-eye"></i>
                                    </a>
                                    @if(Auth::user()->hasRole('dosen'))
                                    <a href="{{ route('request.ubah',$request->rb_id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ubah Data">
                                        <i class="glyph-icon icon-edit"></i>
                                    </a>
                                    @endif
                                    @if((Auth::user()->hasRole('admin') || Auth::user()->hasRole('bagumum')))
                                    <button class="btn btn-success btn-md" data-toggle="modal"
                                    data-target="#modalSetuju" data-requestid="{{$request->rb_id}}" data-toggle="tooltip" data-placement="top" title="Setuju">
                                    <i class="glyph-icon icon-check"></i>
                                    </button>

                                    <button class="btn btn-warning btn-md" data-toggle="modal"
                                    data-target="#modalTolak" data-requestid="{{$request->rb_id}}" data-toggle="tooltip" data-placement="top" title="Tolak">
                                    <i class="glyph-icon icon-remove"></i>
                                    </button>
                                    @endif

                                    <button class="btn btn-danger btn-md" data-toggle="modal"
                                    data-target="#modalHapus" data-requestid="{{$request->rb_id}}" data-toggle="tooltip" data-placement="top" title="Hapus Data">
                                    <i class="glyph-icon icon-trash"></i>
                                    </button>
                                @elseif($request->rb_status == 1)
                                    <a href="{{ route('request.lihat',$request->rb_id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Lihat Data">
                                        <i class="glyph-icon icon-eye"></i>
                                    </a>

                                    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('bagumum'))

                                    @endif
                                    <button class="btn btn-danger btn-md" data-toggle="modal"
                                    data-target="#modalHapus" data-requestid="{{$request->rb_id}}" data-toggle="tooltip" data-placement="top" title="Hapus Data">
                                    <i class="glyph-icon icon-trash"></i>
                                    </button>
                                @elseif($request->rb_status == 2)
                                    <a href="{{ route('request.lihat',$request->rb_id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Lihat Data">
                                        <i class="glyph-icon icon-eye"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Kumpulan Modal -->
    <div class="modal fade" id="modalSetuju" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#079bef;color:#fff">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Konfirmasi Setuju</h4>
                </div>
                <form name="setujuForm" id="setujuForm" action="{{ route('request.prosesKonfirmasi') }}"
                    method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="idsetuju" id="idsetuju">
                    <input type="hidden" name="jenis" id="jenis" value="2">
                    <div class="modal-body">
                        <p>Yakin ingin Konfirmasi Setuju ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Setuju</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#modalSetuju').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('requestid');
            var modal = $(this);
            modal.find('#idsetuju').val(id);
        });
    </script>

    <div class="modal fade" id="modalTolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#e67e22;color:#fff">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Tolak Request</h4>
                </div>
                <form name="deleteForm" id="deleteForm" action="{{ route('request.prosesKonfirmasi') }}"
                    method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="idtolak" id="idtolak">
                    <input type="hidden" name="jenis" id="jenis" value="1">
                    <div class="modal-body">
                        <p>Yakin ingin menolak request ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Tolak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#modalTolak').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('requestid');
            var modal = $(this);
            modal.find('#idtolak').val(id);
        });
    </script>

    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#e74c3c;color:#fff">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Hapus Request</h4>
                </div>
                <form name="deleteForm" id="deleteForm" action="{{ route('request.prosesHapus') }}"
                    method="POST" class="form-horizontal">
                    @CSRF
                    <input type="hidden" name="idhapus" id="idhapus">
                    <div class="modal-body">
                        <p>Yakin ingin menghapus data request ?</p>
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
            var id = button.data('requestid');
            var modal = $(this);
            modal.find('#idhapus').val(id);
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
                <form name="reportTahunan" id="reportTahunan" action="{{ route('request.cetak') }}"
                    method="POST" class="form-horizontal bordered-row">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Dari Tanggal</label>
                            <div class="col-sm-6">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon">
                                        <i class="glyph-icon icon-calendar"></i>
                                    </span>
                                    <input id="dari-tanggal" name="mulai" type="text" class="bootstrap-datepicker form-control" value=""
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
                                    <input id="sampai-tanggal" name="akhir" type="text" class="bootstrap-datepicker form-control" value=""
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
