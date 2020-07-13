<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Nosurat extends Model
{
    protected $table = 'no_surat';
    protected $fillable = ['no_surat','tahun_surat'];

    public static function getDataSurat()
    {
        $surat = Nosurat::first();
        return $surat;
    }
}
