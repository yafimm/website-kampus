<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
  protected $table = 'peminjaman';

  protected $primaryKey = 'p_id';

  protected $fillable = [
      'user_id','p_date','p_scan_surat_peminjaman','p_status', 'p_date_end', 'p_time_start', 'p_time_end', 'p_nama_event'
  ];

  public function barang()
  {
      return $this->belongsTo('App\Barang', 'id');
  }

  public function user()
  {
      return $this->belongsTo('App\User', 'user_id');
  }

  public function inventaris()
  {
      return $this->belongsToMany('App\Inventaris', 'table_data_detail_peminjaman', 'p_id', 'i_id')->withPivot(['dp_jumlah']);
  }
}
