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

            <script type="text/javascript">
              $(document).ready(function(){
                  var totalDetail = 0;
                  $('#tambah-maintenance-detail').click(function(){
                      $html = '<h5>Data Detail ke - '+ (totalDetail + 1) +'</h5>'+
                        '<hr>'+
                        '<div class="row margin-bottom-sm" id="row'+ totalDetail++ +'">'+
                        '<div class="col-md-4 col-sm-4 col-6 form-controll">'+
                          '<label class="col-12 control-label">Kode</label>'+
                          '<div class="col-12">'+
                            '<input required name="kode[]" type="text" class="form-control" id="" placeholder="Kolom Kode">'+
                          '</div>'+
                        '</div>'+
                        '<div class="col-md-4 col-sm-4 col-6 form-controll">'+
                          '<label for="exampleFormControlSelect1">Barang</label>'+
                          '<select class="form-control" name="barang_id[]" id="exampleFormControlSelect1">'+
                            @foreach($arr_barang as $barang)
                            '<option value="{{ $barang->b_id }}">{{ $barang->b_nama }}</option>'+
                            @endforeach
                          '</select>'+
                        '</div>'+
                        '<div class="col-md-4 col-sm-4 col-6 form-controll">'+
                          '<label class="col-12 control-label">Posisi</label>'+
                          '<div class="col-12">'+
                            '<input required name="posisi[]" type="text" class="form-control" id="" placeholder="Kolom Posisi">'+
                          '</div>'+
                        '</div>'+
                        '<div class="col-md-4 col-sm-4 col-6 form-controll">'+
                          '<label class="col-12 control-label">Biaya</label>'+
                          '<div class="col-12">'+
                            '<input required name="biaya[]" type="text" class="form-control" id="" placeholder="Kolom Biaya">'+
                          '</div>'+
                        '</div>'+
                        '<div class="col-md-4 col-sm-4 col-6 form-controll">'+
                          '<label class="col-12 control-label">Keterangan</label>'+
                          '<div class="col-12">'+
                            '<input required name="keterangan[]" type="text" class="form-control" id=""placeholder="Kolom Keterangan">'+
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

                                @include('maintenance.shared.form')

                            </form>
                        </div>
                    </div>


                </div>
            </div>


        </div>
    </div>
</div>
@endsection