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
        $this->call(UsersTableSeeder::class);
        $this->call(NosuratTableSeeder::class);
        $this->call(BidangTableSeeder::class);
    }
}
