<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
  protected $table = 'pengadaan';

  protected $fillable = [
      'kode','barang_id','qty','biaya', 'supplier', 'tanggal', 'inventaris_id', 'no_register'
  ];

  public function barang()
  {
      return $this->belongsTo('App\Barang', 'barang_id', 'b_id');
  }

  public function inventaris()
  {
      return $this->belongsTo('App\Inventaris', 'inventaris_id', 'i_id');
  }

  public function getTotalAttribute()
  {
      return $this->qty * $this->biaya;
  }

}
