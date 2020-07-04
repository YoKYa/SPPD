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
    
    Route::get('/Users', 'UsersController@show')->name('Users');
    Route::get('/Users/CreateUser', 'UsersController@create')->name('Users/CreateUser');
    Route::post('/Users/CreateUser', 'UsersController@store');
    Route::get('/Users/Profile', 'UsersController@profile')->name('Users/Profile');

});
