@extends('admin.app')
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

            <script type="text/javascript">
                /* Datatables export */

                $(document).ready(function () {
                    var table = $('#dt_barang').DataTable();
                    var tt = new $.fn.dataTable.TableTools(table);


                    $('.dataTables_filter input').attr("placeholder", "Search...");

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
                <h2>Halaman Tambah Data Barang</h2>
                <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <h3 class="title-hero">

                    </h3>
                    <div class="example-box-wrapper">
                        <div class="example-box-wrapper">
                            <form class="form-horizontal" action="{{ url('/admin/barang/prosesTambah') }}" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nama Barang</label>
                                    <div class="col-sm-6">
                                        <input required name="nama" type="text" class="form-control" id=""
                                            placeholder="Kolom Nama Barang">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Stock Barang</label>
                                    <div class="col-sm-6">
                                        <input required name="stock" type="number" class="form-control" id=""
                                            placeholder="Kolom Stock Barang">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Satuan</label>
                                    <div class="col-sm-6">
                                        <select name="satuan" id="satuan" class="form-control">
                                            <option value="Rim">Rim</option>
                                            <option value="Pcs">Pcs</option>
                                            <option value="Pack">Pack</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Harga Barang</label>
                                    <div class="col-sm-6">
                                        <input required name="harga" type="number" class="form-control" id=""
                                            placeholder="Kolom Harga Barang">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Foto Barang</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="foto" id="foto" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-3">
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-success">
                                                <i class="glyph-icon icon-check"></i> Tambahkan</button>
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
