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
        return view('dashboard',['user'=>$this->getUser()]);
    }
    // Pegawai & show Pegawai
    public function pegawai(Request $request){
        if ($request->search) {
            $users = User::orderBy('nama','asc')->where('cek',1)->where('nama','LIKE','%'.$request->search.'%')->orwhere('nip','LIKE','%'.$request->search.'%')->paginate(5);
        }else {
            $users = User::orderBy('nama','asc')->where('cek',1)->paginate(5);
        }
        return view('users.pegawai', ['users'=>$users], ['user'=>$this->getUser()]);
    }
    public function nip($nip){
        $user_pegawai = User::select('*')->where('nip',$nip)->first();
        return view('users.nip', ['user'=>$this->getUser()], ['user_pegawai'=>$user_pegawai]); 
    }

    // Administrator Show Users, Create User , Store User
    public function show(Request $request){
        if ($request->search) {
            $users = User::orderBy('nama','asc')->where('nama','LIKE','%'.$request->search.'%')->orwhere('nip','LIKE','%'.$request->search.'%')->paginate(5);
        }else {
            $users = User::orderBy('nama','asc')->paginate(5);    
        }
        return view('users.users',['users'=>$users], ['user'=>$this->getUser()]);
    }
    public function create(Request $request){
        $golongan = User::enum_get('golongan','golongan');
        return view('users.create', ['golongan'=>$golongan], ['user'=>$this->getUser()]);
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

    // Show Profile, Change Password, Store Password, Show Edit Profile
    public function profile(){
        return view('users.profile', ['user'=>$this->getUser()]); 
    }
    public function changepassword(Request $request){
        return view('users.changepassword',['user'=>$this->getUser()]);
    }
    public function storepass(Request $request){
        $this->validate($request,[
            'password'              =>  'required|min:5',
            'password_confirmation' =>  'required|min:5', 
        ]);
        $pass    = $request->password;
        $passkon = $request->password_confirmation;
        $user = $this->getUser();
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
    public function showedit()
    {
        $golongan = User::enum_get('golongan','golongan');
        return view('users.edit', ['user'=>$this->getUser(), 'golongan'=>$golongan]);
    }
    public function storeedit(Request $request)
    {
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
        session()->flash('Failed', '(Gagal) Update Profil');
        return redirect(Route('Users/Profile/ChangePassword'));
    }
    public function destroy(Request $request)
    {

        User::where('id', Auth::user()->id)->delete();
        return Redirect(Route('Dashboard'));
    }
    public function getUser()
    {
        return User::get()->where('id',Auth::user()->id)->first();
    }
}
