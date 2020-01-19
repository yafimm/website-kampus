@extends('template.layout')
@section('content')
<div class="container">


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
        <h2>Halaman Ubah Data Inventaris</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">

            </h3>
            <div class="example-box-wrapper">
                <div class="example-box-wrapper">
                    <form class="form-horizontal" action="{{ route('inventaris.prosesUbah', $data_inventaris->i_id) }}"
                        method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="{{$data_inventaris->i_id}}">
                        @method('put')
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Kode Inventaris</label>
                            <div class="col-sm-6">
                                <input name="kode" type="text" class="form-control" id=""
                                    placeholder="Kolom Nama Inventaris" value="{{$data_inventaris->i_kode}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Inventaris</label>
                            <div class="col-sm-6">
                                <input required name="nama" type="text" class="form-control" id=""
                                    placeholder="Kolom Nama Inventaris" value="{{$data_inventaris->i_nama}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Unit Inventaris</label>
                            <div class="col-sm-6">
                                <input required name="unit" type="number" class="form-control" id=""
                                    placeholder="Kolom Unit Inventaris" value="{{$data_inventaris->i_unit}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Harga Inventaris</label>
                            <div class="col-sm-6">
                                <input required name="harga" type="number" class="form-control" id=""
                                    placeholder="Kolom Harga Inventaris" value="{{$data_inventaris->i_harga}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Posisi Inventaris</label>
                            <div class="col-sm-6">
                                <input required name="posisi" type="text" class="form-control" id=""
                                    placeholder="Kolom Posisi Inventaris" value="{{$data_inventaris->i_posisi}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Keterangan Inventaris</label>
                            <div class="col-sm-6">
                                <textarea placeholder="Kolom Keterangan Inventaris" class="form-control"
                                    name="keterangan" id="keterangan" cols="30" rows="10">{{$data_inventaris->i_keterangan}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Foto Inventaris</label>
                            <div class="col-sm-6">
                                <input type="file" name="foto" id="foto" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-success">
                                    <i class="glyph-icon icon-file"></i> Simpan</button>
                                <a href="{{ url('/admin/inventaris') }}" class="btn btn-blue-alt"><i
                                        class="glyph-icon icon-arrow-left"></i> Kembali</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>


        </div>
    </div>


</div>
@endsection
