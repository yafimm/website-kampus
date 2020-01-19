<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $primaryKey = 'b_id';

    protected $fillable = [
        'b_kode', 'b_nama','b_stock','b_satuan','b_foto', 'b_harga'
    ];

    public function getTotalAttribute()
    {
        return $this->b_stock * $this->b_harga;
    }
}
