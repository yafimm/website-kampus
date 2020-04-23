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

    <script type="text/javascript">
      $(document).ready(function(){
          var totalDetail = 0;
          $('#tambah-maintenance-detail').click(function(){
              $html ='<div class="panel panel-default">'+
                '<div class="panel-heading"><h5>Data Detail ke - '+ (totalDetail + 1) +'</h5></div>'+
                '<div class="row panel-body" style="margin-bottom:10p" id="row'+ totalDetail++ +'">'+
                '<div class="col-md-4 col-sm-4 col-6 form-controll">'+
                  '<label for="exampleFormControlSelect1">Barang / Inventaris</label>'+
                  '<div class="col-12">'+
                    '<select required name="barang_inventaris[]" type="text" class="form-control" id="" placeholder="Kolom Kode" required>'+
                      @foreach($arr_barang_inventaris as $barang_inventaris)
                        @if(isset($barang_inventaris->b_id))
                          '<option value="BRG{{ $barang_inventaris->b_id }}"> {{ $barang_inventaris->b_nama }}</option>'+
                        @else
                          '<option value="INV{{ $barang_inventaris->i_id }}"> {{ $barang_inventaris->i_nama }}</option>'+
                        @endif
                      @endforeach
                    '</select>'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4 col-sm-4 col-6 form-controll">'+
                  '<label class="col-12 control-label">Jumlah Barang / Inventaris</label>'+
                  '<div class="col-12">'+
                    '<input required name="qty[]" type="number" class="form-control" id="" placeholder="Jumlah Barang" required>'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4 col-sm-4 col-6 form-controll">'+
                  '<label class="col-12 control-label">Biaya</label>'+
                  '<div class="col-12">'+
                    '<input required name="biaya[]" type="number" class="form-control" id="" placeholder="Kolom Biaya" required>'+
                  '</div>'+
                '</div>'+
                '</div>';

                $('#body-form-detail').append($html);

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
        <h2>Halaman Tambah Data Pengadaan</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">

            </h3>
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
                                    placeholder="Kolom Nomor Register">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Supplier/Toko</label>
                            <div class="col-sm-6">
                                <input required name="supplier" type="text" class="form-control" id="" value="{{ Request::get('supplier') }}"
                                    placeholder="Kolom Nama Supplier/Toko">
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
                                      class="bootstrap-datepicker form-control" value="{{ Request::get('tanggal_pengadaan') }}"
                                      data-date-format="mm/dd/yyyy">
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
