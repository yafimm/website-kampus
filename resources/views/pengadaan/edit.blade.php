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

    <script type="text/javascript" src="{{ asset('assets/widgets/datepicker/datepicker.js') }}"></script>
    <script type="text/javascript">
        /* Datepicker bootstrap */
            $(function () {
                "use strict";
                $('#datestart').bsdatepicker({
                    format: 'dd-mm-yyyy'
                });
            });

    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
      var urlCari = '{{ route("pengadaan.cari") }}';
      var urlGetBarang = '{{ route("pengadaan.getBarang")}}';
    </script>
    <script type="text/javascript" src="{{ asset('js/pengadaan.js') }}"></script>

    <div id="page-title">
        <h2>Halaman Ubah Data Pengadaan</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">

            </h3>
            <div class="example-box-wrapper">
                <div class="example-box-wrapper">
                    <form class="form-horizontal" action="{{ route('pengadaan.update', $arr_pengadaan[0]->no_register) }}" method="POST"
                        enctype="multipart/form-data">
                        @CSRF
                        @method('POST')
                        <input type="hidden" name="id" value="{{ $arr_pengadaan[0]->id }}">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nomor Register</label>
                            <div class="col-sm-6">
                                <input required name="no_register" type="text" class="form-control" id="" value="{{ $arr_pengadaan[0]->no_register }}"
                                    placeholder="Kolom Nomor Register" readonly>
                                @if($errors->has('no_register'))
                                   <small class="form-text text-danger">*{{ $errors->first('no_register') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Supplier/Toko</label>
                            <div class="col-sm-6">
                                <input required name="supplier" type="text" class="form-control" id="" value="{{ $arr_pengadaan[0]->supplier }}"
                                    placeholder="Kolom Nomor Register">
                                @if($errors->has('supplier'))
                                   <small class="form-text text-danger">*{{ $errors->first('supplier') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label">Tanggal Pengadaan </label>
                          <div class="col-sm-6">
                              <div class="input-prepend input-group">
                                  <span class="add-on input-group-addon">
                                      <i class="glyph-icon icon-calendar"></i>
                                  </span>
                                  <input required id="datestart" name="tanggal" type="text"
                                      class="bootstrap-datepicker form-control" value="{{ date('d-m-Y', strtotime($arr_pengadaan[0]->tanggal)) }}"
                                      data-date-format="mm/dd/yyyy">
                                  @if($errors->has('tanggal'))
                                     <small class="form-text text-danger">*{{ $errors->first('tanggal') }}</small>
                                  @endif
                              </div>
                          </div>
                        </div>
                        <hr>
                        <div id="alertDiv">
                          @if($errors->has('barang_inventaris'))
                             <small class="form-text text-danger">*{{ $errors->first('barang_inventaris') }}</small>
                          @endif
                        </div>
                        <div class="form-group">

                          <div class="col-md-3 col-offset-md-9 col-md-offset-6 col-lg-3 col-lg-offset-6 col-sm-12">
                              <label class="col-sm-3 control-label">Netto</label>
                              <div class="col-sm-9">
                                  <div class="input-prepend input-group">
                                      <input id="netto" name="netto" type="text" class="form-control" value="Rp. {{ numbeR_format($arr_pengadaan->sum('total'), 2, ',', '.') }}" readonly>
                                  </div>
                              </div>
                          </div>
                        </div>

                        @include('pengadaan.shared.form')

                    </form>
                </div>
            </div>


        </div>
    </div>


</div>
@endsection
