@extends('template.layout')
@section('content')
<div id="page-content-wrapper">
    <div id="page-content">

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
                <h2>Halaman Tambah Data Maintenance</h2>
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
                                    <label class="col-sm-3 control-label">Nomor Register</label>
                                    <div class="col-sm-6">
                                        <input required name="nama" type="text" class="form-control" id=""
                                            placeholder="Kolom Nomor Register">
                                    </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-3 control-label">Dari Tanggal </label>
                                  <div class="col-sm-6">
                                      <div class="input-prepend input-group">
                                          <span class="add-on input-group-addon">
                                              <i class="glyph-icon icon-calendar"></i>
                                          </span>
                                          <input required id="datestart" name="mulai" type="text"
                                              class="bootstrap-datepicker form-control" value="{{ Request::get('mulai') }}"
                                              data-date-format="mm/dd/yyyy">
                                      </div>
                                  </div>
                                </div>

                                <div class="form-group my-2">
                                  <h5>Data Detail Maintenance</h5>
                                  <hr>
                                  <div class="body-form" id="body-form-detail">

                                  <div class="row">
                                    <div class="col-md-4 col-sm-4 col-6">
                                      <label class="col-12 control-label">Kode</label>
                                      <div class="col-12">
                                        <input required name="nama" type="text" class="form-control" id=""
                                        placeholder="Kolom Nomor Register">
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-6">
                                      <label class="col-12 control-label">Nama Barang</label>
                                      <div class="col-12">
                                        <input required name="nama" type="text" class="form-control" id=""
                                        placeholder="Kolom Nama Barang">
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-6">
                                      <label class="col-12 control-label">Posisi</label>
                                      <div class="col-12">
                                        <input required name="nama" type="text" class="form-control" id=""
                                        placeholder="Kolom Posisi">
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-6">
                                      <label class="col-12 control-label">Tanggal Maintenance</label>
                                      <div class="col-12">
                                        <div class="input-prepend input-group">
                                          <span class="add-on input-group-addon">
                                            <i class="glyph-icon icon-calendar"></i>
                                          </span>
                                          <input required id="datestart" name="mulai" type="text"
                                          class="bootstrap-datepicker form-control" value="{{ Request::get('mulai') }}"
                                          data-date-format="mm/dd/yyyy">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-6">
                                      <label class="col-12 control-label">Biaya</label>
                                      <div class="col-12">
                                        <input required name="nama" type="text" class="form-control" id=""
                                        placeholder="Kolom Biaya">
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-6">
                                      <label class="col-12 control-label">Keterangan</label>
                                      <div class="col-12">
                                        <input required name="nama" type="text" class="form-control" id=""
                                        placeholder="Kolom Keterangan">
                                      </div>
                                    </div>
                                    </div>

                                  </div>


                                  </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-3 col-sm-offset-3">
                                      <button type="button" class="btn btn-primary" name="button"><i class="glyphicon glyphicon-plus"></i> Tambah Data Detail</button>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-success">
                                                <i class="glyph-icon icon-check"></i>Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>


                </div>
            </div>


        </div>
    </div>
</div>
@endsection
