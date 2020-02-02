<?php

use Illuminate\Database\Seeder;

class RequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Request::create([
        'user_id' => 4,
        'b_id' => 1,
        'rb_jumlah' => 2,
        'rb_status' => 0,
      ]);

      \App\Request::create([
        'user_id' => 4,
        'b_id' => 2,
        'rb_jumlah' => 12,
        'rb_status' => 1,
      ]);

      \App\Request::create([
        'user_id' => 4,
        'b_id' => 3,
        'rb_jumlah' => 5,
        'rb_status' => 2,
      ]);
    }
}
