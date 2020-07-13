<?php

namespace App\Http\Controllers;

use App\Tempat;
use App\DasarSurat;
use App\Models\Sppd;
use App\Models\Dasar;
use App\Models\Nosurat;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SPPDController extends Controller
{
    public function index(Request $request)
    {
        $user = User::getUser();
        if ($request->search) {
            $sppd = $user->sppd()->orderBy('id', 'desc')->where('acara', 'LIKE', '%' . $request->search . '%')->orwhere('no_surat', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $sppd = $user->sppd()->orderBy('id', 'desc')->paginate(5);
        }
        return view('sppd.users.sppd', compact('user','sppd'));
    }
    public function entry()
    {
        $user = User::getUser();
        $tempatb = User::enum_get('tempat', 'tempat_berangkat');
        $kabid = User::select('nama')->where('role', 'Kepala Bidang')->first();
        return view('sppd.users.entry', compact('user', 'tempatb', 'kabid'));
    }
    public function storeentry(Request $request)
    {
        $validation = $this->validate($request, [
            'Acara'             => 'required',
            'TempatBerangkat'   => 'required',
            'Tanggal_Berangkat' => 'required|date',
            'Tanggal_Kembali'   => 'required|date|after_or_equal:Tanggal_Berangkat'
        ]);
        if ($request->TempatTujuan == null) {
            session()->flash('Failed', 'Gagal Menambah SPPD');
            return Redirect(Route('SPPD'));
        }
        if ($validation) {
            $surat = Nosurat::getDataSurat();
            Sppd::create([
                'no_surat'      => $surat->no_surat,
                'tahun_surat'   => $surat->tahun_surat,
                'tgl_pergi'     => $request->Tanggal_Berangkat,
                'tgl_kembali'   => $request->Tanggal_Kembali,
                'acara'         => $request->Acara
            ]);
            $sppdid = Sppd::select('id')->orderBy('id','DESC')->first();
            User::find(Auth::user()->id)->sppd()->attach($sppdid->id);
            Tempat::create([
                'sppd_id'           => $sppdid->id,
                'tempat_berangkat'  => $request->TempatBerangkat,
                'tempat_tujuan'     => $request->TempatTujuan
            ]);
            // Update Surat
            $this->updatenosurat($surat);
            $dasar = Dasar::get();
            foreach ($dasar as $isi) {
                DasarSurat::create([
                    'sppd_id'            => $sppdid->id,
                    'dasar_surat'   => $isi->dasar
                ]);
            }
            session()->flash('Success', 'Berhasil Menambah SPPD');
            return Redirect(Route('SPPD'));    # code...
        }else {
            session()->flash('Failed', 'Gagal Menambah SPPD');
            return Redirect(Route('SPPD'));
        }
    }
    public function updatenosurat($surat)
    {
        $nosurat = $surat->no_surat + 1;
        $surat->update(['no_surat' => $nosurat]);
    }
    public function showsppd($id)
    {
        $user = User::getUser();
        $sppd = Sppd::getSppd($id);
        if ($this->CekUserSppd($user,$sppd)) {
            $sppd = $sppd->first();
            return view('sppd.users.show',compact('user','sppd'));
        }else {
            return view('sppd.users.akses',compact('user'));
        }
    }
    public function CekUserSppd($id_user, $id_sppd)
    {
        foreach ($id_sppd as $sppd_data ) {
            foreach ($sppd_data->user as $user) {
                if (($user->id == $id_user->id || $id_user->role == 'Admin' )) {
                    return true;
                }
            }
        }
    }
}
