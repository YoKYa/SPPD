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
Auth::routes(['register' => false]);


//Grup yang digunakan Autentikasi
Route::group(['middleware' => 'auth'], function () {
    Route::get('/Dashboard', 'UsersController@dashboard')->name('Dashboard');
    Route::get('/Pegawai', 'UsersController@pegawai')->name('Pegawai');
    Route::get('/Pegawai/{nip}', 'UsersController@nip');
});

Route::prefix('Users')->middleware('auth')->group(function () {
    Route::get('Profile', 'UsersController@profile')->name('Users/Profile');
    Route::delete('Profile/Delete', 'UsersController@del');
    Route::get('Profile/ChangePassword', 'UsersController@changepassword')->name('Users/Profile/ChangePassword');
    Route::patch('Profile/ChangePassword', 'UsersController@storepass');
    Route::get('Profile/Edit', 'UsersController@showedit')->name('Users/Profile/Edit');
    Route::patch('Profile/Edit', 'UsersController@storeedit');
});

Route::prefix('Admin')->middleware('auth')->group(function () {
    Route::get('Show', 'UsersController@show')->name('Admin/Show');
    Route::get('CreateUser', 'UsersController@create')->name('Admin/CreateUser');
    Route::post('CreateUser', 'UsersController@store');
    Route::get('Show/{nip}', 'UsersController@showuser');
    Route::get('Show/{nip}/ChangePassword', 'UsersController@changepass');
    Route::patch('Show/{nip}/ChangePassword', 'UsersController@storechangepass');
    Route::get('Show/{nip}/Edit', 'UsersController@showedituser');
    Route::patch('Show/{nip}/Edit', 'UsersController@storeedituser');
    Route::delete('Show/{nip}/Delete', 'UsersController@deluser');

    Route::get('/Setting', 'SettingController@index')->name('Setting');
    Route::patch('/Setting/setnomorsurat', 'SettingController@setnomorsurat')->name('SetNomorSurat');
    Route::patch('/Setting/settahunsurat', 'SettingController@settahunsurat')->name('SetTahunSurat');
    Route::get('/Setting/dasarsurat', 'SettingController@dasarsurat')->name('DasarSurat');
    Route::patch('/Setting/bidang', 'SettingController@SetBidang')->name('SetBidang');
    Route::get('/Setting/SKPD', 'SettingController@SKPD')->name('SKPD');
    Route::get('/Setting/Program', 'SettingController@Program')->name('Program');
    Route::get('/Setting/Kegiatan', 'SettingController@Kegiatan')->name('Kegiatan');
    Route::get('/Setting/Rekening', 'SettingController@Rekening')->name('Rekening');


    Route::post('/Setting/dasarsurat', 'SettingController@tambahdasarsurat');
    Route::get('/Setting/dasarsurat/{id}/edit', 'SettingController@editdasarsurat');
    Route::patch('/Setting/dasarsurat/{id}/edit', 'SettingController@storeeditdasarsurat');
    Route::delete('/Setting/dasarsurat/{id}/delete', 'SettingController@deldasarsurat');

    Route::post('/Setting/SKPD', 'SettingController@tambahskpd');
    Route::get('/Setting/SKPD/{id}/edit', 'SettingController@editskpd');
    Route::patch('/Setting/SKPD/{id}/edit', 'SettingController@storeeditskpd');
    Route::delete('/Setting/SKPD/{id}/delete', 'SettingController@delskpd');

    Route::post('/Setting/Program', 'SettingController@tambahProgram');
    Route::get('/Setting/Program/{id}/edit', 'SettingController@editProgram');
    Route::patch('/Setting/Program/{id}/edit', 'SettingController@storeeditProgram');
    Route::delete('/Setting/Program/{id}/delete', 'SettingController@delProgram');

    Route::post('/Setting/Kegiatan', 'SettingController@tambahKegiatan');
    Route::get('/Setting/Kegiatan/{id}/edit', 'SettingController@editKegiatan');
    Route::patch('/Setting/Kegiatan/{id}/edit', 'SettingController@storeeditKegiatan');
    Route::delete('/Setting/Kegiatan/{id}/delete', 'SettingController@delKegiatan');

    Route::post('/Setting/Rekening', 'SettingController@tambahRekening');
    Route::get('/Setting/Rekening/{id}/edit', 'SettingController@editRekening');
    Route::patch('/Setting/Rekening/{id}/edit', 'SettingController@storeeditRekening');
    Route::delete('/Setting/Rekening/{id}/delete', 'SettingController@delRekening');

    Route::get('/SPPD', 'AdminController@datasppd')->name('AdminSPPD');
});

Route::prefix('SPPD')->middleware('auth')->group(function () {
    Route::get('/', 'SPPDController@index')->name('SPPD');
    Route::get('/Entry', 'SPPDController@entry')->name('EntrySPPD');
    Route::post('/Entry', 'SPPDController@storeentry');
    Route::get('{id}/add', 'SPPDController@addfollower');
    Route::post('{id}/add', 'SPPDController@storeaddfollower');
    Route::get('{id}/SPPD/', 'SPPDController@showsppd');
    Route::get('{id}/edit', 'SPPDController@editsppd');
    Route::delete('{id}/delete', 'SPPDController@deletesppd');
    

    // Angkutan
    Route::get('{id}/angkutan', 'SPPDController@angkutan');
    Route::patch('{id}/angkutan', 'SPPDController@storeangkutan');
    Route::patch('{id}/jenis', 'SPPDController@storejenis');
    Route::patch('{id}/plat', 'SPPDController@storeplat');
    Route::patch('{id}/umum', 'SPPDController@storeumum');
    Route::patch('{id}/sewa', 'SPPDController@storesewa');

    // Beban Biaya
    Route::get('{id}/bebanbiaya', 'SPPDController@bebanbiaya');
    Route::patch('{id}/bebanbiaya', 'SPPDController@storebebanbiaya');

    // Keterangan
    Route::get('{id}/keterangan', 'SPPDController@keterangan');
    Route::patch('{id}/keterangan', 'SPPDController@storeketerangan');

    Route::get('{id}/selesai', 'SPPDController@selesai');

    Route::delete('{sppd_id}/{users_id}/delete', 'SPPDController@removefollower');
});

Route::prefix('Cetak')->middleware('auth')->group(function () {
    Route::get('/SPT', 'CetakController@index')->name('CetakSPT');
    Route::get('/SPPD', 'CetakController@index')->name('CetakSPPD');
    Route::get('/KWITANSI', 'CetakController@kwitansi')->name('CetakKWITANSI');

    Route::get('/SPPD/{id}', 'CetakController@SPPD');
    Route::get('/SPT/{id}', 'CetakController@SPT');
    Route::get('/KWITANSI/{id}', 'CetakController@kwitansi');
});
