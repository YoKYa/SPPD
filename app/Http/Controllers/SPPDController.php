<?php

namespace App\Http\Controllers;

use App\Models\Angkutan;
use App\Models\Tempat;
use App\Models\DasarSurat;
use App\Models\Kabid;
use App\Models\Sppd;
use App\Models\Dasar;
use App\Models\Nosurat;
use App\Models\Auth\User;
use App\Models\Bbsppd;
use App\Models\Bebanbiaya;
use App\Models\Kegiatan;
use App\Models\Keterangan;
use App\Models\Program;
use App\Models\Rekening;
use App\Models\Skpd;
use App\Models\Sppd_user;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SPPDController extends Controller
{
    public function index(Request $request)
    {
        $user = User::getUser();
        if ($request->search) {
            if ($request->search >= 1) {
                $sppd = $user->sppd()->orderBy('id', 'desc')->where('no_surat', 'LIKE', '%' . $request->search . '%')->paginate(5);
            } else {
                $sppd = $user->sppd()->orderBy('id', 'desc')->where('acara', 'LIKE', '%' . $request->search . '%')->paginate(5);
            }
        } else {
            $sppd = $user->sppd()->orderBy('id', 'desc')->paginate(5);
        }
        return view('sppd.users.sppd', compact('user', 'sppd'));
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
        $kabid = User::where('role', 'Kepala Bidang')->first();
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
            $sppdid = Sppd::select('id')->orderBy('id', 'DESC')->first();
            User::find(Auth::user()->id)->sppd()->attach($sppdid->id);
            Tempat::create([
                'sppd_id'           => $sppdid->id,
                'tempat_berangkat'  => $request->TempatBerangkat,
                'tempat_tujuan'     => $request->TempatTujuan
            ]);
            Kabid::create([
                'sppd_id' => $sppdid->id,
                'nama_kabid' => $kabid->nama,
                'nip' => $kabid->nip,
                'jabatan' => $kabid->jabatan->jabatan
            ]);
            Angkutan::create([
                'sppd_id' => $sppdid->id
            ]);
            Keterangan::create([
                'sppd_id' => $sppdid->id
            ]);
            Bbsppd::create([
                'sppd_id' => $sppdid->id
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
        } else {
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
        if ($this->CekUserSppd($user, $sppd)) {
            $sppd = $sppd->first();
            $sppd->update([
                'tgl_surat' => now()
            ]);
            return view('sppd.users.sppdoption', compact('user', 'sppd'));
        } else {
            return view('sppd.users.akses', compact('user'));
        }
    }
    public static function CekUserSppd($id_user, $id_sppd)
    {
        foreach ($id_sppd as $sppd_data) {
            foreach ($sppd_data->user as $user) {
                if (($user->id == $id_user->id || $id_user->role == 'Admin')) {
                    return true;
                }
            }
        }
    }
    public function editsppd($id)
    {
        $user = User::getUser();
        $sppd = Sppd::getSppd($id);
        if ($this->CekUserSppd($user, $sppd)) {
            $sppd = $sppd->first();
            $lama = Sppd::selisih($sppd->tgl_pergi, $sppd->tgl_pergi);
            return view('sppd.users.edit', compact('user', 'sppd', 'lama'));
        } else {
            return view('sppd.users.akses', compact('user'));
        }
    }
    public function addfollower($id)
    {
        $user = User::getUser();
        $all_user = User::get();
        $sppduser = Sppd_user::orderBy('created_at', 'ASC')->where('sppd_id', $id)->get();
        $sppduserpegawai = User::select()->get();
        $sppd = Sppd::getSppd($id);
        if ($this->CekUserSppd($user, $sppd)) {
            $sppd = $sppd->first();
            return view('sppd.users.addfollower', compact('user', 'all_user', 'sppd', 'sppduser', 'sppduserpegawai'));
        } else {
            return view('sppd.users.akses', compact('user'));
        }
    }
    public function storeaddfollower(Request $request, $id)
    {
        if ($request->nip != null) {
            User::where('nip', $request->nip)->first()->sppd()->attach($id);
            session()->flash('Success', 'Berhasil Menambah Pengikut');
            return back();
        } else {
            session()->flash('Failed', 'Gagal Menambah Pengikut');
            return back();
        }
    }
    public function removefollower($sppd_id, $users_id)
    {
        Sppd_user::select()->where('sppd_id', $sppd_id)->where('users_id', $users_id)->delete();
        session()->flash('Success', 'Berhasil Menghapus Pengikut');
        return back();
    }
    public function angkutan($id)
    {
        $user = User::getUser();
        $sppd = Sppd::getSppd($id);
        if ($this->CekUserSppd($user, $sppd)) {
            $tempatb = User::enum_get('tempat', 'tempat_berangkat');
            $sppd = $sppd->first();
            return view('sppd.users.angkutan', compact('user', 'sppd', 'tempatb'));
        } else {
            return view('sppd.users.akses', compact('user'));
        }
    }
    public function storeangkutan($id, Request $request)
    {
        $angkutan = Angkutan::where('sppd_id', $id)->first();
        $angkutan->update([
            'angkutan' => $request->Angkutan
        ]);
        session()->flash('Success', 'Berhasil Set Angkutan');
        return back();
    }
    public function storejenis($id, Request $request)
    {
        $angkutan = Angkutan::where('sppd_id', $id)->first();
        $angkutan->update([
            'jenis' => $request->Jenis
        ]);
        session()->flash('Success', 'Berhasil Set Jenis Kendaraan');
        return back();
    }
    public function storeplat($id, Request $request)
    {
        $angkutan = Angkutan::where('sppd_id', $id)->first();
        $angkutan->update([
            'plat' => $request->Plat
        ]);
        session()->flash('Success', 'Berhasil Set Nomor Plat');
        return back();
    }
    public function storeumum($id, Request $request)
    {
        $angkutan = Angkutan::where('sppd_id', $id)->first();
        $angkutan->update([
            'angkutan_umum' => $request->Umum
        ]);
        session()->flash('Success', 'Berhasil Set Kendaraan Umum');
        return back();
    }
    public function storesewa($id, Request $request)
    {
        $angkutan = Angkutan::where('sppd_id', $id)->first();
        $angkutan->update([
            'sewa' => $request->Sewa
        ]);
        session()->flash('Success', 'Berhasil Set Kendaraan Sewa');
        return back();
    }
    public function bebanbiaya($id)
    {
        $user = User::getUser();
        $sppd = Sppd::getSppd($id);
        $skpd = Skpd::get();
        $program = Program::get();
        $kegiatan = Kegiatan::get();
        $rekening = Rekening::get();
        $bbsppd = Bbsppd::get()->where('sppd_id',$id)->first();
        if ($this->CekUserSppd($user, $sppd)) {
            $sppd = $sppd->first();
            return view('sppd.users.bebanbiaya', compact('user', 'sppd','skpd','program','kegiatan','rekening','bbsppd'));
        } else {
            return view('sppd.users.akses', compact('user'));
        }
    }
    public function storebebanbiaya($id, Request $request)
    {
        $bbsppd = Bbsppd::where('sppd_id', $id)->first();
        $bbsppd->update([
            'skpd' => $request->SKPD,
            'program' => $request->Program,
            'kegiatan' => $request->Kegiatan,
            'rekening' => $request->KodeRekening
        ]);
        session()->flash('Success', 'Berhasil Set Kendaraan Sewa');
        return back();
    }
    public function selesai($id)
    {
        return Redirect(Route('SPPD').'/'.$id.'/SPPD');
    }

    public function keterangan($id)
    {
        $user = User::getUser();
        $sppd = Sppd::getSppd($id);
        if ($this->CekUserSppd($user, $sppd)) {
            $sppd = $sppd->first();
            return view('sppd.users.keterangan', compact('user', 'sppd'));
        } else {
            return view('sppd.users.akses', compact('user'));
        }
    }
    public function storeketerangan($id, Request $request)
    {
        $keterangan = Keterangan::where('sppd_id', $id)->first();
        $keterangan->update([
            'keterangan' => $request->Keterangan
        ]);
        session()->flash('Success', 'Berhasil Set Keterangan');
        return back();
    }
    public function deletesppd($id)
    {
        $sppd = Sppd::select('*')->where('id', $id)->first();
        Sppd::destroy($sppd);
        session()->flash('Success', 'Berhasil Menghapus SPPD');
        return back();
    }
}
