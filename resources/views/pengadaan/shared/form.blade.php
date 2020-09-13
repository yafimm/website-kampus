<div class="form-group my-2">
  <div class="example-box-wrapper" style="overflow: auto">
    <table id="tbl_pengadaan_detail" class="table table-striped table-bordered">
    <thead>
      <th>No</th>
      <th>Kode</th>
      <th>Nama Barang/Inventaris</th>
      <th width="10%">Qty</th>
      <th width="20%">Harga</th>
      <th width="20%">Total Harga</th>
      <th width="10%">Aksi</th>
    </thead>
    <tbody>
    @if(!$arr_pengadaan->isEmpty())
      @foreach($arr_pengadaan as $no => $pengadaan)
        <tr id="pengadaan-detail-{{$no}}">
          <td>{{$no + 1}}<input type="hidden" name="barang_inventaris[]" value="{{ (isset($pengadaan->barang) ? 'BRG'.$pengadaan->barang->b_id : (isset($pengadaan->inventaris) ? 'INV'.$pengadaan->inventaris->i_id : '-')) }}"> </td>
          <td>{{ (isset($pengadaan->barang) ? $pengadaan->barang->b_kode : (isset($pengadaan->inventaris) ? $pengadaan->inventaris->i_kode : ' - ')) }}</td>
          <td>{{ (isset($pengadaan->barang) ? $pengadaan->barang->b_nama : (isset($pengadaan->inventaris) ? $pengadaan->inventaris->i_nama : ' - ')) }}</td>
          <td><input id="qty-{{$no}}" class="form-control" type="text" name="qty[]" onkeyup="setQty({{$no}}, value)" value="{{ $pengadaan->qty }}"></td>
          <td><input id="harga-{{$no}}" class="form-control" type="text" name="harga[]" onkeyup="setHarga( {{ $no }}, value)" value="{{ $pengadaan->biaya }}"></td>
          <td><span id="totalHargaSpan-{{ $no }}">Rp. {{ numbeR_format($pengadaan->total, 2, ',', '.')}}</span><input type="hidden" id="totalHarga-{{$no}}" class="form-control" type="text" name="totalHarga[]" value="{{ $pengadaan->total }}" readonly></td>
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
