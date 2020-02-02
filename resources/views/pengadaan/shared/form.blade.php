<div class="form-group my-2">
  <div class="body-form" id="body-form-detail">
    @if(!empty($arr_pengadaan))
      <!-- Kalo gak edit bakal nampilin edit -->
      @foreach($arr_pengadaan as $no => $pengadaan)

      <hr>
      <h5>Data Detail ke - {{ $no + 1 }}</h5>
        <div class="row margin-bottom-sm" id="row'+ totalDetail++ +'">
        <div class="col-md-4 col-sm-4 col-6 form-controll">
          <label class="col-12 control-label">Kode</label>
          <div class="col-12">
            <input required name="kode[]" type="text" value="{{ old('kode', $pengadaan->kode) }}" class="form-control" id="" placeholder="Kolom Kode">
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-6 form-controll">
          <label for="exampleFormControlSelect1">Barang</label>
          <div class="col-12">
            <input required name="barang_id[]" type="text" value="{{ old('barang_id', $pengadaan->barang_id) }}" class="form-control" id="" placeholder="Kolom Kode">
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-6 form-controll">
          <label class="col-12 control-label">Jumlah barang</label>
          <div class="col-12">
            <input required name="qty[]" value="{{ $pengadaan->qty }}" type="text" class="form-control" id="" placeholder="Kolom Posisi">
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-6 form-controll">
          <label class="col-12 control-label">Biaya</label>
          <div class="col-12">
            <input required name="biaya[]" type="text" value="{{ $pengadaan->biaya }}" class="form-control" id="" placeholder="Kolom Biaya">
          </div>
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
