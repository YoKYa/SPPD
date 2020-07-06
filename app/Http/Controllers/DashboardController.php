<?php

namespace App\Http\Controllers;

use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use function GuzzleHttp\Promise\all;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index(Request $request)
    {   
        $path = $request->path();
        $role = Auth::user()->role;
        $nama = Auth::user()->nama;
        $users = User::get();
        return view('dashboard', ['role' => $role, 'path'=>$path, 'nama'=>$nama],['users'=>$users]);
    }
}
