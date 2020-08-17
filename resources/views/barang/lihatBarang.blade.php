@extends('template.layout')
@section('content')
<div class="container">


    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-bootstrap.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-tabletools.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-reorder.js') }}"></script>

    <!-- Sparklines charts -->

    <script type="text/javascript" src="{{ asset('assets/widgets/charts/sparklines/sparklines.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/charts/sparklines/sparklines-demo.js') }}">
    </script>


    <script type="text/javascript">
        /* Datatables export */

          $(document).ready(function () {
              var table = $('#dt_barang').DataTable();
              var tt = new $.fn.dataTable.TableTools(table);
              $('.dataTables_filter input').attr("placeholder", "Search...");
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
        <h2>Halaman Lihat Data Barang</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">

            </h3>
            <div class="example-box-wrapper">
                <div class="example-box-wrapper">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Barang</label>
                            <div class="col-sm-6">
                                <input disabled name="nama" type="text" class="form-control" id=""
                                    placeholder="Kolom Nama Barang" value="{{$data_barang->b_nama}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Stok Barang</label>
                            <div class="col-sm-6">
                                <input disabled name="stock" type="text" class="form-control" id=""
                                    placeholder="Kolom Stock Barang" value="{{$data_barang->getStok()}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Harga Barang</label>
                            <div class="col-sm-6">
                                <input disabled name="harga" type="number" class="form-control" id=""
                                    placeholder="Kolom Harga Barang" value="{{$data_barang->b_harga}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Satuan</label>
                            <div class="col-sm-6">
                                @if($data_barang->b_satuan == 'Rim')
                                <span class="bs-label label-info">Rim</span>
                                @elseif ($data_barang->b_satuan == 'Pcs')
                                <span class="bs-label label-info">Pcs</span>
                                @else
                                <span class="bs-label label-info">Pack</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Foto Barang</label>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="thumbnail-box thumbnail-box-inverse">
                                        <a href="#" title="Foto Barang" class="thumb-link"></a>
                                        <div class="thumb-content">
                                            <div class="center-vertical">
                                                <div class="center-content">
                                                    <h3 class="thumb-heading animated bounceIn">
                                                        {{$data_barang->b_nama}}
                                                        <small>{{$data_barang->created_at}}</small>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="thumb-overlay bg-black"></div>
                                        <img src="{{ asset('assets/images-resource/barang/resize_'.$data_barang->b_foto) }}"
                                            alt="" >
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="">
                          <h3>Riwayat Stok</h3>
                          <hr>
                          <table id="dt_barang" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Tanggal</th>
                                        <th>No Register</th>
                                        <th>Satuan</th>
                                        <th>Stok Lama</th>
                                        <th>Stok Baru</th>
                                        <th>Total Stok</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($data_barang->pengadaan as $key => $pengadaan)
                                      <tr>
                                          <td>{{$key + 1}}</td>
                                          <td>{{date('d/m/Y', strtotime($pengadaan->tanggal))}}</td>
                                          <td>{{$pengadaan->no_register}}</td>
                                          <td>{{$data_barang->b_satuan}}</td>
                                          <td>{{$data_barang->getStok($pengadaan->created_at) -  $pengadaan->qty }}</td>
                                          <td>{{$pengadaan->qty}}</td>
                                          <td>{{$data_barang->getStok($pengadaan->created_at) }}</td>
                                          <td>{{'Rp. '.number_format($pengadaan->total, 2, ',' ,'.')}}</td>
                                      </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">

                            <div class="col-sm-3">
                                <a href="{{ route('barang.index') }}" class="btn btn-blue-alt"><i
                                        class="glyph-icon icon-arrow-left"></i> Kembali</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>


        </div>
    </div>


</div>

@endsection
