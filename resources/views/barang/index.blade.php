@extends('template.layout')
@section('content')
<div class="container">

    <script type="text/javascript" src="{{ asset('assets/widgets/datepicker/datepicker.js') }}"></script>
    <script type="text/javascript">
        /* Datepicker bootstrap */

          $(function () {
              "use strict";
              $('#dari-tanggal').bsdatepicker({
                  format: 'dd-mm-yyyy'
              });
          });

          $(function () {
              "use strict";
              $('#sampai-tanggal').bsdatepicker({
                  format: 'dd-mm-yyyy'
              });
          });


    </script>
    <!-- Bootstrap Datepicker -->
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

          $(document).ready(function () {
              var table = $('#dt_barang').DataTable();
              var tt = new $.fn.dataTable.TableTools(table);
              $('.dataTables_filter input').attr("placeholder", "Search...");

              // function sum total harga
              let startPage = table.page.info().start;
              let endPage = table.page.info().end;
              let totalHarga = 0;
              // console.log(table.page.info().start);
              for (let i = startPage; i < endPage; i++) {
                  row = table.rows(i).data();
                  // Karena kolom 5 menyesuaikan dengan kolom didatatable, untuk 0 adalah data dari dalam datatable
                  totalHarga += convertRupiahToNumber(row[0][5]);
              }
              $('#totalPage').html(table.page.info().recordsDisplay);
              $('#totalHarga').html(convertNumberToRupiah(totalHarga));

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
        <h2>Halaman Data Barang</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>


    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">
                <a href="{{ route('barang.tambah') }}" class="btn btn-primary">
                    <i class="glyph-icon icon-plus-circle"></i> Tambah
                </a>
                @if(Auth::user()->hasRole('admin'))
                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#modalReportTahunan">
                    <i class="glyph-icon icon-clipboard"></i> Cetak Laporan
                </button>
                @endif
            </h3>
            <div class="example-box-wrapper" style="overflow: auto">
                  <table id="dt_barang" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Stock</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr class="table-info">
                              <th colspan="5" class="text-center">Total <br><small class="text-info text-sm">*Untuk <span id="totalPage"></span> Data</small></th>
                              <th colspan="2" class="text-center" id="totalHarga"></th>
                            </tr>
                            <tr class="table-primary">
                              <th colspan="5" class="text-center">Total Keseluruhan <br><small class="text-info text-sm">*Total Seluruh data.</small></th>
                              <th colspan="2" class="text-center">
                                  Rp. {{ number_format($data_barang->sum('b_harga'), 2, ',', '.') }}
                              </th>
                            </tr>
                        </tfoot>

                        <tbody>
                            @foreach ($data_barang as $key => $barang)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$barang->b_kode}}</td>
                                <td>{{$barang->b_nama}}</td>
                                <td>{{$barang->b_stock}}</td>
                                <td>{{$barang->b_satuan}}</td>
                                <td>{{'Rp. '.number_format($barang->b_harga, 2, ',' ,'.')}}</td>
                                <td>
                                    <a href="{{ route('barang.lihat', $barang->b_id) }}" class="btn btn-info btn-sm"
                                        data-toggle="tooltip" data-placement="top" title="Lihat Data">
                                        <i class="glyph-icon icon-eye"></i>
                                    </a>
                                    <a href="{{ route('barang.ubah', $barang->b_id) }}" class="btn btn-warning btn-sm"
                                        data-toggle="tooltip" data-placement="top" title="Ubah Data">
                                        <i class="glyph-icon icon-pencil"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus"
                                        data-barangid="{{$barang->b_id}}" data-toggle="tooltip" data-placement="top"
                                        title="Hapus Data">
                                        <i class="glyph-icon icon-trash"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#modalRestock" data-barangid="{{$barang->b_id}}"
                                        data-toggle="tooltip" data-placement="top" title="Tambah Stok">
                                        <i class="glyph-icon icon-plus"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>

    <!-- Kumpulan Modal -->
    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#e74c3c;color:#fff">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Hapus Data</h4>
                </div>
                <form name="deleteForm" id="deleteForm" action="{{ route('barang.prosesHapus') }}" method="POST"
                    class="form-horizontal">
                    @CSRF
                    @method('DELETE')
                    <input type="hidden" name="id" id="id">
                    <div class="modal-body">
                        <p>Yakin ingin menghapus Data ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#modalHapus').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget);
              var id = button.data('barangid');
              var modal = $(this);
              modal.find('#id').val(id);
          });

    </script>

    <div class="modal fade" id="modalReportTahunan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>Cetak Laporan</strong></h4>
                </div>
                <form name="reportTahunan" id="reportTahunan" action="{{ route('barang.cetak') }}" method="POST"
                    class="form-horizontal bordered-row">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Dari Tanggal</label>
                            <div class="col-sm-6">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon">
                                        <i class="glyph-icon icon-calendar"></i>
                                    </span>
                                    <input id="dari-tanggal" name="mulai" type="text"
                                        class="bootstrap-datepicker form-control" value=""
                                        data-date-format="dd-mm-yyyy">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Sampai Tanggal</label>
                            <div class="col-sm-6">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon">
                                        <i class="glyph-icon icon-calendar"></i>
                                    </span>
                                    <input id="sampai-tanggal" name="akhir" type="text"
                                        class="bootstrap-datepicker form-control" value=""
                                        data-date-format="dd-mm-yyyy">
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" formtarget="_blank">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRestock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#357ef2;color:#fff">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Tambah Stock Barang</h4>
                </div>
                <form name="restockForm" id="restockForm" action="{{ route('barang.restock') }}" method="POST"
                    class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id">
                    <div class="modal-body">
                        <p>Masukkan penambahan stock</p>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tambah Stock</label>
                            <div class="col-sm-6">
                                <input required name="stock" type="number" class="form-control" id="stock"
                                    placeholder="Kolom Stock Barang">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#modalRestock').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget);
              var id = button.data('barangid');
              var modal = $(this);
              modal.find('#id').val(id);
          });
    </script>

      <script type="text/javascript">

      </script>


</div>

@endsection
