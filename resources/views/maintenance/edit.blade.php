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

    <script src="{{ asset('js/maintenance.js') }}"></script>

    <div id="page-title">
        <h2>Halaman Ubah Data Maintenance</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">

            </h3>
            <div class="example-box-wrapper">
                <div class="example-box-wrapper">
                    <form class="form-horizontal" action="{{ route('maintenance.update', $arr_maintenance[0]->no_register) }}" method="POST"
                        enctype="multipart/form-data">
                        @CSRF
                        @method('POST')
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nomor Register</label>
                            <div class="col-sm-6">
                                <input required name="no_register" type="text" class="form-control" id="" value="{{ $arr_maintenance[0]->no_register }}"
                                    placeholder="Kolom Nomor Register" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Toko</label>
                            <div class="col-sm-6">
                                <input required name="toko" type="text" class="form-control" id="" value="{{ $arr_maintenance[0]->toko }}"
                                    placeholder="Kolom Nama Toko">
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label">Tanggal Maintenance </label>
                          <div class="col-sm-6">
                              <div class="input-prepend input-group">
                                  <span class="add-on input-group-addon">
                                      <i class="glyph-icon icon-calendar"></i>
                                  </span>
                                  <input required id="datestart" name="tanggal_maintenance" type="text"
                                      class="bootstrap-datepicker form-control" value="{{ date('d-m-Y', strtotime($arr_maintenance[0]->tanggal_maintenance)) }}"
                                      data-date-format="mm/dd/yyyy">
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
                          <div class="col-md-3 col-md-offset-9 col-lg-3 col-lg-offset-6 col-sm-12">
                              <label class="col-sm-3 control-label">Total</label>
                              <div class="col-sm-9">
                                  <div class="input-prepend input-group">
                                      <input id="total" name="total" type="text" class="form-control" value="Rp. {{ numbeR_format($arr_maintenance->sum('biaya'), 2, ',', '.') }}" readonly>
                                  </div>
                              </div>
                          </div>
                        </div>

                        @include('maintenance.shared.form')

                    </form>
                </div>
            </div>


        </div>
    </div>


</div>
@endsection
