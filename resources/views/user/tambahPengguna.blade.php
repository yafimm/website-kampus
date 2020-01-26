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
        <h2>Halaman Tambah Data Pengguna</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">

            </h3>
            <div class="example-box-wrapper">
                <div class="example-box-wrapper">
                    <form class="form-horizontal" action="{{ route('user.prosesTambah') }}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($jenis == 'mahasiswa')
                            <input type="hidden" name="role" value="mahasiswa">
                        @elseif ($jenis == 'ormawa')
                            <input type="hidden" name="role" value="ormawa">
                        @elseif ($jenis == 'bagumum')
                            <input type="hidden" name="role" value="bagumum">
                        @elseif ($jenis == 'yayasan')
                            <input type="hidden" name="role" value="yayasan">
                        @endif

                        @if ($jenis == 'mahasiswa')
                            <div class="form-group">
                                <label class="col-sm-3 control-label">NPM</label>
                                <div class="col-sm-6">
                                    <input required name="npm" type="text" class="form-control" id="npm"
                                        placeholder="Kolom NPM">
                                </div>
                            </div>
                        @elseif ($jenis == 'ormawa')
                            <input type="hidden" name="npm" value="0">
                        @elseif ($jenis == 'bagumum')
                            <input type="hidden" name="npm" value="0">
                        @elseif ($jenis == 'yayasan')
                            <input type="hidden" name="npm" value="0">
                        @endif

                        @if ($jenis == 'mahasiswa')
                            <input type="hidden" name="nip" value="0">
                        @elseif ($jenis == 'ormawa')
                            <input type="hidden" name="nip" value="0">
                        @elseif ($jenis == 'yayasan')
                            <input type="hidden" name="nip" value="0">
                        @elseif ($jenis == 'bagumum')
                            <div class="form-group">
                                <label class="col-sm-3 control-label">NIP</label>
                                <div class="col-sm-6">
                                    <input required name="nip" type="text" class="form-control" id="nip"
                                        placeholder="Kolom NIP">
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Pengguna</label>
                            <div class="col-sm-6">
                                <input required name="nama" type="text" class="form-control" id="nama"
                                    placeholder="Kolom Nama Pengguna">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email Pengguna</label>
                            <div class="col-sm-6">
                                <input required name="email" type="email" class="form-control" id="email"
                                    placeholder="Kolom Email Pengguna">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Kata Sandi Pengguna</label>
                            <div class="col-sm-6">
                                <input required name="password" type="password" class="form-control" id="password"
                                    placeholder="Kolom Kata Sandi Pengguna">
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
