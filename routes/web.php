<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\LoginController;
use Illuminate\Support\Facades\Redirect;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes(['register' => false]);

Route::get('/Dashboard', 'HomeController@index')->name('home');

Route::get('/Test', function () {
    return view('test');
});
