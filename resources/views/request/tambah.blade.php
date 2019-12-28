@extends('dosen.app')
@section('content')
<div id="page-content-wrapper">
    <div id="page-content">

        <div class="container">

            <script type="text/javascript" src="{{ asset('assets/widgets/chosen/chosen.js') }}"></script>
            <script type="text/javascript" src="{{ asset('assets/widgets/chosen/chosen-demo.js') }}"></script>

            <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable.js') }}"></script>
            <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-bootstrap.js') }}">
            </script>
            <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-tabletools.js') }}">
            </script>
            <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-reorder.js') }}"></script>

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
                <h2>Halaman Request Barang</h2>
                <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <h3 class="title-hero">

                    </h3>
                    <div class="example-box-wrapper">
                        <div class="example-box-wrapper">
                            <form class="form-horizontal" action="{{ url('/dosen/request/prosesTambah') }}"
                                method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="status" value="0">
                                <input type="hidden" name="iduser" value="{{Auth::user()->id}}">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Barang</label>
                                    <div class="col-sm-6">
                                        <select name="idBarang" class="chosen-select">
                                            <optgroup label="Barang">
                                                @foreach ($data_barang as $barang)
                                                <option value="{{$barang->b_id}}">{{$barang->b_nama}}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Jumlah</label>
                                    <div class="col-sm-6">
                                        <input required name="jumlah" type="number" class="form-control" id=""
                                            placeholder="Jumlah">
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
