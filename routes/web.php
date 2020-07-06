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
    Route::get('/Pegawai', 'UsersController@pegawai')->name('Pegawai');
    Route::get('/Pegawai/{nip}', 'UsersController@nip');

});

Route::prefix('Users')->middleware('auth')->group(function(){
    Route::get('Profile', 'UsersController@profile')->name('Users/Profile');
    Route::delete('Profile/Delete', 'UsersController@destroy');
    Route::get('Profile/ChangePassword', 'UsersController@changepassword')->name('Users/Profile/ChangePassword');
    Route::patch('Profile/ChangePassword', 'UsersController@storepass');
    Route::get('Profile/Edit', 'UsersController@showedit')->name('Users/Profile/Edit');
    Route::patch('Profile/Edit', 'UsersController@storeedit');
});

Route::prefix('Admin')->middleware('auth')->group(function(){
    Route::get('Show', 'UsersController@show')->name('Admin/Show');
    Route::get('CreateUser', 'UsersController@create')->name('Admin/CreateUser');
    Route::post('CreateUser', 'UsersController@store');
});
