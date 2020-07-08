<?php

use App\Models\Nosurat;
use Illuminate\Database\Seeder;

class NosuratTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Nosurat::create([
            'no_surat' => 1,
            'tahun_surat'=> 2020
        ]);
    }
}
