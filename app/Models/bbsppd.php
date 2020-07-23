<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bbsppd extends Model
{
    protected $table = 'bbsppd';
    protected $fillable = ['sppd_id','skpd','program','kegiatan','rekening'];
}
