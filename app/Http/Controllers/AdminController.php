<?php

namespace App\Http\Controllers;

use App\Models\Auth\User;
use App\Models\Sppd;
use App\Models\Sppd_user;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function datasppd()
    {
        $user = User::getUser();
        $sppd = sppd::orderBy('created_at','DESC')->paginate(5);
        return view('sppd.admin.sppd', compact('user','sppd'));
    }
}
