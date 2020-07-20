<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Angkutan extends Model
{
    protected $table = 'angkutan';
    protected $fillable = ['sppd_id','angkutan','jenis','plat','angkutan_umum','sewa'];
}
