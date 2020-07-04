<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use Notifiable;

    protected $fillable = ['nama', 'nip', 'alamat', 'password', 'tgllahir', 'golongan','jabatan','created_at','updated_at','role'];
}
