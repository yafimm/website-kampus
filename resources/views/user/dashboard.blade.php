@extends('template.layout')
@section('content')
<div class="container">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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

        $(function () {
            "use strict";
            $('#datestart').bsdatepicker({
                format: 'dd-mm-yyyy'
            });
        });
        $(function () {
            "use strict";
            $('#dateend').bsdatepicker({
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
            var table = $('#dt_peminjaman').DataTable();
            var tt = new $.fn.dataTable.TableTools(table);
            $('.dataTables_filter input').attr("placeholder", "Search...");
        });

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
        <h2>Dashboard</h2>
        <p>Selamat Datang {{Auth::user()->name}} |
            <strong>{{ ucwords(str_replace('_', ' ',Auth::user()->role)) }}</strong></p>
    </div>


    @if(Auth::user()->hasRole('yayasan'))
    <div class="panel">
        <div class="panel-body">
            <form class="" action="{{ route('report.index') }}" method="get">
                <div class="form-group col-sm-12 col-md-8 col-lg-3">
                    <label class="col-sm-12 control-label">Jenis Report</label>
                    <select class="col-lg-11 form-control" name="jenis" style="height:33px">
                        <option name="jenis" value="datapengadaan"
                            {{ Request::get("jenis") == 'datapengadaan' ? 'selected' : ''}}>Data Pengadaan</option>
                        <option name="jenis" value="datainventaris"
                            {{ Request::get("jenis") == 'datainventaris' ? 'selected' : ''}}>Data Inventaris</option>
                        <option name="jenis" value="databarang"
                            {{ Request::get("jenis") == 'databarang' ? 'selected' : ''}}>Data Barang</option>
                        <option name="jenis" value="datapeminjaman"
                            {{ Request::get("jenis") == 'datapeminjaman' ? 'selected' : ''}}>Data Peminjaman</option>
                        <option name="jenis" value="datapengguna"
                            {{ Request::get("jenis") == 'datapengguna' ? 'selected' : ''}}>Data Pengguna</option>
                        <option name="jenis" value="datarequest"
                            {{ Request::get("jenis") == 'datarequest' ? 'selected' : ''}}>Data Request Barang</option>
                        <option value="datamaintenance"
                            {{ Request::get("jenis") == 'datamaintenance' ? 'selected' : ''}}>Data Maintenance</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-8 col-lg-3">
                    <label class="col-sm-12 control-label">Dari Tanggal </label>
                    <div class="col-sm-12">
                        <div class="input-prepend input-group">
                            <span class="add-on input-group-addon" style="width:50px;">
                                <i class="glyph-icon icon-calendar"></i>
                            </span>
                            <input required id="datestart" name="mulai" type="text"
                                class="bootstrap-datepicker form-control" value="{{ Request::get('mulai') }}"
                                data-date-format="mm/dd/yyyy">
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12 col-md-8 col-lg-3">
                    <label class="col-sm-12 control-label">Sampai Tanggal</label>
                    <div class="col-sm-12">
                        <div class="input-prepend input-group">
                            <span class="add-on input-group-addon" style="width:50px;">
                                <i class="glyph-icon icon-calendar"></i>
                            </span>
                            <input required id="dateend" name="akhir" type="text"
                                class="bootstrap-datepicker form-control" value="{{ Request::get('akhir') }}"
                                data-date-format="mm/dd/yyyy">
                        </div>
                    </div>
                </div>

                <div class="container pt-4">
                    <button class="btn btn-primary col-sm-12 col-md-8 col-lg-2 mt-1 ml-lg-4">
                        <i class="glyph-icon icon-clipboard"></i> Proses
                    </button>
                </div>

            </form>
        </div>
    </div>

    @endif

    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('staff_inventaris') || Auth::user()->hasRole('dosen'))
    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">
                <p>Data Request</p>
                @if(Auth::user()->hasRole('admin'))
                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#modalReportRequest">
                    <i class="glyph-icon icon-clipboard"></i> Cetak
                </button>
                @endif
            </h3>
            <div class="example-box-wrapper" style="overflow: auto;">
                <table id="dt_barang" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>User</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Tanggal</th>
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
                            <th>Tanggal</th>
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
                                <span class="bs-label label-warning">Menunggu</span>
                                @elseif($request->rb_status == 1)
                                <span class="bs-label label-danger">Ditolak</span>
                                @elseif($request->rb_status == 2)
                                <span class="bs-label label-primary">Disetujui</span>
                                @else
                                <span class="bs-label label-success">Selesai</span>
                                @endif
                            </td>
                            <td>{{ date('d/m/Y', strtotime($request->created_at)) }}</td>
                            <td>
                                @if ($request->rb_status == 0)
                                <a href="{{ route('request.lihat', $request->rb_id) }}" class="btn btn-info"
                                    data-toggle="tooltip" data-placement="top" title="Lihat Data">
                                    <i class="glyph-icon icon-eye"></i>
                                </a>

                                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('staff_inventaris'))
                                <button class="btn btn-primary btn-md" data-toggle="modal"
                                    data-target="#modalSetujuRequest" data-requestid="{{$request->rb_id}}"
                                    data-toggle="tooltip" data-placement="top" title="Setuju">
                                    <i class="glyph-icon icon-check"></i>
                                </button>

                                <button class="btn btn-warning btn-md" data-toggle="modal"
                                    data-target="#modalTolakRequest" data-requestid="{{$request->rb_id}}"
                                    data-toggle="tooltip" data-placement="top" title="Tolak">
                                    <i class="glyph-icon icon-remove"></i>
                                </button>

                                @endif
                                <button class="btn btn-danger btn-md" data-toggle="modal"
                                    data-target="#modalHapusRequest" data-requestid="{{$request->rb_id}}"
                                    data-toggle="tooltip" data-placement="top" title="Hapus">
                                    <i class="glyph-icon icon-trash"></i>
                                </button>
                                @elseif($request->rb_status == 1)
                                <a href="{{ route('request.lihat', $request->rb_id) }}" class="btn btn-info"
                                    data-toggle="tooltip" data-placement="top" title="Lihat Data">
                                    <i class="glyph-icon icon-eye"></i>
                                </a>

                                <button class="btn btn-danger btn-md" data-toggle="modal"
                                    data-target="#modalHapusRequest" data-requestid="{{$request->rb_id}}"
                                    data-toggle="tooltip" data-placement="top" title="Hapus Data">
                                    <i class="glyph-icon icon-trash"></i>
                                </button>
                                @elseif($request->rb_status == 2)
                                <a href="{{ route('request.lihat',$request->rb_id) }}" class="btn btn-info"
                                    data-toggle="tooltip" data-placement="top" title="Lihat Data">
                                    <i class="glyph-icon icon-eye"></i>
                                </a>
                                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('staff_inventaris'))
                                <button class="btn btn-success btn-md" data-toggle="modal"
                                    data-target="#modalSetujuRequest" data-requestid="{{$request->rb_id}}"
                                    data-toggle="tooltip" data-placement="top" title="Selesai">
                                    <i class="glyph-icon icon-check"></i>
                                </button>
                                @endif
                                @else
                                <a href="{{ route('request.lihat',$request->rb_id) }}" class="btn btn-info"
                                    data-toggle="tooltip" data-placement="top" title="Lihat Data">
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
    <div class="modal fade" id="modalSetujuRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#079bef;color:#fff">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Konfirmasi Setuju</h4>
                </div>
                <form name="setujuForm" id="setujuForm" action="{{ route('request.prosesKonfirmasi') }}" method="POST"
                    class="form-horizontal">
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
        $('#modalSetujuRequest').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('requestid');
            var modal = $(this);
            modal.find('#idsetuju').val(id);
        });

    </script>

    <div class="modal fade" id="modalTolakRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#e67e22;color:#fff">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Tolak Request</h4>
                </div>
                <form name="deleteForm" id="deleteForm" action="{{ route('request.prosesKonfirmasi') }}" method="POST"
                    class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="idtolakRequest" id="idtolakRequest">
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
        $('#modalTolakRequest').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('requestid');
            var modal = $(this);
            modal.find('#idtolakRequest').val(id);
        });

    </script>

    <div class="modal fade" id="modalHapusRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#e74c3c;color:#fff">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Hapus Request</h4>
                </div>
                <form name="deleteForm" id="deleteForm" action="{{ route('request.prosesHapus') }}" method="POST"
                    class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="idhapusRequest" id="idhapusRequest">
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
        $('#modalHapusRequest').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('requestid');
            var modal = $(this);
            modal.find('#idhapusRequest').val(id);
        });

    </script>

    <div class="modal fade" id="modalReportRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>Cetak Laporan</strong></h4>
                </div>
                <form name="reportTahunan" id="reportTahunan" action="{{ route('request.cetak') }}" method="POST"
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

    @endif

    @if(!Auth::user()->hasRole('yayasan'))
    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">
                <p>Data Peminjaman</p>
                @if(Auth::user()->hasRole('admin'))
                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#modalReportTahunanPeminjaman">
                    <i class="glyph-icon icon-clipboard"></i> Cetak
                </button>
                @endif
            </h3>
            <div class="example-box-wrapper" style="overflow: auto;">
                <table id="dt_peminjaman" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama User</th>
                            <th>Tanggal Peminjaman Mulai</th>
                            <th>Tanggal Peminjaman Berakhir</th>
                            <th>File Surat Peminjaman</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama User</th>
                            <th>Tanggal Peminjaman Mulai</th>
                            <th>Tanggal Peminjaman Berakhir</th>
                            <th>File Surat Peminjaman</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @php
                        $count = 0;
                        @endphp
                        @foreach ($data_peminjaman as $peminjaman)
                        @php
                        $count = $count + 1;
                        @endphp
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$peminjaman->user ? $peminjaman->user->name : '- Data User sudah dihapus -'}}</td>
                            <td>{{date('d/m/Y', strtotime($peminjaman->p_date))}}</td>
                            <td>{{date('d/m/Y', strtotime($peminjaman->p_date_end))}}</td>
                            <td><a target="_blank"
                                    href="{{ asset('suratpeminjaman/'.$peminjaman->p_scan_surat_peminjaman) }}">Download</a>
                            </td>
                            <td>
                                @if ($peminjaman->p_status == 0)
                                <span class="bs-label label-warning">Menunggu</span>
                                @elseif($peminjaman->p_status == 1)
                                <span class="bs-label label-primary">Diterima</span>
                                @elseif($peminjaman->p_status == 2)
                                <span class="bs-label label-danger">Ditolak</span>
                                @else
                                <span class="bs-label label-success">Selesai</span>
                                @endif
                            </td>
                            <td>
                                @if ($peminjaman->p_status == 0)
                                <a href="{{ route('peminjaman.lihat', $peminjaman->p_id) }}" class="btn btn-info">
                                    <i class="glyph-icon icon-eye"></i>
                                </a>

                                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('staff_inventaris'))
                                <button class="btn btn-primary btn-md" data-toggle="modal"
                                    data-target="#modalSetujuPeminjaman" data-peminjamanid="{{$peminjaman->p_id}}"
                                    data-toggle="tooltip" data-placement="top" title="Setuju">
                                    <i class="glyph-icon icon-check"></i>
                                </button>

                                <button class="btn btn-warning btn-md" data-toggle="modal"
                                    data-target="#modalTolakPeminjaman" data-peminjamanid="{{$peminjaman->p_id}}"
                                    data-toggle="tooltip" data-placement="top" title="Tolak">
                                    <i class="glyph-icon icon-remove"></i>
                                </button>
                                @endif

                                <button class="btn btn-danger btn-md" data-toggle="modal"
                                    data-target="#modalHapusPeminjaman" data-peminjamanid="{{$peminjaman->p_id}}"
                                    data-toggle="tooltip" data-placement="top" title="Hapus Data">
                                    <i class="glyph-icon icon-trash"></i>
                                </button>
                                @elseif($peminjaman->p_status == 1)
                                <a href="{{ route('peminjaman.lihat', $peminjaman->p_id) }}" class="btn btn-info"
                                    data-toggle="tooltip" data-placement="top" title="Lihat Data">
                                    <i class="glyph-icon icon-eye"></i>
                                </a>
                                @else
                                <a href="{{ route('peminjaman.lihat', $peminjaman->p_id) }}" class="btn btn-info"
                                    data-toggle="tooltip" data-placement="top" title="Lihat Data">
                                    <i class="glyph-icon icon-eye"></i>
                                </a>
                                <button class="btn btn-danger btn-md" data-toggle="modal"
                                    data-target="#modalHapusPeminjaman" data-peminjamanid="{{$peminjaman->p_id}}"
                                    data-toggle="tooltip" data-placement="top" title="Hapus Data">
                                    <i class="glyph-icon icon-trash"></i>
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
    @endif

    <!-- Kumpulan Modal -->

    <div class="modal fade" id="modalSetujuPeminjaman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#079bef;color:#fff">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Konfirmasi Setuju</h4>
                </div>
                <form name="setujuForm" id="setujuForm" action="{{ route('peminjaman.prosesKonfirmasi') }}"
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
        $('#modalSetujuPeminjaman').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('peminjamanid');
            var modal = $(this);
            modal.find('#idsetuju').val(id);
        });

    </script>

    <div class="modal fade" id="modalTolakPeminjaman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#e67e22;color:#fff">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Tolak peminjaman</h4>
                </div>
                <form name="deleteForm" id="deleteForm" action="{{ route('peminjaman.prosesKonfirmasi') }}"
                    method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="idtolak" id="idtolak">
                    <input type="hidden" name="jenis" id="jenis" value="1">
                    <div class="modal-body">
                        <p>Yakin ingin menolak peminjaman ?</p>
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
        $('#modalTolakPeminjaman').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('peminjamanid');
            var modal = $(this);
            modal.find('#idtolak').val(id);
        });

    </script>

    <div class="modal fade" id="modalHapusPeminjaman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#e74c3c;color:#fff">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Hapus peminjaman</h4>
                </div>
                <form name="deleteForm" id="deleteForm" action="{{ route('peminjaman.prosesHapus') }}" method="POST"
                    class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="idhapus" id="idhapus">
                    <div class="modal-body">
                        <p>Yakin ingin menghapus data peminjaman ?</p>
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
        $('#modalHapusPeminjaman').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('peminjamanid');
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
                    <h4 class="modal-title"><strong>Cetak</strong></h4>
                </div>
                <form name="reportTahunan" id="reportTahunan" action="{{ route('request.cetak') }}" method="POST"
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
