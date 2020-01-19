@extends('template.layout')
@section('content')
<div class="container">

  <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-bootstrap.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-tabletools.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-reorder.js') }}"></script>

  <script type="text/javascript">
      /* Datatables export */

      $(document).ready(function () {
          var table = $('#dt_pengguna').DataTable();
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
      <h2>Halaman Data Pengguna</h2>
      <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
  </div>

  <div class="panel">
      <div class="panel-body">
          <h3 class="title-hero">
              <a href="{{ route('user.tambah', 'bagumum') }}" class="btn btn-primary">
                  <i class="glyph-icon icon-plus-circle"></i> Tambah Akun Bagian Umum
              </a>
              <a href="{{ route('user.tambah', 'mahasiswa') }}" class="btn btn-primary">
                  <i class="glyph-icon icon-plus-circle"></i> Tambah Akun Mahasiswa
              </a>
              <a href="{{ route('user.tambah', 'yayasan') }}" class="btn btn-primary">
                  <i class="glyph-icon icon-plus-circle"></i> Tambah Akun Yayasan
              </a>
          </h3>
          <div class="example-box-wrapper">
              <table id="dt_pengguna" class="table table-striped table-bordered" cellspacing="0"
                  width="100%">
                  <thead>
                      <tr>
                          <th></th>
                          <th>Nama</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>

                  <tfoot>
                      <tr>
                          <th></th>
                          <th>Nama</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Aksi</th>
                      </tr>
                  </tfoot>

                  <tbody>
                      @php
                      $count = 0;
                      @endphp
                      @foreach ($data_pengguna as $pengguna)
                      @php
                      $count = $count + 1;
                      @endphp
                      <tr>
                          <td>{{$count}}</td>
                          <td>{{$pengguna->name}}</td>
                          <td>{{$pengguna->email}}</td>
                          <td><span class="bs-label label-primary">{{$pengguna->role}}</span></td>
                          <td>
                              <a href="{{ route('user.lihat', $pengguna->id) }}" class="btn btn-info"  data-toggle="tooltip" data-placement="top" title="Lihat Data">
                                  <i class="glyph-icon icon-eye"></i>
                              </a>
                              <a href="{{ route('user.ubah', $pengguna->id) }}" class="btn btn-warning"  data-toggle="tooltip" data-placement="top" title="Ubah Data">
                                  <i class="glyph-icon icon-pencil"></i>
                              </a>
                              <button class="btn btn-danger btn-md" data-toggle="modal"
                                  data-target="#modalHapus" data-userid="{{$pengguna->id}}"  data-toggle="tooltip" data-placement="top" title="Hapus Data">
                                  <i class="glyph-icon icon-trash"></i>
                              </button>
                              <button class="btn btn-info btn-md" data-toggle="modal"
                                  data-target="#modalPassword" data-userid="{{$pengguna->id}}"  data-toggle="tooltip" data-placement="top" title="Ubah Sandi Data">
                                  <i class="glyph-icon icon-circle-o"></i>
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
              <form name="deleteForm" id="deleteForm" action="{{ route('user.prosesHapus') }}"
                  method="POST" class="form-horizontal">
                  {{ csrf_field() }}
                  @method('post')
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
          var id = button.data('userid');
          var modal = $(this);
          modal.find('#id').val(id);
      });

  </script>

  <div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header" style="background-color:#357ef2;color:#fff">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Ubah Kata Sandi / Password</h4>
              </div>
              <form name="passwordForm" id="passwordForm" action="{{ route('user.resetPassword') }}"
                  method="POST" class="form-horizontal">
                  @method('post')
                  {{ csrf_field() }}
                  <input type="hidden" name="iduser" id="iduser">
                  <div class="modal-body">
                      <p>Masukkan kata sandi baru</p>
                      <br>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">Password / Kata Sandi</label>
                          <div class="col-sm-6">
                              <input required name="password" type="password" class="form-control" id="password"
                                  placeholder="Kolom Kata Sandi">
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-success">Simpan</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <script type="text/javascript">
      $('#modalPassword').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var id = button.data('userid');
          var modal = $(this);
          modal.find('#iduser').val(id);
      });

  </script>


</div>
@endsection
