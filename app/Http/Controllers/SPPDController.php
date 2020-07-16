<?php

namespace App\Http\Controllers;

use App\Models\Tempat;
use App\Models\DasarSurat;
use App\Models\Kabid;
use App\Models\Sppd;
use App\Models\Dasar;
use App\Models\Nosurat;
use App\Models\Auth\User;
use App\Models\Sppd_user;
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
        $kabid = User::where('role','Kepala Bidang')->first();
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
            Kabid::create([
                'sppd_id' =>$sppdid->id,
                'nama_kabid' => $kabid->nama,
                'nip' => $kabid->nip,
                'jabatan' => $kabid->jabatan->jabatan
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
            $sppd->update([
                'tgl_surat'=> now()
            ]);
            return view('sppd.users.spt',compact('user','sppd'));
        }else {
            return view('sppd.users.akses',compact('user'));
        }
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
    public function editsppd($id)
    {
        $user = User::getUser();
        $sppd = Sppd::getSppd($id);
        if ($this->CekUserSppd($user,$sppd)) {
            $sppd = $sppd->first();
            $lama = Sppd::selisih($sppd->tgl_pergi,$sppd->tgl_pergi);
            return view('sppd.users.edit',compact('user','sppd','lama'));
        }else {
            return view('sppd.users.akses',compact('user'));
        }
    }
    
    public function addfollower($id)
    {
        $user = User::getUser();
        $all_user = User::get();
        $sppduser = Sppd_user::orderBy('created_at', 'ASC')->where('sppd_id', $id)->get();
        $sppduserpegawai = User::select()->get();
        $sppd = Sppd::getSppd($id);
        if ($this->CekUserSppd($user,$sppd)) {
            $sppd = $sppd->first();
            return view('sppd.users.addfollower',compact('user','all_user','sppd', 'sppduser', 'sppduserpegawai'));
        }else {
            return view('sppd.users.akses',compact('user'));
        }
        
    }
    public function storeaddfollower(Request $request, $id)
    {
        if ($request->nip != null) {
            User::where('nip',$request->nip)->first()->sppd()->attach($id);
            session()->flash('Success', 'Berhasil Menambah Pengikut');
            return back();
        }else {
            session()->flash('Failed', 'Gagal Menambah Pengikut');
            return back();
        }
        
    }
    public function removefollower($sppd_id, $users_id)
    {
        Sppd_user::select()->where('sppd_id', $sppd_id)->where('users_id',$users_id)->delete();
        session()->flash('Success', 'Berhasil Menghapus Pengikut');
        return back();
    }
}
