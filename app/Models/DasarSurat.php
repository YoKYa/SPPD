<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DasarSurat extends Model
{
    protected $table = 'dasar_surat';
    protected $fillable = ['sppd_id','dasar_surat'];
}
