<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $primaryKey = 'b_id';

    protected $fillable = [
        'b_kode', 'b_nama','b_stock','b_satuan','b_foto', 'b_harga', 'jenis'
    ];

    protected $appends = ['total', 'stok'];


    public function getTotalAttribute()
    {
        return $this->stok * $this->b_harga;
    }

    public function getTanggalAttribute()
    {
        return $this->created_at ? $this->created_at->format('d-m-Y') : null;
    }

    public function getStok($date = null)
    {
        if($date == null){
            $date = date('Y-m-d H:i:s');
            return $this->pengadaan()->where('created_at', '<=', $date)->sum('qty') - $this->request()->where('rb_status', '>=', 2)->where('created_at', '<=', $date)->sum('rb_jumlah');
        }
        return $this->pengadaan()->where('created_at', '<=', $date)->sum('qty') - $this->request()->where('rb_status', '>=', 2)->where('created_at', '<=', $date)->sum('rb_jumlah');
    }

    public function getStokAttribute()
    {
        return $this->pengadaan->sum('qty') - $this->request->where('rb_status', '>=', 2)->sum('rb_jumlah');
    }

    public function pengadaan()
    {
        return $this->hasMany('App\Pengadaan', 'barang_id', 'b_id');
    }

    public function request()
    {
        return $this->hasMany('App\Request', 'b_id', 'b_id');
    }

    public function maintenance()
    {
        return $this->hasMany('App\Maintenance', 'barang_id', 'b_id');
    }
}
