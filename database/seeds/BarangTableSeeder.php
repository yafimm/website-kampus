<?php

use Illuminate\Database\Seeder;

class BarangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Barang::create([
        'b_kode' => 'BRG0001',
        'b_nama' => 'Spidol',
        'b_stock' => 32,
        'b_satuan' => 'pcs',
      ]);

      \App\Barang::create([
        'b_kode' => 'BRG0002',
        'b_nama' => 'Proyektor',
        'b_stock' => 3,
        'b_satuan' => 'pcs',
      ]);

      \App\Barang::create([
        'b_kode' => 'BRG0003',
        'b_nama' => 'Papan Tulis',
        'b_stock' => 12,
        'b_satuan' => 'pcs',
      ]);
    }
}
