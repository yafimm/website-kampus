@extends('template.layout')
@section('content')
<div class="container">


    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-bootstrap.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-tabletools.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-reorder.js') }}"></script>

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
        <h2>Halaman Lihat Data Inventaris</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">

            </h3>
            <div class="example-box-wrapper">
                <div class="example-box-wrapper">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Kode Inventaris</label>
                            <div class="col-sm-6">
                                <input disabled name="nama" type="text" class="form-control" id=""
                                    placeholder="Kolom Nama Inventaris" value="{{$data_inventaris->i_kode}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Inventaris</label>
                            <div class="col-sm-6">
                                <input disabled name="nama" type="text" class="form-control" id=""
                                    placeholder="Kolom Nama Inventaris" value="{{$data_inventaris->i_nama}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Unit Inventaris</label>
                            <div class="col-sm-6">
                                <input disabled name="unit" type="number" class="form-control" id=""
                                    placeholder="Kolom Unit Inventaris" value="{{$data_inventaris->i_unit}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Harga Inventaris</label>
                            <div class="col-sm-6">
                                <input disabled name="harga" type="number" class="form-control" id=""
                                    placeholder="Kolom Harga Inventaris" value="{{$data_inventaris->i_harga}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Posisi Inventaris</label>
                            <div class="col-sm-6">
                                <input disabled name="posisi" type="text" class="form-control" id=""
                                    placeholder="Kolom Posisi Inventaris"
                                    value="{{$data_inventaris->i_posisi}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Keterangan Inventaris</label>
                            <div class="col-sm-6">
                                <textarea disabled placeholder="Kolom Keterangan Inventaris" class="form-control"
                                    name="keterangan" id="keterangan" cols="30"
                                    rows="10">{{$data_inventaris->i_keterangan}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Foto Inventaris</label>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="thumbnail-box thumbnail-box-inverse">
                                        <a href="#" title="Foto Inventaris" class="thumb-link"></a>
                                        <div class="thumb-content">
                                            <div class="center-vertical">
                                                <div class="center-content">
                                                    <h3 class="thumb-heading animated bounceIn">
                                                        {{$data_inventaris->i_nama}}
                                                        <small>{{$data_inventaris->created_at}}</small>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="thumb-overlay bg-black"></div>
                                        <img src="{{ asset('assets/images-resource/inventaris/resize_'.$data_inventaris->i_foto) }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">

                            <div class="col-sm-3">
                                <a href="{{ route('inventaris.index') }}" class="btn btn-blue-alt"><i
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
