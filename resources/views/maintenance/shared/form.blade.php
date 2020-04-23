<div class="form-group my-2">
  <div class="body-form" id="body-form-detail">
    @if(isset($arr_maintenance))
      <!-- Kalo gak edit bakal nampilin edit -->

      @foreach($arr_maintenance as $no => $maintenance)

      <hr>
      <h5>Data Detail ke - {{ $no + 1 }}</h5>
        <div class="row margin-bottom-sm" id="row'+ totalDetail++ +'">
        <div class="col-md-4 col-sm-4 col-6 form-controll">
          <label class="col-12 control-label">Kode</label>
          <div class="col-12">
            <input required name="kode[]" type="text" value="{{ old('kode', $maintenance->kode) }}" class="form-control" id="" placeholder="Kolom Kode">
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-6 form-controll">
          <label for="exampleFormControlSelect1">Barang/Inventaris</label>
          <select class="form-control" name="barang_inventaris[]" value"{{ old('barang_id', $maintenance->barang_id) }}" id="exampleFormControlSelect1">
            @foreach($arr_barang_inventaris as $barang_inventaris)
              @if(isset($barang_inventaris->b_id))
                <option value="BRG{{ $barang_inventaris->b_id }}" {{ $maintenance->barang ? ($maintenance->barang->b_id == $barang_inventaris->b_id ? 'selected': '-' ) : '-' }}> {{ $barang_inventaris->b_nama }}</option>
              @else
                <option value="INV{{ $barang_inventaris->i_id }}" {{ $maintenance->inventaris ? ($maintenance->inventaris->i_id == $barang_inventaris->i_id ? 'selected': '-' ) : '-' }}> {{ $barang_inventaris->i_nama }}</option>
              @endif
            @endforeach
          </select>
        </div>
        <div class="col-md-4 col-sm-4 col-6 form-controll">
          <label class="col-12 control-label">Posisi</label>
          <div class="col-12">
            <input required name="posisi[]" value="{{ $maintenance->posisi }}" type="text" class="form-control" id="" placeholder="Kolom Posisi">
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-6 form-controll">
          <label class="col-12 control-label">Biaya</label>
          <div class="col-12">
            <input required name="biaya[]" type="text" value="{{ $maintenance->biaya }}" class="form-control" id="" placeholder="Kolom Biaya">
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-6 form-controll">
          <label class="col-12 control-label">Keterangan</label>
          <div class="col-12">
            <input required name="keterangan[]" type="text" value="{{ $maintenance->keterangan }}" class="form-control" id=""placeholder="Kolom Keterangan">
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-6 form-controll">
          <label for="exampleFormControlSelect1">Status</label>
          <select class="form-control" name="status[]" value"{{ old('status', $maintenance->status) }}" id="exampleFormControlSelect1">
            <option value="Belum Mulai" {{ $maintenance->status == 'Belum Mulai' ? 'selected' : '' }}>Belum Mulai</option>
            <option value="Sedang Berjalan" {{ $maintenance->status == 'Sedang Berjalan' ? 'selected' : '' }}>Sedang Berjalan</option>
            <option value="Selesai" {{ $maintenance->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
          </select>
        </div>
      </div>

      @endforeach

    @endif
  </div>


  </div>
</div>

<div class="form-group">
    <div class="col-sm-3 col-sm-offset-3">
      <button type="button" class="btn btn-primary" name="button" id="tambah-maintenance-detail"><i class="glyphicon glyphicon-plus"></i> Tambah Data Detail</button>
    </div>
    <div class="col-sm-3">
        <button type="submit" class="btn btn-success">
                <i class="glyph-icon icon-check"></i>Submit</button>
    </div>
</div>
