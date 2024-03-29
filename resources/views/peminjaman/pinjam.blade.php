@extends('template.layout')
@section('content')
<div class="container">

    <script type="text/javascript" src="{{ asset('assets/widgets/datepicker/datepicker.js') }}"></script>
    <script type="text/javascript">
        /* Datepicker bootstrap */
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

    <script type="text/javascript">
        var peminjamanId = 0;
    </script>


    <script type="text/javascript" src="{{ asset('js/peminjaman.js') }}"></script>

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
                    <form class="form-horizontal" action="{{ route('peminjaman.prosesPinjam') }}"
                        method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Kegiatan</label>
                            <div class="col-sm-6">
                                <input required name="inp_nama_event" type="text" class="form-control" id=""
                                    placeholder="Nama Kegiatan">
                                @if($errors->has('inp_nama_event'))
                                   <small class="form-text text-danger">*{{ $errors->first('inp_nama_event') }}</small>
                                @endif
                            </div>
                        </div>

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
                                        data-invnama="{{$inventaris->i_nama}}" value="{{$inventaris->i_id}}">
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
                                        class="bootstrap-datepicker form-control" value=""
                                        data-date-format="mm/dd/yyyy">

                                </div>
                                @if($errors->has('datestart'))
                                <small class="form-text text-danger">*{{ $errors->first('datestart') }}</small>
                                @endif
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
                                                id="timestart" name="timestart" type="text">
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
                                        class="bootstrap-datepicker form-control" value=""
                                        data-date-format="mm/dd/yyyy">
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
                                                name="timeend" type="text">
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
                            <div class="col-sm-6">
                                <input required name="file" type="file" class="form-control" id=""
                                    placeholder="File Dokumen">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-success">
                                    <i class="glyph-icon icon-check"></i> Tambahkan</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>



        </div>
    </div>


</div>
@endsection
