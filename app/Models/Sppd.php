<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Sppd extends Model
{
    protected $table = 'sppd';

    public function user()
    {
        return $this->belongsToMany(User::class,'sppd_users','sppd_id','users_id');
    }
}
