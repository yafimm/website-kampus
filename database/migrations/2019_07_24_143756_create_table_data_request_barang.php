<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataRequestBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_barang', function (Blueprint $table) {
            $table->bigIncrements('rb_id');
            $table->integer('user_id');
            $table->integer('b_id');
            $table->integer('rb_jumlah');
            $table->integer('rb_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_data_request_barang');
    }
}
