<?php

use Illuminate\Database\Seeder;

class MaintenanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Maintenance::create([
        'no_register' => 'MNTS0001',
        'kode' => '002',
        'barang_id' => 1,
        'posisi' => 'Penyerang',
        'tanggal_maintenance' => date('Y-m-d'),
        'biaya' => 10000,
        'keterangan' => 'Naon weh atuh',
      ]);

      \App\Maintenance::create([
        'no_register' => 'MNTS0001',
        'kode' => '001',
        'barang_id' => 2,
        'posisi' => 'geleandang',
        'tanggal_maintenance' => date('Y-m-d'),
        'biaya' => 10000,
        'keterangan' => 'Naon weh atuh',
      ]);

    }
}
