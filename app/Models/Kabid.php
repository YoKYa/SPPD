<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kabid extends Model
{
    protected $table = 'kabid';
    protected $fillable = ['sppd_id','nama_kabid','nip','jabatan'];
}
