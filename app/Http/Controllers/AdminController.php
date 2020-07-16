<?php

namespace App\Http\Controllers;

use App\Models\Auth\User;
use App\Models\Sppd_user;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function datasppd()
    {
        $user = User::getUser();
        $sppd = Sppd_user::orderBy('created_at', 'desc')->paginate(5);
        return view('sppd.admin.sppd', compact('user','sppd'));
    }
}
