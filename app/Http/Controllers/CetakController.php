<?php

namespace App\Http\Controllers;

use App\Models\Sppd;
use App\Models\Auth\User;
use App\Models\Sppd_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CetakController extends Controller
{
    public function index()
    {
        return Redirect(Route('SPPD'));
    }
    public function SPT($id)
    {
        $user = User::getUser();
        $sppd = Sppd::getSppd($id);
        $sppduser = Sppd_user::orderBy('created_at', 'ASC')->where('sppd_id', $id)->get();
        $sppduserpegawai = User::select()->get();
        if (Sppd::CekUserSppd($user,$sppd)) {
            $sppd = $sppd->first();
            $sppd->update([
                'tgl_surat'=> now()
            ]);
            $tgl_pergi = date('d-m-Y',strtotime($sppd->tgl_pergi));
            $tgl_kembali = date('d-m-Y',strtotime($sppd->tgl_kembali));
            $lama = Sppd::selisih($tgl_pergi,$tgl_kembali);
            $tgl_pergi = date('d-m-Y',strtotime($sppd->tgl_pergi));
            return view('cetak.spt',compact('user','sppd','lama','sppduser','sppduserpegawai'));
        }else {
            return view('sppd.users.akses',compact('user'));
        }
    }
}
