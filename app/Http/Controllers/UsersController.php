<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Auth\User;
use App\Models\Golongan;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Session\Session;
use Symfony\Component\VarDumper\Caster\EnumStub;

class UsersController extends Controller
{
    // Auth
    public function __construct(){
        $this->middleware('auth');
    }
    // Dashboard
    public function dashboard(){   
        return view('dashboard',['user'=>User::getUser()]);
    }
    // Pegawai & show Pegawai
    public function pegawai(Request $request){
        if ($request->search) {
            $users = User::orderBy('nama','asc')->where('cek',1)->where('nama','LIKE','%'.$request->search.'%')->orwhere('nip','LIKE','%'.$request->search.'%')->paginate(5);
        }else {
            $users = User::orderBy('nama','asc')->where('cek',1)->paginate(5);
        }
        return view('users.pegawai.pegawai', ['users'=>$users], ['user'=>User::getUser()]);
    }
    public function nip($nip){
        $user_pegawai = User::select('*')->where('nip',$nip)->first();
        return view('users.pegawai.nip', ['user'=>User::getUser()], ['user_pegawai'=>$user_pegawai]); 
    }

    // Administrator Show Users, Create User , Store User
    public function show(Request $request){
        if ($request->search) {
            $users = User::orderBy('nama','asc')->where('nama','LIKE','%'.$request->search.'%')->orwhere('nip','LIKE','%'.$request->search.'%')->paginate(5);
        }else {
            $users = User::orderBy('nama','asc')->paginate(5);    
        }
        return view('users.admin.users',['users'=>$users], ['user'=>User::getUser()]);
    }
    public function create(){
        $golongan = User::enum_get('golongan','golongan');
        return view('users.admin.create', ['golongan'=>$golongan], ['user'=>User::getUser()]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'Nama'      => 'required',
            'NIP'       =>  'required|min:10|numeric',
            'Password'  =>  'required|min:5', 
            'Role'      =>  'required|numeric'     

        ]);
        $Cek = User::select('nip')->where('nip',$request->NIP)->count();

        // Name Check
        if ($request->Gelar == null) {
            $Nama = $request->Nama;
        }else {
            $Nama = $request->Nama . ', ' . $request->Gelar;
        }

        if ($Cek != True) {
            User::create([
                'nama'      => $Nama,
                'nip'       => $request->NIP,
                'alamat'    => $request->Alamat,
                'password'  => Hash::make($request->Password),
                'tgllahir'  => $request->TglLahir,
                'created_at'=> now(),
                'role'      => $request->Role
            ]);
            $user_temp = User::select('id')->where('nip',$request->NIP)->first();
            Jabatan::create([
                'user_id' => $user_temp->id,
                'jabatan' => $request->Jabatan
            ]);
            Golongan::create([
                'user_id' => $user_temp->id,
                'golongan' => $request->Golongan
            ]);
            session()->flash('Success', 'Berhasil Membuat User');
        }else {
            session()->flash('Failed', 'Gagal Membuat User (NIP Sudah Dipakai)');
        }
        return redirect(Route('Admin/Show'));
    }
    public function showuser($nip){
        $user_pegawai = User::select('*')->where('nip',$nip)->first();
        return view('users.admin.profile', ['user'=>User::getUser()], ['user_pegawai'=>$user_pegawai]); 
    }
    public function changepass($nip){
        $user_pegawai = User::select('*')->where('nip',$nip)->first();
        return view('users.admin.changepassword',['user'=>User::getUser()],['user_pegawai'=>$user_pegawai]);
    }
    public function storechangepass(Request $request,$nip){
        $user_pegawai = User::select('*')->where('nip',$nip)->first();
        $this->validate($request,[
            'password'              =>  'required|min:5',
            'password_confirmation' =>  'required|min:5', 
        ]);
        $pass    = $request->password;
        $passkon = $request->password_confirmation;
        $user = $user_pegawai;
        if ($pass == $passkon) {
            $user->update([
                'password'  => Hash::make($request->password),
                'updated_at'=> now()
            ]);
            session()->flash('Success', '(Berhasil) Mengganti Password User '.$user->nama);
            return redirect(Route('Admin/Show'));
        }else{
            session()->flash('Failed', '(Gagal) Password dan Password Konfirmasi Tidak Sama');
            return redirect(Route('Users/Profile/ChangePassword'));
        }
    }
    public function showedituser($nip){
        $user_pegawai = User::select('*')->where('nip',$nip)->first();
        $golongan = User::enum_get('golongan','golongan');
        return view('users.admin.edit', ['user'=>User::getUser(), 'golongan'=>$golongan],['user_pegawai'=>$user_pegawai]);
    }
    public function storeedituser(Request $request, $nip){
        $user_pegawai = User::select('*')->where('nip',$nip)->first();
        $this->validate($request,[
            'Nama'      => 'required',
            'NIP'       =>  'required|min:10|numeric'
        ]);
        $user = User::select()->where('id', $user_pegawai->id)->first();
        $user->update([
            'nama'      => $request->Nama,
            'nip'       => $request->NIP,
            'alamat'    => $request->Alamat,    
            'tgllahir'  => $request->TglLahir,
            'updated_at'=> now()
        ]);
        $user->jabatan->update([
            'jabatan' => $request->Jabatan
        ]);
        $user->golongan->update([
            'golongan' => $request->Golongan
        ]);
        session()->flash('Success', '(Berhasil) Update User '.$user_pegawai->nama);
        return redirect(Route('Admin/Show'));
    }
    public function deluser($nip){
        $user_pegawai = User::select('*')->where('nip',$nip)->first();
        $this->destroy($user_pegawai);
        session()->flash('Success', 'Berhasil Menghapus User');
        return Redirect(Route('Admin/Show'));
    }

    // Show Profile, Change Password, Store Password, Show Edit Profile
    public function profile(){
        return view('users.profile.profile', ['user'=>User::getUser()]); 
    }
    public function changepassword(){
        return view('users.profile.changepassword',['user'=>User::getUser()]);
    }
    public function storepass(Request $request){
        $this->validate($request,[
            'password'              =>  'required|min:5',
            'password_confirmation' =>  'required|min:5', 
        ]);
        $pass    = $request->password;
        $passkon = $request->password_confirmation;
        $user = User::getUser();
        if ($pass == $passkon) {
            $user->update([
                'password'  => Hash::make($request->password),
                'updated_at'=> now()
            ]);
            session()->flash('Success', '(Berhasil) Mengganti Password');
            return redirect(Route('Dashboard'));
        }else{
            session()->flash('Failed', '(Gagal) Password dan Password Konfirmasi Tidak Sama');
            return redirect(Route('Users/Profile/ChangePassword'));
        }
    }
    public function showedit(){
        $golongan = User::enum_get('golongan','golongan');
        return view('users.profile.edit', ['user'=>User::getUser(), 'golongan'=>$golongan]);
    }
    public function storeedit(Request $request){
        $this->validate($request,[
            'Nama'      => 'required',
            'NIP'       =>  'required|min:10|numeric'
        ]);
        $user = User::select()->where('id', Auth::user()->id)->first();
        $user->update([
            'nama'      => $request->Nama,
            'nip'       => $request->NIP,
            'alamat'    => $request->Alamat,    
            'tgllahir'  => $request->TglLahir,
            'updated_at'=> now()
        ]);
        $user->jabatan->update([
            'jabatan' => $request->Jabatan
        ]);
        $user->golongan->update([
            'golongan' => $request->Golongan
        ]);
        session()->flash('Success', '(Berhasil) Update Profil');
        return redirect(Route('Dashboard'));
    }
    public function del(){
        $this->destroy(User::getUser());
        return Redirect(Route('Dashboard'));
    }
    

    
    public function destroy($user){
        $user->delete();
    }
}
