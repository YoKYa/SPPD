<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Nosurat extends Model
{
    protected $table = 'nosurat';
    protected $fillable = ['no_surat','tahun_surat'];

    public static function IncrementNoSurat()
    {
        $Increment = DB::table('nosurat')->select('no_surat','tahun_surat')->first();
        
    }
}
