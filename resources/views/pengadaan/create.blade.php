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
        <h2>Halaman Tambah Data Pengadaan</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <div class="example-box-wrapper">
                <div class="example-box-wrapper">
                    <form class="form-horizontal" action="{{ route('pengadaan.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @CSRF
                        @method('POST')
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nomor Register</label>
                            <div class="col-sm-6">
                                <input required name="no_register" type="text" class="form-control" id="" value="{{ Request::get('no_register') ? Request::get('no_register') : YaffSetPengadaanNoRegister()}}"
                                    placeholder="Kolom Nomor Register" readonly>
                                @if($errors->has('no_register'))
                                   <small class="form-text text-danger">*{{ $errors->first('no_register') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Supplier/Toko</label>
                            <div class="col-sm-6">
                                <input required name="supplier" type="text" class="form-control" id="" value="{{ Request::get('supplier') }}"
                                    placeholder="Kolom Nama Supplier/Toko">
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
                                      class="bootstrap-datepicker form-control" value="{{ Request::get('tanggal_pengadaan') ? Request::get('tanggal_pengadaan') : date('d-m-Y')  }}"
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
                          <div class="col-md-6 col-lg-3 col-sm-12">
                              <div class="col-sm-12">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon">
                                        <i class="glyph-icon icon-search"></i>
                                    </span>
                                    <select id="cari" class="cari form-control" style="width:500px;" name="cari"></select>
                                </div>
                              </div>
                          </div>

                          <div class="col-md-3 col-offset-md-3 col-lg-3 col-lg-offset-6 col-sm-12">
                              <label class="col-sm-3 control-label">Netto</label>
                              <div class="col-sm-9">
                                  <div class="input-prepend input-group">
                                      <input id="netto" name="netto" type="text" class="form-control" value="Rp. 0,00" readonly>
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
