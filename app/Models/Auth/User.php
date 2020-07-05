<?php

namespace App\Models\Auth;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['nama', 'nip', 'alamat', 'password', 'tgllahir', 'golongan','jabatan','created_at','updated_at','role'];

}
