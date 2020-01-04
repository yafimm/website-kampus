<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
  protected $table = 'pembelian';

  protected $fillable = [
      'kode','nama_barang','qty','harga', 'supplier', 'tgl_pembelian'
  ];
  
}
