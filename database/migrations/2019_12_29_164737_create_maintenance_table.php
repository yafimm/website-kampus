<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_register');
            $table->string('kode');
            $table->integer('barang_id')->nullable();
            $table->integer('inventaris_id')->nullable();
            $table->string('posisi');
            $table->date('tanggal_maintenance');
            $table->integer('biaya')->nullable();
            $table->string('keterangan')->nullable();
            $table->enum('status',['SELESAI','SEDANG BERJALAN','BELUM MULAI'])->default('BELUM MULAI');
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
        Schema::dropIfExists('maintenance');
    }
}
