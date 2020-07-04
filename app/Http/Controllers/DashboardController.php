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
        $user = Auth::user()->nama;
        return view('dashboard', ['role' => $role, 'path'=>$path, 'nama'=>$user]);
    }
}
