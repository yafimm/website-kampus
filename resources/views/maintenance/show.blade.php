 @extends('template.layout')
@section('content')
<div class="container">

    <script type="text/javascript" src="{{ asset('assets/widgets/datepicker/datepicker.js') }}"></script>
    <script type="text/javascript">
        /* Datepicker bootstrap */


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
            var table = $('#dt_maintenance').DataTable();
            var tt = new $.fn.dataTable.TableTools(table);


            $('.dataTables_filter input').attr("placeholder", "Search...");

            $('.btn-cetak').click(function(){
              alert($(this).data('no_register'));
              $('#no_register').val($(this).data('no_register'));
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
        <h2>Halaman Data Maintenance #{{$arr_maintenance[0]->no_register }}</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero my-2">
                <a href="{{ route('maintenance.create',['no_register' => $arr_maintenance[0]->no_register, 'tanggal_maintenance' => date('d-m-Y', strtotime($arr_maintenance[0]->tanggal_maintenance))]) }}" class="btn btn-primary">
                    <i class="glyph-icon icon-plus-circle"></i> Tambah
                </a>
                <a href="{{ route('maintenance.edit', $arr_maintenance[0]->no_register) }}" class="btn btn-primary">
                    <i class="glyphicon glyphicon-edit"></i> Ubah
                </a>
                @if(Auth::user()->hasRole('admin'))
                <button class="btn btn-primary btn-md btn-cetak" data-no_register="{{ $arr_maintenance[0]->no_register }}" data-toggle="modal" data-target="#modalReportTahunan">
                    <i class="glyph-icon icon-clipboard"></i> Cetak
                </button>
                @endif

            </h3>

            <h3 class="title-hero">
              <div class="col-12 my-3">
                <h5>No Register : {{ $arr_maintenance[0]->no_register }}</h5>
                <h5>Toko : {{ $arr_maintenance[0]->toko }}</h5>
                <h5>Tanggal Maintenance : {{ date('d-m-Y', strtotime($arr_maintenance[0]->tanggal_maintenance)) }}</h5>
                <h5>Total Keseluruhan : Rp. {{ number_format($arr_maintenance->sum('biaya'), 2,',','.') }}</h5>
              </div>
            </h3>
            <div class="example-box-wrapper">

                <table id="dt_maintenance" class="table table-striped table-bordered" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Posisi</th>
                            <th>Tanggal Maintenance</th>
                            <th>Biaya</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                          @foreach($arr_maintenance as $key => $maintenance)
                            <td>{{ $key + 1 }}</td>
                            <td>@if($maintenance->barang)
                                  {{$maintenance->barang->b_kode}}
                                @elseif($maintenance->inventaris)
                                  {{$maintenance->inventaris->i_kode}}
                                @else
                                  - Data Barang / Inventaris sudah dihapus -
                                @endif</td>
                            <td>@if($maintenance->barang)
                                  {{$maintenance->barang->b_nama}}
                                @elseif($maintenance->inventaris)
                                  {{$maintenance->inventaris->i_nama}}
                                @else
                                  - Data Barang / Inventaris sudah dihapus -
                                @endif
                            </td>
                            <td>{{$maintenance->posisi}}</td>
                            <td>{{date('d-m-Y', strtotime($maintenance->tanggal_maintenance))}}</td>
                            <td>{{$maintenance->biaya != 0 ? 'Rp. '. number_format($maintenance->biaya, 2, ',', '.') : 'Free'}}</td>
                            <td>{{$maintenance->keterangan}}</td>
                            <td>{!! ($maintenance->status == 'SELESAI' ? '<span class="label label-success">'.$maintenance->status.'</span>' : ($maintenance->status == 'SEDANG BERJALAN' ? '<span class="label label-warning">'.$maintenance->status.'</span>': '<span class="label label-danger">'.$maintenance->status.'</span>'))!!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="modalReportTahunan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><strong>Cetak Laporan</strong></h4>
            </div>
            <form name="reportTahunan" id="reportTahunan" action="{{ route('maintenance.cetak') }}"
                method="POST" class="form-horizontal bordered-row">
                {{ csrf_field() }}
                <input type="hidden" id="no_register" name="no_register" value="">
                <div class="modal-body">
                    Apakah anda yakin akan mencetak Data ?
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" formtarget="_blank">Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
