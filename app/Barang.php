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

    protected $appends = ['tanggal', 'total'];


    public function getTotalAttribute()
    {
        return $this->b_stock * $this->b_harga;
    }

    public function getTanggalAttribute()
    {
        return $this->created_at ? $this->created_at->format('d-m-Y') : null;
    }
}
