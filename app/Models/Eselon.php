<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eselon extends Model
{
    protected $table = 'eselon';
    protected $fillable = ['user_id','nama_eselon'];
}
