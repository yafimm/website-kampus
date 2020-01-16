<?php

use Illuminate\Database\Seeder;

class PengadaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Pengadaan::create([
        'no_register' => 'PNGD0001',
        'kode' => '001',
        'supplier' => 'Toko Hasan',
        'barang_id' => 1,
        'qty' => 2,
        'tanggal' => date('Y-m-d'),
        'biaya' => 10000,
      ]);

      \App\Pengadaan::create([
        'no_register' => 'PNGD0001',
        'kode' => '002',
        'supplier' => 'Toko Hasan',
        'barang_id' => 2,
        'qty' => 1,
        'tanggal' => date('Y-m-d'),
        'biaya' => 12000,
      ]);

      \App\Pengadaan::create([
        'no_register' => 'PNGD0002',
        'kode' => '002',
        'supplier' => 'Toko Budi',
        'barang_id' => 1,
        'qty' => 3,
        'tanggal' => date('Y-m-d'),
        'biaya' => 10000,
      ]);

    }
}
