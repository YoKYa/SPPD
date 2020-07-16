<?php

namespace App\Models;

use App\Models\Sppd;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sppd_user extends Model
{
    protected $fillable = ['updated_at','created_at'];
    public function user()
    {
        return $this->hasOne(User::class,'id','users_id');
    }
    public function sppd()
    {
        return $this->hasOne(Sppd::class,'id','sppd_id');
    }
}
