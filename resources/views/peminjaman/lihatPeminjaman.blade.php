@extends('template.layout')
@section('content')
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
            var table = $('#dt_detail_peminjaman').DataTable();
            var tt = new $.fn.dataTable.TableTools(table);

            $('.dataTables_filter input').attr("placeholder", "Search...");

        });

    </script>
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
        <h2>Halaman Lihat Data Pengguna</h2>
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
                            <label class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-6">
                                @if ($data_peminjaman[0]->p_status == 0)
                                <span class="bs-label label-primary">Menunggu</span>
                                @elseif ($data_peminjaman[0]->p_status == 2)
                                <span class="bs-label label-warning">Ditolak</span>
                                @else
                                <span class="bs-label label-success">Disetujui</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Peminjam</label>
                            <div class="col-sm-6">
                                <input disabled name="nama" type="text" class="form-control" id="nama"
                                    placeholder="Kolom Nama Pengguna" value="{{$data_peminjaman[0]->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Periode Peminjaman</label>
                            <div class="col-sm-6">
                                <span class="bs-label label-primary">{{$data_peminjaman[0]->p_date}}</span> |
                                <span class="bs-label label-primary">{{$data_peminjaman[0]->p_date_end}}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">File Dokumen Peminjaman</label>
                            <div class="col-sm-6">
                                <span class="bs-label label-default"><a target="_blank"
                                        href="{{ route('downloadsurat', $data_peminjaman[0]->p_scan_surat_peminjaman) }}">Download</a>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Detail Inventaris Peminjaman</label>
                            <div class="col-sm-6">
                            </div>
                        </div>

                        <table id="dt_detail_peminjaman" class="table table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                </tr>
                            </tfoot>

                            <tbody>
                                @php
                                $count = 0;
                                @endphp
                                @foreach ($data_peminjaman[0]->detail_peminjaman as $detail_peminjaman)
                                @php
                                $count = $count + 1;
                                @endphp
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{$detail_peminjaman->i_nama}}</td>
                                    <td>{{$detail_peminjaman->dp_jumlah}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="form-group">
                            <div class="col-sm-3">
                                <a href="{{ route('peminjaman.index') }}" class="btn btn-blue-alt"><i
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
