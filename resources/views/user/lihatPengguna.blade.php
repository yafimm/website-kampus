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
        <h2>Halaman Lihat Data Pengguna</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">

            </h3>
            <div class="example-box-wrapper">
                <div class="example-box-wrapper">
                    <form class="form-horizontal">

                        @if ($data_pengguna[0]->role == 'mahasiswa')
                            <div class="form-group">
                                <label class="col-sm-3 control-label">NPM</label>
                                <div class="col-sm-6">
                                    <input disabled name="npm" type="text" class="form-control" id="npm"
                                        placeholder="Kolom NPM" value="{{$data_pengguna[0]->npm}}">
                                </div>
                            </div>
                        @elseif ($data_pengguna[0]->role == 'ormawa')
                        @elseif ($data_pengguna[0]->role == 'bagumum')
                        @endif

                        @if ($data_pengguna[0]->role == 'mahasiswa')
                        @elseif ($data_pengguna[0]->role == 'ormawa')
                        @elseif ($data_pengguna[0]->role == 'bagumum')
                            <div class="form-group">
                                <label class="col-sm-3 control-label">NIP</label>
                                <div class="col-sm-6">
                                    <input disabled name="nip" type="text" class="form-control" id="nip"
                                        placeholder="Kolom NIP" value="{{$data_pengguna[0]->nip}}">
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Role</label>
                            <div class="col-sm-6">
                                <span class="bs-label label-primary">{{$data_pengguna[0]->role}}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Pengguna</label>
                            <div class="col-sm-6">
                                <input disabled name="nama" type="text" class="form-control" id="nama"
                                    placeholder="Kolom Nama Pengguna" value="{{$data_pengguna[0]->name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email Pengguna</label>
                            <div class="col-sm-6">
                                <input disabled name="email" type="email" class="form-control" id="email"
                                    placeholder="Kolom Email Pengguna" value="{{$data_pengguna[0]->email}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-3">
                                <a href="{{ route('user.index') }}" class="btn btn-blue-alt"><i
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
