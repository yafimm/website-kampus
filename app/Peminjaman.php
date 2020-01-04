<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
  protected $table = 'peminjaman';

  protected $fillable = [
      'user_id','p_date','p_scan_surat_peminjaman','p_status', 'p_date_end', 'p_time_start', 'p_time_end', 'p_nama_event'
  ];
}
