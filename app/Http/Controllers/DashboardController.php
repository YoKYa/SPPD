<?php

namespace App\Http\Controllers;

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
        return view('dashboard', ['role' => $role, 'path'=>$path]);
    }
    public function users(Request $request)
    {
        $path = $request->path();
        $role = Auth::user()->role;
        $users = Auth::user()->orderBy('nama', 'asc')->paginate(5);
        return view('users',['path'=>$path, 'role'=>$role], ['users'=>$users]);
    }
}
