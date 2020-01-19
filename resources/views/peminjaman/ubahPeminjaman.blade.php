@extends('template.layout')
@section('content')
<div class="container">
    @php
    $explode_date_start = explode("-",$data_peminjaman[0]->p_date);
    $start_year = $explode_date_start[2];
    $explode_date_start_month = explode("0",$explode_date_start[0]);
    $start_month = $explode_date_start_month[1]-1;
    $start_day = $explode_date_start[1];
    $explode_date_end = explode("-",$data_peminjaman[0]->p_date_end);
    $end_year = $explode_date_end[2];
    $explode_date_end_month = explode("0",$explode_date_end[0]);
    $end_month = $explode_date_end_month[1]-1;
    $end_day = $explode_date_end[1];
    @endphp

    <script type="text/javascript" src="{{ asset('assets/widgets/datepicker/datepicker.js') }}"></script>
    <script type="text/javascript">
        /* Datepicker bootstrap */
        var date = new Date();
        //var dateStart = new Date({{'2019'}}, {{'11'}}, {{'02'}});
        var dateStart = new Date({
            {
                $start_year
            }
        }, {
            {
                $start_month
            }
        }, {
            {
                $start_day
            }
        });
        var dateEnd = new Date({
            {
                $end_year
            }
        }, {
            {
                $end_month
            }
        }, {
            {
                $end_day
            }
        });
        //console.log(dateEnd);
        $(function () {
            "use strict";
            $('#datestart').bsdatepicker({
                format: 'mm-dd-yyyy'
            });
        });
        $(function () {
            "use strict";
            $('#dateend').bsdatepicker({
                format: 'mm-dd-yyyy'
            });
        });
        $('#datestart').bsdatepicker('setDate', dateStart);
        $('#dateend').bsdatepicker('setDate', dateEnd);
    </script>
    <!-- Bootstrap Datepicker -->
    <script type="text/javascript" src="{{ asset('assets/widgets/datepicker-ui/datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datepicker-ui/datepicker-demo.js') }}">
    </script>

    <script type="text/javascript" src="{{ asset('assets/widgets/timepicker/timepicker.js') }}"></script>
    <script type="text/javascript">
        /* Timepicker */
        $(function () {
            "use strict";
            $('#timestart').timepicker({
                timeFormat: 'HH:mm:ss'
            });
        });
        $(function () {
            "use strict";
            $('#timeend').timepicker({
                timeFormat: 'HH:mm:ss'
            });
        });
    </script>

    <script type="text/javascript" src="{{ asset('assets/widgets/chosen/chosen.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/chosen/chosen-demo.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-bootstrap.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-tabletools.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-reorder.js') }}"></script>

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
        <h2>Halaman Peminjaman Barang</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">

            </h3>
            <div class="example-box-wrapper">
                <div class="example-box-wrapper">
                    <form class="form-horizontal" action="{{ route('peminjaman.prosesUbah', $data_peminjaman[0]->p_id) }}"
                        method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('put')
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Kegiatan</label>
                            <div class="col-sm-6">
                                <input required name="inp_nama_event" type="text" class="form-control" id=""
                                    placeholder="Nama Kegiatan" value="{{$data_peminjaman[0]->p_nama_event}}">
                            </div>
                        </div>
                        <input type="hidden" name="pid" value="{{$data_peminjaman[0]->p_id}}">
                        <input type="hidden" name="status" value="0">
                        <input type="hidden" name="iduser" value="{{Auth::user()->id}}">
                        <h3 class="title-hero">
                            Data Barang/Inventaris Yang Dipinjam
                        </h3>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Pilih Inventaris yang Ingin dipinjam</label>
                            <div class="col-sm-6">
                                <select id="inventaris" name="inventaris" class="chosen-select">
                                    <option data-invid="title" data-invnama="title" value="title">Silahkan Pilih
                                    </option>
                                    @foreach ($data_inventaris as $inventaris)
                                    <option data-invid="{{$inventaris->i_id}}"
                                        data-invnama="{{$inventaris->i_nama}}" value="{{$inventaris->i_id}}"
                                        @foreach ($data_peminjaman[0]->detail_peminjaman as $detail)
                                        @if ($detail->i_id == $inventaris->i_id)
                                        {{'selected'}}
                                        @endif
                                        @endforeach>
                                        {{$inventaris->i_nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="content-daftar-inventaris" id="content-daftar-inventaris">
                            @foreach ($data_peminjaman[0]->detail_peminjaman as $detail)
                            <div class="form-group">
                                <div class="col-sm-3">
                                </div>
                                <label class="col-sm-3 control-label">
                                    @foreach ($data_inventaris as $inventaris)
                                    @if ($inventaris->i_id == $detail->i_id)
                                    {{$inventaris->i_nama}}
                                    @endif
                                    @endforeach
                                </label>
                                <div class="col-sm-3">
                                    <input type="hidden" name="idinventaris[]" value="{{$detail->i_id}}">
                                    <input required name="jumlahinventaris[]" type="number" class="form-control"
                                        id="" placeholder="Jumlah" value="{{$detail->dp_jumlah}}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <hr>
                        <h3 class="title-hero">
                            Tanggal Peminjaman
                        </h3>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tanggal Awal Peminjaman</label>
                            <div class="col-sm-3">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon">
                                        <i class="glyph-icon icon-calendar"></i>
                                    </span>
                                    <input required id="datestart" name="datestart" type="text"
                                        class="bootstrap-datepicker form-control" value="{{ $data_peminjaman[0]->p_date }}"
                                        data-date-format="mm-dd-yyyy">
                                </div>
                            </div>
                            <label class="col-sm-3 control-label">Jam Peminjaman Awal</label>
                            <div class="col-sm-3">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon">
                                        <i class="glyph-icon icon-calendar"></i>
                                    </span>
                                    <div class="col-sm-8">
                                        <div class="bootstrap-timepicker dropdown">
                                            <input required class="timepicker-example form-control"
                                                id="timestart" name="timestart" type="text"
                                                value="{{$data_peminjaman[0]->p_time_start}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tanggal Akhir Peminjaman</label>
                            <div class="col-sm-3">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon">
                                        <i class="glyph-icon icon-calendar"></i>
                                    </span>
                                    <input required id="dateend" name="dateend" type="text"
                                        class="bootstrap-datepicker form-control" value="{{ $data_peminjaman[0]->p_date_end }}"
                                        data-date-format="mm-dd-yyyy">
                                </div>
                            </div>
                            <label class="col-sm-3 control-label">Jam Peminjaman Akhir</label>
                            <div class="col-sm-3">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon">
                                        <i class="glyph-icon icon-calendar"></i>
                                    </span>
                                    <div class="col-sm-8">
                                        <div class="bootstrap-timepicker dropdown">
                                            <input required class="timepicker-example form-control" id="timeend"
                                                name="timeend" type="text"
                                                value="{{$data_peminjaman[0]->p_time_end}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h3 class="title-hero">
                            Dokumen Peminjaman
                        </h3>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">File Dokumen *scan persetujuan
                                kegiatan</label>
                            <div class="col-sm-3">
                                <input name="file" type="file" class="form-control" id=""
                                    placeholder="File Dokumen">
                            </div>
                            <div class="col-sm-3">
                                <span class="bs-label label-default"><a target="_blank"
                                        href="{{ asset('suratpeminjaman/'.$data_peminjaman[0]->p_scan_surat_peminjaman) }}">Download</a>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-3">
                                <a href="{{ url('/user/peminjaman') }}" class="btn btn-blue-alt"><i
                                        class="glyph-icon icon-arrow-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-success">
                                    <i class="glyph-icon icon-check"></i> Simpan</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <script>
                $('#inventaris').change(function () {
                    var selectedObject = $(this).find('option:selected');
                    var id = selectedObject.data("invid");
                    var nama = selectedObject.data("invnama");
                    if (id == 'title') {
                    } else {
                        $("#content-daftar-inventaris").append('<div class="form-group">' +
                            '<div class="col-sm-3">' +
                            '</div>' +
                            '<label class="col-sm-3 control-label">' + nama + '</label>' +
                            '<div class="col-sm-3">' +
                            '<input type="hidden" name="idinventaris[]" value="' + id + '">' +
                            '<input required name="jumlahinventaris[]" type="number" class="form-control"' +
                            'id="" placeholder="Jumlah">' +
                            '</div></div>');
                    }
                });
            </script>

        </div>
    </div>


</div>
@endsection
