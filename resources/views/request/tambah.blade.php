@extends('template.layout')
@section('content')
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

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
                    <form class="form-horizontal" action="{{ route('request.prosesTambah') }}"
                        method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="status" value="0">
                        <input type="hidden" name="iduser" value="{{Auth::user()->id}}">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Jenis</label>
                            <div class="col-md-6 col-lg-3 col-sm-12">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis" id="exampleRadios1" value="ATK" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                  ATK
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis" id="exampleRadios2" value="ART">
                                <label class="form-check-label" for="exampleRadios2">
                                  ART
                                </label>
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                              <label class="col-sm-3 control-label">Barang</label>
                              <div class="col-md-6 col-lg-3 col-sm-12">
                                  <div class="col-sm-12">
                                    <div class="input-prepend input-group">
                                        <span class="add-on input-group-addon">
                                            <i class="glyph-icon icon-search"></i>
                                        </span>
                                        <select id="cari" class="cari form-control" style="width:500px;" name="b_id"></select>
                                    </div>
                                  </div>
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

  <script type="text/javascript">
  var urlCari = '{!! route("request.cari") !!}';
  $('.cari').select2({
    placeholder: 'Cari berdasarkan kode/nama ..',
    ajax: {
        url: urlCari,
        dataType: 'json',
        data: function (params) {
                  var query = {
                    q: params.term,
                    type: 'public',
                    jenis:$('input[name="jenis"]:checked').val()
                  }

              return query;
              },
      type:"GET",
      delay: 250,
      processResults: function (data) {
        console.log(data);
        return {
          results:  $.map(data, function (item) {
            return {
              text: item.b_nama,
              id: item.b_id
            }
          })
        };
      },
      cache: true
    }
  });
  </script>
@endsection
