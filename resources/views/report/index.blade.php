@extends('template.layout')
@section('content')
<main class="mt-5">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script type="text/javascript" src="{{ asset('assets/widgets/datepicker/datepicker.js') }}"></script>
    <script type="text/javascript">
        /* Datepicker bootstrap */
            $(function () {
                "use strict";
                $('#datestart').bsdatepicker({
                    format: 'dd-mm-yyyy'
                });
            });
            $(function () {
                "use strict";
                $('#dateend').bsdatepicker({
                    format: 'dd-mm-yyyy'
                });
            });

    </script>
    @if( Request::get("jenis") == 'databarang' )
    <script type="text/javascript" src="{{ asset('js/report/barang.index.js') }}"></script>
    @elseif( Request::get("jenis") == 'datapengadaan' )
    <script type="text/javascript" src="{{ asset('js/report/pengadaan.index.js') }}"></script>
    @elseif( Request::get("jenis") == 'datainventaris' )
    <script type="text/javascript" src="{{ asset('js/report/inventaris.index.js') }}"></script>
    @elseif( Request::get("jenis") == 'datapeminjaman' )
    <script type="text/javascript" src="{{ asset('js/report/peminjaman.index.js') }}"></script>
    @elseif( Request::get("jenis") == 'datapengguna' )
    <script type="text/javascript" src="{{ asset('js/report/pengguna.index.js') }}"></script>
    @elseif( Request::get("jenis") == 'datarequest' )
    <script type="text/javascript" src="{{ asset('js/report/request.index.js') }}"></script>
    @elseif( Request::get("jenis") == 'datamaintenance' )
    <script type="text/javascript" src="{{ asset('js/report/maintenance.index.js') }}"></script>
    @endif<!-- Bootstrap Datepicker -->
    <script type="text/javascript" src="{{ asset('assets/widgets/datepicker-ui/datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datepicker-ui/datepicker-demo.js') }}">
    </script>


    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-bootstrap.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-tabletools.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-reorder.js') }}"></script>

    <script type="text/javascript">
        /* Datatables export */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('button#cetakLaporan').click(function(e){
              e.preventDefault();
              let dateStart = $('#datestart').val();
              let dateEnd = $('#dateend').val();
              let jenisReport = $('select[name="jenis"]').val();
              let url = '';
              if(jenisReport == 'datapengadaan'){
                url = "{!! route('pengadaan.cetak') !!}";
              }else if(jenisReport == 'datainventaris'){
                url = "{!! route('inventaris.cetak') !!}";
              }else if(jenisReport == 'databarang'){
                url = "{!! route('barang.cetak') !!}";
              }else if(jenisReport == 'datapeminjaman'){
                url = "{!! route('peminjaman.cetak') !!}";
              }else if(jenisReport == 'datarequest'){
                url = "{!! route('request.cetak') !!}";
              }else if(jenisReport == 'datamaintenance'){
                url = "{!! route('maintenance.cetak') !!}";
              }else{
                alert('Pilih Jenis Report terlebih dahulur');
                return false;
              }
              $('input#cetakMulai').val(dateStart);
              $('input#cetakMulai').val(dateEnd);
              $('form#cetakForm').attr('action', url);
              $('form#cetakForm').submit();
              // $.ajax({
              //    type:'POST',
              //    url: url,
              //    data:{mulai: dateStart, akhir: dateEnd},
              //    success:function(data){
              //      console.log('ADA');
              //       alert(data.success);
              //    },
              //    error: function(xhr, textStatus, errorThrown){
              //         console.log('gagal');
              //        alert("Status: " + textStatus); alert("Error: " + xhr.responseText);
              //        alert(xhr.status);
              //     }
              // });
            });
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
        <h2>Halaman Executive Dashboard</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <form class="" action="" method="get">
                <div class="form-group col-sm-12 col-md-8 col-lg-3">
                    <label class="col-sm-12 control-label">Jenis Report</label>
                    <select class="col-lg-11 form-control" name="jenis" style="height:33px">
                        <option name="jenis" value="datapengadaan"
                            {{ Request::get("jenis") == 'datapengadaan' ? 'selected' : ''}}>Data Pengadaan</option>
                        <option name="jenis" value="datainventaris"
                            {{ Request::get("jenis") == 'datainventaris' ? 'selected' : ''}}>Data Inventaris</option>
                        <option name="jenis" value="databarang"
                            {{ Request::get("jenis") == 'databarang' ? 'selected' : ''}}>Data Barang</option>
                        <option name="jenis" value="datapeminjaman"
                            {{ Request::get("jenis") == 'datapeminjaman' ? 'selected' : ''}}>Data Peminjaman</option>
                        <option name="jenis" value="datapengguna"
                            {{ Request::get("jenis") == 'datapengguna' ? 'selected' : ''}}>Data Pengguna</option>
                        <option name="jenis" value="datarequest"
                            {{ Request::get("jenis") == 'datarequest' ? 'selected' : ''}}>Data Request Barang</option>
                        <option value="datamaintenance"
                            {{ Request::get("jenis") == 'datamaintenance' ? 'selected' : ''}}>Data Maintenance</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-8 col-lg-3">
                    <label class="col-sm-12 control-label">Dari Tanggal </label>
                    <div class="col-sm-12">
                        <div class="input-prepend input-group">
                            <span class="add-on input-group-addon" style="width:50px;">
                                <i class="glyph-icon icon-calendar"></i>
                            </span>
                            <input required id="datestart" name="mulai" type="text"
                                class="bootstrap-datepicker form-control" value="{{ Request::get('mulai') }}"
                                data-date-format="mm/dd/yyyy">
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12 col-md-8 col-lg-3">
                    <label class="col-sm-12 control-label">Sampai Tanggal</label>
                    <div class="col-sm-12">
                        <div class="input-prepend input-group">
                            <span class="add-on input-group-addon" style="width:50px;">
                                <i class="glyph-icon icon-calendar"></i>
                            </span>
                            <input required id="dateend" name="akhir" type="text"
                                class="bootstrap-datepicker form-control" value="{{ Request::get('akhir') }}"
                                data-date-format="mm/dd/yyyy">
                        </div>
                    </div>
                </div>

                <div class="container pt-4">
                    <button type="submit" class="btn btn-primary col-sm-12 col-md-6 col-lg-1 mt-1 ml-lg-4" data-toggle="tooltip" data-placement="top" title="Proses Data">
                        <i class="glyph-icon icon-clipboard"></i> Proses
                    </button>
                    <button type="button" id='cetakLaporan' class="btn btn-primary col-sm-12 col-md-6 col-lg-1 mt-1 ml-lg-4" data-toggle="tooltip" data-placement="top" title="Cetak Laporan">
                        <i class="glyph-icon icon-clipboard"></i> Cetak
                    </button>
                </div>
            </form>
            <form id="cetakForm" class="" action="" method="post" target="_blank">
                @CSRF
                @method('POST')
                <input id="cetakMulai" type="hidden" name="mulai" value="">
                <input id="cetakAkhir" type="hidden" name="akhir" value="">
            </form>
        </div>
    </div>

    @yield('contentreport')

</main>
@endsection
