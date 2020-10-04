@extends('template.layout')
@section('content')
<div class="container">


    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-bootstrap.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-tabletools.js') }}">
    </script>
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
        <h2>Halaman Ubah Data Barang</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">

            </h3>
            <div class="example-box-wrapper">
                <div class="example-box-wrapper">
                    <form class="form-horizontal" action="{{ route('barang.prosesUbah', $data_barang->b_id) }}" method="POST"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="{{$data_barang->b_id}}">
                        @CSRF
                        @method('PUT')
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Barang</label>
                            <div class="col-sm-6">
                                <input required name="nama" type="text" class="form-control" id=""
                                    placeholder="Kolom Nama Barang" value="{{old('nama',$data_barang->b_nama)}}">
                                @if($errors->has('nama'))
                                   <small class="form-text text-danger">*{{ $errors->first('kode') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jenis Barang</label>
                            <div class="col-sm-6">
                                <select name="jenis" id="jenis" class="form-control">
                                    <option value="ATK" {{ $data_barang->jenis == 'ATK' ? 'selected' : '' }}>ATK</option>
                                    <option value="ART" {{ $data_barang->jenis == 'ART' ? 'selected' : '' }}>ART</option>
                                </select>
                                @if($errors->has('jenis'))
                                   <small class="form-text text-danger">*{{ $errors->first('jenis') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Stock Barang</label>
                            <div class="col-sm-6">
                                <input required name="stock" type="text" class="form-control" id=""
                                    placeholder="Kolom Stock Barang" value="{{old('stock', $data_barang->getStok())}}" readonly>
                                @if($errors->has('stock'))
                                   <small class="form-text text-danger">*{{ $errors->first('stock') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Harga Barang</label>
                            <div class="col-sm-6">
                                <input required name="harga" type="number" class="form-control" id=""
                                    placeholder="Kolom Harga Barang" value="{{old('harga',$data_barang->b_harga)}}">
                                @if($errors->has('harga'))
                                   <small class="form-text text-danger">*{{ $errors->first('harga') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Satuan</label>
                            <div class="col-sm-6">
                                <select name="satuan" id="satuan" class="form-control">
                                    @if($data_barang->b_satuan == 'Rim')
                                        <option selected value="Rim">Rim</option>
                                        <option value="Pcs">Pcs</option>
                                        <option value="Pack">Pack</option>
                                    @elseif ($data_barang->b_satuan == 'Pcs')
                                        <option value="Rim">Rim</option>
                                        <option selected value="Pcs">Pcs</option>
                                        <option value="Pack">Pack</option>
                                    @else
                                        <option value="Rim">Rim</option>
                                        <option value="Pcs">Pcs</option>
                                        <option selected value="Pack">Pack</option>
                                    @endif
                                </select>
                                @if($errors->has('satuan'))
                                   <small class="form-text text-danger">*{{ $errors->first('satuan') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Foto Barang</label>
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
                                    <i class="glyph-icon icon-file"></i> Simpan</button>
                                <a href="{{ route('barang.index') }}" class="btn btn-blue-alt"><i class="glyph-icon icon-arrow-left"></i> Kembali</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>


        </div>
    </div>


</div>
@endsection
