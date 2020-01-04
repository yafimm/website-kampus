<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\User::create([
        'name' => 'admin',
        'email' => 'admin@yafimm.com',
        'password' => bcrypt('admin'),
        'role' => 'admin',
        'nip' => 'admin',
        'npm' => 'admin'
      ]);

      \App\User::create([
        'name' => 'mahasiswa',
        'email' => 'mahasiswa@gmail.com',
        'password' => bcrypt('mahasiswa'),
        'role' => 'mahasiswa',
        'nip' => '130112323',
        'npm' => '130',
      ]);

      \App\User::create([
        'name' => 'bagumum',
        'email' => 'bagumum@gmail.com',
        'password' => bcrypt('bagumum'),
        'role' => 'bagumum',
        'nip' => '12202020',
        'npm' => '1222',
      ]);

      \App\User::create([
        'name' => 'dosen',
        'email' => 'dosen@gmail.com',
        'password' => bcrypt('dosen'),
        'role' => 'dosen',
        'nip' => '12202020',
        'npm' => '1222',
      ]);
    }
}
