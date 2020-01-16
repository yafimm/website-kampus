<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BarangTableSeeder::class);
        $this->call(MaintenanceTableSeeder::class);
        $this->call(InventarisTableSeeder::class);
        $this->call(RequestTableSeeder::class);
        $this->call(PengadaanTableSeeder::class);
    }
}
