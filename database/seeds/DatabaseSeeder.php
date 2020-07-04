<?php

use Illuminate\Database\Seeder;
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
    }
}
