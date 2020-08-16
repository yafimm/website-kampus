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
        function hapusItem(index)
        {
            $('#tbl_barang tr#pengadaan-detail-'+index).remove();
            showAlert('success', 'Berhasil hapus data barang pada detail pengadaan');
        }

        function setNetto()
        {
            console.log('ada');
            let netto = 0;
            $('input[name="totalHarga[]"]').each(function() {
               netto += parseInt($(this).val());
            });
            $('#netto').val(convertNumberToRupiah(netto));
        }

        function setTotalHarga(index, value, qty)
        {
            let totalHarga = value * qty;
            $('#totalHarga-'+index).val(totalHarga);
            $('#totalHargaSpan-'+index).html(convertNumberToRupiah(totalHarga));
            setNetto();
        }

        function setQty(index, value)
        {
            value = value.replace(/[^0-9]/g, '');
            let harga = $('#harga-'+index).val();
            $('#qty-'+index).val(value);
            setTotalHarga(index, harga, value);
        }

        function setHarga(index, value)
        {
            value = value.replace(/[^0-9]/g, '');
            let qty = $('#qty-'+index).val();
            $('#harga-'+index).val(value);
            setTotalHarga(index, value, qty);
        }
    </script>

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
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nomor Register</label>
                            <div class="col-sm-6">
                                <input required name="no_register" type="text" class="form-control" id="" value="{{ $arr_pengadaan[0]->no_register }}"
                                    placeholder="Kolom Nomor Register" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Supplier/Toko</label>
                            <div class="col-sm-6">
                                <input required name="supplier" type="text" class="form-control" id="" value="{{ $arr_pengadaan[0]->supplier }}"
                                    placeholder="Kolom Nomor Register">
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
                              </div>
                          </div>
                        </div>
                        <hr>
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
