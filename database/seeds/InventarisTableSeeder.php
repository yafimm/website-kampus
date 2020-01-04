<?php

use Illuminate\Database\Seeder;

class InventarisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Inventaris::create([
        'i_kode' => 'INV0001',
        'i_nama' => 'Spidol',
        'i_unit' => 32,
        'i_posisi' => 'Penyerang',
        'i_harga' => 12000,
        'i_foto' => '1577560528.jpg',
        'i_keterangan' => 'asdasd',
        'i_satuan' => 'pcs',
      ]);

      \App\Inventaris::create([
        'i_kode' => 'INV0002',
        'i_nama' => 'Proyektor',
        'i_unit' => 3,
        'i_posisi' => 'Penyerang',
        'i_harga' => 12000,
        'i_foto' => '1577560528.jpg',
        'i_keterangan' => 'asdasd',
        'i_satuan' => 'pcs',
      ]);

      \App\Inventaris::create([
        'i_kode' => 'INV0003',
        'i_nama' => 'Papan Tulis',
        'i_unit' => 12,
        'i_posisi' => 'Penyerang',
        'i_harga' => 12000,
        'i_foto' => '1577560528.jpg',
        'i_keterangan' => 'asdasd',
        'i_satuan' => 'pcs',
      ]);
    }
}
