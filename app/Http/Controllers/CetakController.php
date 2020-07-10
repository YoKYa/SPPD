<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function cetak()
    {
        return view('cetak.cetak');
    }
}
