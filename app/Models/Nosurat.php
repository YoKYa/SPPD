<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Nosurat extends Model
{
    protected $table = 'no_surat';
    protected $fillable = ['no_surat','tahun_surat'];

    public static function IncrementNoSurat()
    {
        $Increment = DB::table('no_surat')->select('no_surat','tahun_surat')->first();
        
    }
}
