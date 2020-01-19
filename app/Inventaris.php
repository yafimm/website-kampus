<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $table = 'inventaris';

    protected $primaryKey = 'i_id';

    protected $fillable = [
        'i_nama','i_unit','i_posisi','i_foto','i_keterangan', 'i_harga', 'i_kode', 'i_satuan'
    ];

    public function getTotalAttribute()
    {
        return $this->i_unit * $this->i_harga;
    }
}
