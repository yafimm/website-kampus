@extends('user.app')
@section('content')
<div id="page-content-wrapper">
    <div id="page-content">

        <div class="container">


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
                <h2>Dashboard</h2>
                <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <h3 class="title-hero">
                        <p>Data Peminjaman</p>

                    </h3>
                    <div class="example-box-wrapper">
                        <table id="dt_peminjaman" class="table table-striped table-bordered" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama User</th>
                                    <th>Tanggal Peminjaman Mulai</th>
                                    <th>Tanggal Peminjaman Berakhir</th>
                                    <th>File Surat Peminjaman</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Nama User</th>
                                    <th>Tanggal Peminjaman Mulai</th>
                                    <th>Tanggal Peminjaman Berakhir</th>
                                    <th>File Surat Peminjaman</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>

                            <tbody>
                                @php
                                $count = 0;
                                @endphp
                                @foreach ($data_peminjaman as $peminjaman)
                                @php
                                $count = $count + 1;
                                @endphp
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{$peminjaman->name}}</td>
                                    <td>{{$peminjaman->p_date}}</td>
                                    <td>{{$peminjaman->p_date_end}}</td>
                                    <td><a target="_blank"
                                            href="{{ asset('suratpeminjaman/'.$peminjaman->p_scan_surat_peminjaman) }}">Download</a>
                                    </td>
                                    <td>
                                        @if ($peminjaman->p_status == 0)
                                        <span class="bs-label label-primary">Menunggu</span>
                                        @elseif($peminjaman->p_status == 1)
                                        <span class="bs-label label-success">Diterima</span>
                                        @else
                                        <span class="bs-label label-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/user/peminjaman/lihat/'.$peminjaman->p_id) }}"
                                            class="btn btn-info">
                                            <i class="glyph-icon icon-circle-o"></i> Lihat
                                        </a>
                                        @if ($peminjaman->p_status == 0)
                                        <a href="{{ url('/user/peminjaman/ubah/'.$peminjaman->p_id) }}"
                                            class="btn btn-info">
                                            <i class="glyph-icon icon-edit"></i> Edit
                                        </a>
                                        @endif
                                        <button class="btn btn-danger btn-md" data-toggle="modal"
                                            data-target="#modalHapusPeminjaman"
                                            data-peminjamanid="{{$peminjaman->p_id}}">
                                            <i class="glyph-icon icon-trash"></i> Hapus
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
            <div class="modal fade" id="modalHapusPeminjaman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#e74c3c;color:#fff">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Hapus peminjaman</h4>
                        </div>
                        <form name="deleteForm" id="deleteForm" action="{{ url('/user/peminjaman/konfirmasi') }}"
                            method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <input type="hidden" name="idhapus" id="idhapus">
                            <div class="modal-body">
                                <p>Yakin ingin menghapus data peminjaman ?</p>
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
                $('#modalHapusPeminjaman').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('peminjamanid');
                    var modal = $(this);
                    modal.find('#idhapus').val(id);
                });

            </script>
            
        </div>
    </div>
</div>
@endsection