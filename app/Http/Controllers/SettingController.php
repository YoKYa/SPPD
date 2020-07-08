<?php

namespace App\Http\Controllers;

use App\Models\Auth\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('users.admin.setting.setting',['user'=>User::getUser()]);
    }
}
