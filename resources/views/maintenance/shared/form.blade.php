<div class="form-group my-2">
  <div class="example-box-wrapper" style="overflow: auto">
    <table id="tbl_maintenance" class="table table-striped table-bordered table-sm" width="100%">
    <thead>
      <th>No</th>
      <th>Kode</th>
      <th>Nama Barang/Inventaris</th>
      <th>Posisi</th>
      <th>Biaya</th>
      <th>Keterangan</th>
      <th>Status</th>
      <th>Aksi</th>
    </thead>
    <tbody>
    @if(!$arr_maintenance->isEmpty())
      @foreach($arr_maintenance as $no => $maintenance)
        <tr id="maintenance-detail-{{$no}}">
          <td>{{$no + 1}}<input type="hidden" name="barang_inventaris[]" value="{{ isset($maintenance->barang) ? 'BRG'.$maintenance->barang->b_id : (isset($maintenance->inventaris) ? 'INV'.$maintenance->inventaris->i_id : '-') }}"> </td>
          <td>{{ (isset($maintenance->barang) ? $maintenance->barang->b_kode : (isset($maintenance->inventaris) ? $maintenance->inventaris->i_kode : ' - ')) }}</td>
          <td>{{ (isset($maintenance->barang) ? $maintenance->barang->b_nama : (isset($maintenance->inventaris) ? $maintenance->inventaris->i_nama : ' - ')) }}</td>
          <td><input id="posisi-{{$no}}" class="form-control" type="text" name="posisi[]" value="{{ $maintenance->posisi }}"></td>
          <td><input id="biaya-{{$no}}" class="form-control" type="text" name="biaya[]" onkeyup="setHarga( {{ $no }}, value)" value="{{ $maintenance->biaya }}"></td>
          <td><textarea class="form-control" name="keterangan[]">{{ $maintenance->keterangan }}</textarea></td>
          <td>
              <select class="form-control" name="status[]" value"{{ old('status', $maintenance->status) }}" id="exampleFormControlSelect1">
                <option value="Belum Mulai" {{ $maintenance->status == 'Belum Mulai' ? 'selected' : '' }}>Belum Mulai</option>
                <option value="Sedang Berjalan" {{ $maintenance->status == 'Sedang Berjalan' ? 'selected' : '' }}>Sedang Berjalan</option>
                <option value="Selesai" {{ $maintenance->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
              </select>
          </td>
          <td><button type="button" class="btn btn-danger btn-sm" onclick="hapusItem({{ $no }})" data-id="{{ $no }}" data-toggle="tooltip" data-placement="top"><i class="glyph-icon icon-trash"></i></button></td>
        </tr>
      @endforeach
    @endif
  </tbody>
  </table>
  </div>


  </div>
</div>

<div class="form-group">
    <div class="col-sm-3">
        <button type="submit" class="btn btn-success">
                <i class="glyph-icon icon-check"></i>Submit</button>
    </div>
</div>
