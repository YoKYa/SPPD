<?php

namespace App\Models\Auth;

use App\Models\jabatan;
use App\Models\Golongan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['nama', 'nip', 'alamat', 'password', 'tgllahir', 'golongan','jabatan','created_at','updated_at','role'];
    public function jabatan()
    {
        return $this->hasOne(Jabatan::class);
    }
    public function golongan()
    {
        return $this->hasOne(Golongan::class);
    }
    public static function enum_get($table, $column)
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field='{$column}'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $no = 1;
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $enum[$no] = $v;
            $no++;
        }
        return collect($enum);
    }
    public static function role_check($role)
    {
        $roles = collect($role);
        foreach ($roles as $role) {
            if ($role == Auth::user()->role) {
                return True;
            }
        }
    }
    // Fungsi Diluar 
    public static function getUser(){
        return User::get()->where('id',Auth::user()->id)->first();
    }
}
