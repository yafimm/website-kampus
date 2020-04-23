<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = 'maintenance';

    protected $fillable = [
        'no_register','kode','barang_id','posisi','tanggal_maintenance', 'biaya', 'keterangan', 'status', 'inventaris_id'
    ];

    public function barang()
    {
        return $this->belongsTo('App\Barang', 'barang_id', 'b_id');
    }

    public function inventaris()
    {
        return $this->belongsTo('App\Inventaris', 'inventaris_id', 'i_id');
    }

}
