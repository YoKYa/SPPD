<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\LoginController;

//Login SPPD
Route::get('/', function () {
    return redirect('/login');
});

//Autentikasi Login di false supaya tidak keluar register
Auth::routes(['register'=>false]);


//Grup yang digunakan Autentikasi
Route::group(['middleware' => 'auth'], function () {
    Route::get('/Dashboard', 'DashboardController@index')->name('Dashboard');
    Route::get('/Users', 'DashboardController@users')->name('Users');
});
