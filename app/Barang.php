<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'b_kode', 'b_nama','b_stock','b_satuan','b_foto',
    ];
}
