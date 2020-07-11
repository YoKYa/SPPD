<?php

namespace App\Http\Controllers;

use App\Models\Auth\User;
use App\Models\Dasar;
use App\Models\Nosurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    public function index()
    {
        $surat = Nosurat::select('*')->first();
        return view('users.admin.setting.setting', ['user' => User::getUser()], ['surat'=>$surat]);
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
}
