<?php

namespace App\Http\Controllers;

use App\Models\Auth\User;
use App\Tempat;
use Illuminate\Http\Request;

class SPPDController extends Controller
{
    public function index()
    {
        return "SPPD";
    }
    public function entry()
    {
        $user = User::getUser();
        $tempatb = User::enum_get('tempat','tempat_berangkat');
        $kabid = User::select('nama')->where('role', 'Kepala Bidang')->first();
        return view('sppd.entry',compact('user','tempatb','kabid'));
    }

}
