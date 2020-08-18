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
        <h2>Halaman Tambah Data Inventaris</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">

            </h3>
            <div class="example-box-wrapper">
                <div class="example-box-wrapper">
                    <form class="form-horizontal" action="{{ route('inventaris.prosesTambah') }}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Inventaris</label>
                            <div class="col-sm-6">
                                <input required name="nama" type="text" class="form-control" id=""
                                    placeholder="Kolom Nama Inventaris" value="{{ old('nama') }}">
                                @if($errors->has('nama'))
                                   <small class="form-text text-danger">*{{ $errors->first('nama') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Kode Inventaris</label>
                            <div class="col-sm-6">
                                <input required name="kode" type="text" class="form-control" id=""
                                    placeholder="Kolom Kode Inventaris" value="{{ old('kode') }}">
                                @if($errors->has('kode'))
                                   <small class="form-text text-danger">*{{ $errors->first('kode') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Unit Inventaris</label>
                            <div class="col-sm-6">
                                <input required name="unit" type="number" class="form-control" id=""
                                    placeholder="Kolom Unit Inventaris" value="{{ old('unit', 0) }}" readonly>
                                @if($errors->has('unit'))
                                   <small class="form-text text-danger">*{{ $errors->first('unit') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Harga Inventaris</label>
                            <div class="col-sm-6">
                                <input required name="harga" type="number" class="form-control" id=""
                                    placeholder="Kolom Harga Inventaris" value="{{ old('harga') }}">
                                @if($errors->has('harga'))
                                   <small class="form-text text-danger">*{{ $errors->first('harga') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Posisi Inventaris</label>
                            <div class="col-sm-6">
                                <input required name="posisi" type="text" class="form-control" id=""
                                    placeholder="Kolom Posisi Inventaris" value="{{ old('posisi') }}">
                                @if($errors->has('posisi'))
                                   <small class="form-text text-danger">*{{ $errors->first('posisi') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Keterangan Inventaris</label>
                            <div class="col-sm-6">
                                <textarea placeholder="Kolom Keterangan Inventaris" class="form-control" name="keterangan" id="keterangan" cols="30" rows="10">{{ old('keterangan') }}</textarea>
                                @if($errors->has('keterangan'))
                                   <small class="form-text text-danger">*{{ $errors->first('keterangan') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Foto Inventaris</label>
                            <div class="col-sm-6">
                                <input type="file" name="foto" id="foto" class="form-control">
                                @if($errors->has('foto'))
                                   <small class="form-text text-danger">*{{ $errors->first('foto') }}</small>
                                @endif
                            </div>
                        </div>

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
