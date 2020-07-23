<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Auth\User;
use App\Models\Dasar;
use App\Models\Nosurat;
use App\Models\Program;
use App\Models\Skpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    public function index()
    {
        $surat = Nosurat::select('*')->first();
        $bidang = Bidang::first();
        $user = User::getUser();
        return view('users.admin.setting.setting', compact('surat','bidang','user'));
    }
    public function setnomorsurat(Request $request)
    {
        if ($request->NomorSurat == null) {
            session()->flash('Failed', '(Gagal) Set Nomor Surat');
        }else {
            if(Nosurat::first()->update([
                'no_surat' => $request->NomorSurat
            ])){
                session()->flash('Success', '(Berhasil) Set Nomor Surat');
            }else{
                session()->flash('Failed', '(Gagal) Set Nomor Surat');
            }
        } 
        return redirect(Route('Setting'));
        
    }
    public function settahunsurat(Request $request)
    {
        if ($request->TahunSurat == null) {
            session()->flash('Failed', '(Gagal) Set Tahun Surat');
        }else {
            if(Nosurat::first()->update([
                'tahun_surat' => $request->TahunSurat
            ])){
                session()->flash('Success', '(Berhasil) Set Tahun Surat');
            }else{
                session()->flash('Failed', '(Gagal) Set Tahun Surat');
            }
        }
        
        return redirect(Route('Setting'));
        
    }
    public function dasarsurat()
    {
        $dasar = Dasar::get();
        return view('users.admin.setting.dasar', ['user' => User::getUser()], ['dasar'=>$dasar]);
    }
    public function editdasarsurat($id)
    {
        $dasar = Dasar::get()->where('id', $id)->first();
        return view('users.admin.setting.edit', ['user' => User::getUser()], ['dasar'=>$dasar]);
    }
    public function storeeditdasarsurat(Request $request,$id)
    {
        if ($request->DasarSurat == null) {
            session()->flash('Failed', '(Gagal) Edit');
        }else {
            if(Dasar::where('id',$id)->first()->update([
                'dasar' => $request->DasarSurat
            ])){
                session()->flash('Success', '(Berhasil) Edit Dasar Surat');
            }else{
                session()->flash('Failed', '(Gagal) Edit Dasar Surat');
            }
        }
        return redirect(Route('DasarSurat'));
    }
    public function deldasarsurat($id)
    {
        if (Dasar::where('id',$id)->first()->delete()) {
            session()->flash('Success', '(Berhasil) Menghapus Dasar');
        }else {
            session()->flash('Failed', '(Gagal) Menghapus Dasar');
        }
        return Redirect(Route('DasarSurat'));
    }
    public function tambahdasarsurat()
    {
        Dasar::create([
            'dasar' => ''
        ]);
        session()->flash('Success', '(Berhasil) Menambah Dasar');
        return Redirect(Route('DasarSurat'));
    }
    public function SetBidang(Request $request)
    {
        if ($request->Nama_Bidang == null) {
            session()->flash('Failed', '(Gagal) Edit');
        }else{
            Bidang::first()->update([
                'nama_bidang' => $request->Nama_Bidang
            ]);
            session()->flash('Success', '(Berhasil) Edit Nama Bidang');
        }
        return back();
    }
    public function SKPD()
    {
        $skpd = Skpd::get();
        $user = User::getUser();
        return view('users.admin.setting.skpd',compact('skpd','user'));
    }
    public function tambahskpd()
    {
        Skpd::create([
            'skpd' => ''
        ]);
        session()->flash('Success', '(Berhasil) Menambah SKPD');
        return Redirect(Route('SKPD'));
    }
    public function editskpd($id)
    {
        $skpd = Skpd::get()->where('id', $id)->first();
        $user = User::getUser();
        return view('users.admin.setting.skpdedit', compact('skpd','user'));
    }
    public function storeeditskpd(Request $request,$id)
    {
        if ($request->SKPD == null) {
            session()->flash('Failed', '(Gagal) Edit');
        }else {
            if(Skpd::where('id',$id)->first()->update([
                'skpd' => $request->SKPD
            ])){
                session()->flash('Success', '(Berhasil) Edit SKPD');
            }else{
                session()->flash('Failed', '(Gagal) Edit SKPD');
            }
        }
        return redirect(Route('SKPD'));
    }
    public function delskpd($id)
    {
        if (Skpd::where('id',$id)->first()->delete()) {
            session()->flash('Success', '(Berhasil) Menghapus SKPD');
        }else {
            session()->flash('Failed', '(Gagal) Menghapus SKPD');
        }
        return Redirect(Route('SKPD'));
    }
    public function Program()
    {
        $program = Program::get();
        $user = User::getUser();
        return view('users.admin.setting.program',compact('program','user'));
    }
    public function tambahProgram()
    {
        Program::create([
            'program' => ''
        ]);
        session()->flash('Success', '(Berhasil) Menambah Program');
        return Redirect(Route('Program'));
    }
    public function editProgram($id)
    {
        $program = Program::get()->where('id', $id)->first();
        $user = User::getUser();
        return view('users.admin.setting.programedit', compact('program','user'));
    }
    public function storeeditProgram(Request $request,$id)
    {
        if ($request->Program == null) {
            session()->flash('Failed', '(Gagal) Edit');
        }else {
            if(Program::where('id',$id)->first()->update([
                'program' => $request->Program
            ])){
                session()->flash('Success', '(Berhasil) Edit Program');
            }else{
                session()->flash('Failed', '(Gagal) Edit Program');
            }
        }
        return redirect(Route('Program'));
    }
    public function delProgram($id)
    {
        if (Program::where('id',$id)->first()->delete()) {
            session()->flash('Success', '(Berhasil) Menghapus Program');
        }else {
            session()->flash('Failed', '(Gagal) Menghapus Program');
        }
        return Redirect(Route('Program'));
    }
}
