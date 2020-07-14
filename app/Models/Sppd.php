<?php

namespace App\Models;

use App\DasarSurat;
use App\Models\Kabid;
use App\Models\Auth\User;
use App\Tempat;
use Illuminate\Database\Eloquent\Model;

class Sppd extends Model
{
    protected $table = 'sppd';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsToMany(User::class,'sppd_users','sppd_id','users_id');
    }
    public function dasar_surat()
    {
        return $this->hasMany(DasarSurat::class,'sppd_id');
    }
    public function tempat()
    {
        return $this->hasOne(Tempat::class,'sppd_id');
    }
    public function kabid()
    {
        return $this->hasOne(Kabid::class,'sppd_id');
    }
    public static function getSppd($id)
    {
        return Sppd::get()->where('id', $id);
    }
}
