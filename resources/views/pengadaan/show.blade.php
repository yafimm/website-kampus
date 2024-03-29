@extends('template.layout')
@section('content')
<div class="container">

    <script type="text/javascript" src="{{ asset('assets/widgets/datepicker/datepicker.js') }}"></script>
    <script type="text/javascript">
        /* Datepicker bootstrap */

        $(function () {
            "use strict";
            $('#tahunan').bsdatepicker({
                autoclose: true,
                format: " yyyy",
                viewMode: "years",
                minViewMode: "years",
                startDate: '2019',
                endDate: new Date(),
            });
        });

        $(function () {
            "use strict";
            $('#bulanan').bsdatepicker({
                autoclose: true,
                format: " mm-yyyy",
                viewMode: "months",
                minViewMode: "months",
                startDate: '2019',
                endDate: new Date(),
            });
        });

        $(function () {
            "use strict";
            $('#harian').bsdatepicker({
                format: 'mm-dd-yyyy'
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
            var table = $('#dt_pengadaan').DataTable();
            var tt = new $.fn.dataTable.TableTools(table);


            $('.dataTables_filter input').attr("placeholder", "Search...");

        });

    </script>

    <div id="page-title">
        <h2>Halaman Data pengadaan #{{$arr_pengadaan[0]->no_register }}</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero my-2">
                <a href="{{ route('pengadaan.create',['no_register' => $arr_pengadaan[0]->no_register, 'tanggal_pengadaan' => date('d-m-Y', strtotime($arr_pengadaan[0]->tanggal)), 'supplier' => $arr_pengadaan[0]->supplier]) }}" class="btn btn-primary">
                    <i class="glyph-icon icon-plus-circle"></i> Tambah
                </a>
                <a href="{{ route('pengadaan.edit', $arr_pengadaan[0]->no_register) }}" class="btn btn-primary">
                    <i class="glyphicon glyphicon-edit"></i> Ubah
                </a>
                @if(Auth::user()->hasRole('admin'))
                  <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#modalReportTahunan">
                      <i class="glyph-icon icon-clipboard"></i> Cetak
                  </button>
                @endif
            </h3>

            <h3 class="title-hero">
              <div class="col-12 my-3">
                <h5>No Register : {{ $arr_pengadaan[0]->no_register }}</h5>
                <h5>Nama Supplier/Toko : {{ $arr_pengadaan[0]->supplier }}</h5>
                <h5>Tanggal : {{ date('d-m-Y', strtotime($arr_pengadaan[0]->tanggal)) }}</h5>
                <h5>Total Keseluruhan : Rp. {{ number_format($arr_pengadaan->sum(function ($item) {return $item->biaya * $item->qty; } ), 2,',','.') }}</h5>
              </div>
            </h3>
            <div class="example-box-wrapper">

                <table id="dt_pengadaan" class="table table-striped table-bordered" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Kode</th>
                            <th>Nama Barang / Inventaris</th>
                            <th>Qty</th>
                            <th>Biaya</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                          @foreach($arr_pengadaan as $key => $pengadaan)
                            <td>{{ $key + 1 }}</td>
                            <td>@if($pengadaan->barang)
                                  {{$pengadaan->barang->b_kode}}
                                @elseif($pengadaan->inventaris)
                                  {{$pengadaan->inventaris->i_kode}}
                                @else
                                  - Data Barang / Inventaris sudah dihapus -
                                @endif
                            </td>
                            <td>@if($pengadaan->barang)
                                  {{$pengadaan->barang->b_nama}}
                                @elseif($pengadaan->inventaris)
                                  {{$pengadaan->inventaris->i_nama}}
                                @else
                                  - Data Barang / Inventaris sudah dihapus -
                                @endif
                            </td>
                            <td>{{$pengadaan->qty}}</td>
                            <td>{{$pengadaan->biaya != 0 ? 'Rp. '. number_format($pengadaan->biaya, 2, ',', '.') : 'Free'}}</td>
                            <td>{{'Rp. '.number_format($pengadaan->total, 2, ',','.')}}</td>
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
            <form name="reportTahunan" id="reportTahunan" action="{{ route('pengadaan.cetak') }}"
                method="POST" class="form-horizontal bordered-row">
                {{ csrf_field() }}
                <input type="hidden" name="no_register" value="{{ $arr_pengadaan[0]->no_register }}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" formtarget="_blank">Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
