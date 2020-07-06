<?php

namespace App\Http\Controllers;

use App\Models\Auth\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show(Request $request)
    {
        $path = $request->path();
        $role = Auth::user()->role;  
        if ($request->search) {
            $users = Auth::user()->where('nama','LIKE','%'.$request->search.'%')->orwhere('nip','LIKE','%'.$request->search.'%')->orderBy('nama', 'asc')->paginate(5);
        }else {
            $users = Auth::user()->orderBy('nama', 'asc')->paginate(5);    
        }
        return view('users.users',['path'=>$path, 'role'=>$role], ['users'=>$users]);
    }
    public function create(Request $request)
    {
        $path = $request->path();
        $role = Auth::user()->role;
        return view('users.create', ['path'=>$path, 'role'=>$role]);
    }
    public function store(Request $request)
    {
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
                'golongan'  => $request->Golongan,
                'jabatan'   => $request->Jabatan,
                'created_at'=> now(),
                'role'      => $request->Role
            ]);
            session()->flash('Success', 'Berhasil Membuat User');
        }else {
            session()->flash('Failed', 'Gagal Membuat User (NIP Sudah Dipakai)');
        }
        return redirect(Route('Admin/Show'));
    }
    public function profile(Request $request)
    {
        $path = $request->path();
        $role = Auth::user()->role;
        $user = Auth::user();
        return view('users.profile',['path'=>$path, 'role'=>$role], ['user'=>$user]); 
    }

    public function pegawai(Request $request)
    {
        $path = $request->path();
        $role = Auth::user()->role;
        if ($request->search) {
            $users = Auth::user()->where('cek',1)->where('nama','LIKE','%'.$request->search.'%')->orwhere('nip','LIKE','%'.$request->search.'%')->orderBy('nama', 'asc')->paginate(5);
        }else {
            $users = Auth::user()->where('cek',1)->orderBy('nama', 'asc')->paginate(5);    
        }
        
        return view('users.pegawai',['path'=>$path, 'role'=>$role], ['users'=>$users]);
    }
    public function nip(Request $request, $nip)
    {
        $path = $request->path();
        $role = Auth::user()->role;
        $user = User::select('*')->where('nip',$nip)->first();
        return view('users.nip',['path'=>$path, 'role'=>$role], ['user'=>$user]); 
    }
    public function changepassword(Request $request)
    {
        $path = $request->path();
        $role = Auth::user()->role;
        return view('users.changepassword',['path'=>$path, 'role'=>$role]);
    }
    public function storepass(Request $request)
    {
        $this->validate($request,[
            'password'              =>  'required|min:5',
            'password_confirmation' =>  'required|min:5', 
        ]);
        $pass    = $request->password;
        $passkon = $request->password_confirmation;
        $user = User::select()->where('id', Auth::user()->id)->first();
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
    public function showedit(Request $request)
    {
        $path = $request->path();
        $role = Auth::user()->role;
        $users = Auth::user();
        return view('users.edit', ['path'=>$path, 'role'=>$role], ['users'=>$users]);
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
            'golongan'  => $request->Golongan,
            'jabatan'   => $request->Jabatan,
            'updated_at'=> now()
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
}
