<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
  protected $table = 'request_barang';

  protected $primaryKey = 'rb_id';

  protected $fillable = [
      'user_id','b_id','rb_jumlah','rb_status'
  ];

  public function barang()
  {
      return $this->belongsTo('App\Barang', 'b_id');
  }

  public function user()
  {
      return $this->belongsTo('App\User', 'user_id');
  }
}
