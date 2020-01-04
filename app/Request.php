<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
  protected $table = 'request_barang';

  protected $fillable = [
      'user_id','b_id','rb_jumlah','rb_status'
  ];
}
