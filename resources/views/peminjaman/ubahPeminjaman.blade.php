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

        //console.log(dateEnd);
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

    <script type="text/javascript" src="{{ asset('assets/widgets/timepicker/timepicker.js') }}"></script>
    <script type="text/javascript">
        var peminjamanId = {{count($data_peminjaman[0]->detail_peminjaman)}};
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
    <script type="text/javascript" src="{{ asset('js/peminjaman.js') }}"></script>

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
                                @if($errors->has('inp_nama_event'))
                                   <small class="form-text text-danger">*{{ $errors->first('inp_nama_event') }}</small>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" name="pid" value="{{$data_peminjaman[0]->p_id}}">
                        <input type="hidden" name="status" value="0">
                        <input type="hidden" name="iduser" value="{{Auth::user()->id}}">
                        <h3 class="title-hero">
                            Data Inventaris Yang Dipinjam
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
                                @if($errors->has('idinventaris'))
                                   <small class="form-text text-danger">*{{ $errors->first('idinventaris') }}</small>
                                @endif
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="content-daftar-inventaris" id="content-daftar-inventaris">
                            @foreach ($data_peminjaman[0]->detail_peminjaman as $key => $detail)
                            <div id="peminjaman-{{ $key }}"class="form-group">
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
                                <div class="col-sm-3">
                                  <button class="btn btn-danger btn-sm" type="button"
                                      onclick="hapusItem({{ $key }}, value)" data-toggle="tooltip" data-placement="top"title="Hapus Data"><i class="glyph-icon icon-trash"></i>
                                  </button>
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
                                        class="bootstrap-datepicker form-control" value="{{ date('d-m-Y', strtotime($data_peminjaman[0]->p_date)) }}"
                                        data-date-format="mm-dd-yyyy">
                                    @if($errors->has('datestart'))
                                      <small class="form-text text-danger">*{{ $errors->first('datestart') }}</small>
                                    @endif
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
                                        class="bootstrap-datepicker form-control" value="{{ date('d-m-Y', strtotime($data_peminjaman[0]->p_date_end)) }}"
                                        data-date-format="mm-dd-yyyy">
                                </div>
                                @if($errors->has('dateend'))
                                <small class="form-text text-danger">*{{ $errors->first('dateend') }}</small>
                                @endif
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
                                <a href="{{ route('peminjaman.index') }}" class="btn btn-blue-alt"><i
                                        class="glyph-icon icon-arrow-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-success">
                                    <i class="glyph-icon icon-check"></i> Simpan</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
