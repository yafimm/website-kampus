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
      var nomorPengadaanBarang = 0;

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

      $(document).ready(function(){

        let arrPengadaanDetail = [];
        $('.cari').select2({
          placeholder: 'Cari berdasarkan kode ..',
          ajax: {
            url: urlCari,
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
              return {
                results:  $.map(data, function (item) {
                  return {
                    text: item.b_kode+" - "+item.b_nama,
                    id: item.b_kode,
                  }
                })
              };
            },
            cache: true
          }
        });

        $('#cari').change(function(){

            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: urlGetBarang,
                dataType: 'json',
                data: {kode: $(this).val(), no_register: $('input[name="no_register"').val()},
                success: function (data) {
                  if(data.status == false){
                    $('#cari').empty();
                    showAlert('danger', data.message);
                  }else{
                    let kode = data.b_kode ? data.b_kode : data.i_kode;
                    let nama = data.b_nama ? data.b_nama : data.i_nama;
                    let id = data.b_id ? "BRG"+data.b_id : "INV"+data.i_id;

                    //Kalo data sudah ada di detail, keluar alert
                    if(arrPengadaanDetail.includes(kode)){
                      showAlert('danger', 'Gagal menambahkan data, karena data '+ kode +' - '+ nama + ' Sudah dimasukkan !');
                      $('#cari').empty();
                    }else{
                      let html = '';
                      html += '<tr id="pengadaan-detail-'+nomorPengadaanBarang+'">'+
                                '<td>'+ (nomorPengadaanBarang + 1) +' <input type="hidden" name="barang_inventaris[]" value="'+id+'"> </td>'+
                                '<td>'+kode+'</td>'+
                                '<td>'+nama+'</td>'+
                                '<td><input id="qty-'+nomorPengadaanBarang+'" class="form-control" type="text" name="qty[]" onkeyup="setQty('+nomorPengadaanBarang+', value)" value="0"></td>'+
                                '<td><input id="harga-'+nomorPengadaanBarang+'" class="form-control" type="text" name="harga[]" onkeyup="setHarga('+nomorPengadaanBarang+', value)" value="0"></td>'+
                                '<td><span id="totalHargaSpan-'+nomorPengadaanBarang+'">Rp. 0,00</span><input type="hidden" id="totalHarga-'+nomorPengadaanBarang+'" class="form-control" type="text" name="totalHarga[]" value="0" readonly></td>'+
                                '<td><button type="button" class="btn btn-danger btn-sm" onclick="hapusItem('+nomorPengadaanBarang+')" data-id="'+nomorPengadaanBarang+'" data-toggle="tooltip" data-placement="top"><i class="glyph-icon icon-trash"></i></button></td>'+
                              '</tr>';

                     $('#tbl_barang tbody').append(html);
                     $('#cari').empty();
                     showAlert('success', 'Berhasil menambahkan data '+ kode +' - '+nama);
                     arrPengadaanDetail.push(kode);
                     nomorPengadaanBarang++;
                  }

                }


              },error:function(data){
                     console.log(data);
                }
            });
        });

      });

    </script>

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
                                      class="bootstrap-datepicker form-control" value="{{ Request::get('tanggal_pengadaan') ? Request::get('tanggal_pengadaan') : date('d-m-Y')  }}"
                                      data-date-format="mm/dd/yyyy">
                              </div>
                          </div>
                        </div>

                        <hr>
                        <div id="alertDiv">
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
