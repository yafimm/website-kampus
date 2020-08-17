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

    protected $appends = ['total'];

    public function getTotalAttribute()
    {
        return $this->i_unit * $this->i_harga;
    }

    public function getStok($date = null)
    {
        if($date != null){
            return $this->pengadaan()->where([['created_at', '<=', $date]])->sum('qty') - $this->peminjaman()->where([['p_status', '=', 3], ['p_date', '<=', $date]])->sum('pivot.dp_jumlah');
        }
        $date = date('Y-m-d');
        return $this->pengadaan([['created_at', '<=', $date]])->sum('qty') - $this->request()->where([['p_status', '=', 3], ['p_date', '<=', $date]])->sum('pivot.dp_jumlah');
    }

    public function pengadaan()
    {
        return $this->hasMany('App\Pengadaan', 'inventaris_id', 'i_id');
    }

    public function maintenance()
    {
        return $this->hasMany('App\Maintenance', 'inventaris_id', 'i_id');
    }

    public function peminjaman()
    {
        return $this->belongsToMany('App\Peminjaman', 'table_data_detail_peminjaman', 'i_id', 'p_id')->withPivot(['dp_jumlah']);
    }
}
