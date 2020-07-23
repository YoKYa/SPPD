<?php

namespace App\Models;

use App\Models\Kabid;
use App\Models\Tempat;
use App\Models\Angkutan;
use App\Models\Keterangan;
use App\Models\Auth\User;
use App\Models\DasarSurat;
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
    public function bbsppd()
    {
        return $this->hasOne(Bbsppd::class,'sppd_id');
    }
    public function kabid()
    {
        return $this->hasOne(Kabid::class,'sppd_id');
    }
    public function angkutan()
    {
        return $this->hasOne(Angkutan::class,'sppd_id');
    }
    public function keterangan()
    {
        return $this->hasOne(Keterangan::class,'sppd_id');
    }
    public function sppd_user()
    {
        return $this->hasMany(Sppd_user::class,'sppd_id');
    }
    public static function getSppd($id)
    {
        return Sppd::get()->where('id', $id);
    }

    public static function CekUserSppd($id_user, $id_sppd)
    {
        foreach ($id_sppd as $sppd_data ) {
            foreach ($sppd_data->user as $user) {
                if (($user->id == $id_user->id || $id_user->role == 'Admin' )) {
                    return true;
                }
            }
        }
    }
    public static function selisih($awal, $akhir)
    {
        $awal = date_create($awal);
        $akhir = date_create($akhir);
        $diff  = date_diff( $awal, $akhir );
        $angka = $diff->d+1;
        return $angka." "."( ".Sppd::penyebut($angka)." )";
    }
    public static function penyebut($angka)
    {
        $angka = abs($angka);
        $huruf = array('','satu','dua','tiga','empat','lima','enam','tujuh','delapan','sembilan','sepuluh','sebelas');
        $temp  = '';
        if ($angka < 12) {
            $temp = ' '.$huruf[$angka];
        }elseif ($angka < 20) {
            $temp = Sppd::penyebut($angka-10). " belas";
        }elseif ($angka < 100) {
            $temp = Sppd::penyebut($angka/10). " puluh".Sppd::penyebut($angka % 10);
        }elseif ($angka < 200) {
            $temp = " seratus".Sppd::penyebut($angka-100);
        }elseif ($angka < 1000) {
            $temp = Sppd::penyebut($angka/100).' ratus'.Sppd::penyebut($angka%100);
        }elseif ($angka < 2000) {
            $temp = ' seribu'.Sppd::penyebut($angka-1000);
        }elseif ($angka < 1000000) {
            $temp = Sppd::penyebut($angka/1000). ' ribu'.Sppd::penyebut($angka%1000);
        }elseif ($angka < 1000000000) {
            $temp = Sppd::penyebut($angka/1000000). ' juta'.Sppd::penyebut($angka%1000000);
        }elseif ($angka < 1000000000000) {
            $temp = Sppd::penyebut($angka/1000000000). ' miliar'.Sppd::penyebut(fmod($angka,1000000000));
        }elseif ($angka < 1000000000000000) {
            $temp = Sppd::penyebut($angka/1000000000000). ' triliun'.Sppd::penyebut(fmod($angka,1000000000000));
        }
        return $temp;
    }
}
