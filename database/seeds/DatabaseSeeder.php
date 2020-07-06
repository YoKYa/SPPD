<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nama' => 'Admin',
            'nip'  => '1000000000',
            'password' => Hash::make('admin'),
            'role' => 1,
            'cek'  => 0
        ]);
        DB::table('users')->insert([
            'nama' => 'Kepala Bidang',
            'nip'  => '2000000000',
            'password' => Hash::make('kabid'),
            'role' => 2,
            'cek'  => 1
        ]);
        DB::table('users')->insert([
            'nama' => 'Kepala Seksi',
            'nip'  => '3000000000',
            'password' => Hash::make('pegawai'),
            'role' => 3,
            'cek'  => 1
        ]);
        DB::table('users')->insert([
            'nama' => 'Kepala Seksi',
            'nip'  => '4000000000',
            'password' => Hash::make('pegawai'),
            'role' => 4,
            'cek'  => 1
        ]);
    }
}
