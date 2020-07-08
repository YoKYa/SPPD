<?php

use App\Models\Golongan;
use App\Models\Auth\User;
use App\Models\Jabatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $users = collect([
            [
                'nama'  => 'Admin',
                'nip'  => '1000000000',
                'password' => Hash::make('admin'),
                'role' => 1,
                'cek'  => 0
            ],
            [
                'nama'  => 'Kepala Bidang',
                'nip'  => '2000000000',
                'password' => Hash::make('kabid'),
                'role' => 2,
                'cek'  => 1
            ],
            [
                'nama'  => 'Kepala Seksi',
                'nip'  => '3000000000',
                'password' => Hash::make('kasi'),
                'role' => 3,
                'cek'  => 1
            ],
            [
                'nama'  => 'Staff',
                'nip'  => '4000000000',
                'password' => Hash::make('staff'),
                'role' => 4,
                'cek'  => 1
            ]
        ]);
        $number = collect([1,2,3,4]);

        $users->each(function($data){
            User::create([
                'nama'      => $data['nama'],
                'nip'       => $data['nip'],
                'password'  => $data['password'],
                'role'      => $data['role'],
                'cek'       => $data['cek']
            ]);
        });
        $number->each(function($data){
            Jabatan::create([
                'user_id' => $data
            ]);
            Golongan::create([
                'user_id' => $data
            ]);
        });
    }
}
