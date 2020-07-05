
@extends('layouts.app')

@section('title',  $path )
@section('content')
@if ($role != 'Admin')
<div class="container-fluid" style="font-size: 20px">
    {{-- Breadcrump --}}
    @include('layouts.breadcrump')
    <div class="row row-cols-10 shadow rounded-lg p-3 justify-content-center m-0" style="background-color: rgb(0, 183, 255)">
        <div class="col-3">
            {{-- Navigasi Menu --}}
            @include('layouts.nav')
        </div>
        <div class="col-9">
            {{-- Tombol Petunjuk --}}
            @include('layouts.help')
            
            {{-- Bagian Isi --}}
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent" @if ($role == 'Admin') hidden @endif>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="text-center">
                            <h5>Maaf Anda Tidak Punya akses untuk halaman ini <br>
                            <a href="{{ Route('Dashboard') }}">Klik Disini</a> <br>
                            Untuk Kembali</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container-fluid" style="font-size: 20px">
    {{-- Breadcrump --}}
    @include('layouts.breadcrump')
    <div class="row row-cols-10 shadow rounded-lg p-3 justify-content-center m-0" style="background-color: rgb(0, 183, 255)">
        <div class="col-3">
            {{-- Navigasi Menu --}}
            @include('layouts.nav')
        </div>
        <div class="col-9">
            {{-- Tombol Petunjuk --}}
            @include('layouts.help')
            
            {{-- Bagian Isi --}}
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent" @if ($role != 'Admin') hidden @endif>
                <h3 class="text-center">Membuat User</h3>
                <br>
                <form method="POST" action="/Users/CreateUser">
                    @csrf
                    <div class="form-group row d-flex align-items-center">
                        <label for="NIP" class="col-sm-3 col-form-label">NIP <span class="text-danger">*</span></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8 ">
                            <input type="number" class="form-control justify-content-center @error('NIP') is-invalid @enderror" id="NIP" placeholder="Ketik NIP..." name="NIP" >
                        </div>
                    </div>
                    
                    <div class="form-group row d-flex align-items-center">
                        <label for="Password" class="col-sm-3 col-form-label">Password<span class="text-danger">*</span></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="password" class="form-control justify-content-center @error('Password') is-invalid @enderror" id="Password" placeholder="Ketik Password..." name="Password" data-toggle="Password">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Nama" class="col-sm-3 col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control justify-content-center @error('Nama') is-invalid @enderror" id="Nama" placeholder="Ketik Nama Lengkap..." name="Nama">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Gelar" class="col-sm-3 col-form-label">Gelar</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control justify-content-center" id="Gelar" placeholder="Ketik Gelar..." name="Gelar">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Alamat" class="col-sm-3 col-form-label">Alamat Lengkap</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <textarea class="form-control justify-content-center" id="Alamat" placeholder="Ketik Alamat Lengkap..." name="Alamat"></textarea>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="TglLahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="date" class="form-control justify-content-center" id="TglLahir" placeholder="Ketik Tanggal Lahir..." name="TglLahir">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Golongan" class="col-sm-3 col-form-label">Golongan</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <select class="custom-select" id="Golongan" name="Golongan">
                                <option selected disabled>Pilih...</option>
                                <option value="1">Juru Muda (I/a)</option>
                                <option value="2">Juru Muda Tingkat I (I/b)</option>
                                <option value="3">Juru (I/c)</option>
                                <option value="4">Juru Tingkat I (I/d)</option>
                                <option value="5">Pengatur Muda (II/a)</option>
                                <option value="6">Pengatur Muda Tingkat I (II/b)</option>
                                <option value="7">Pengatur (II/c)</option>
                                <option value="8">Pengatur Tingkat I (II/d)</option>
                                <option value="9">Penata Muda (III/a)</option>
                                <option value="10">Penata Muda Tingkat I (III/b)</option>
                                <option value="11">Penata (III/c)</option>
                                <option value="12">Penata Tingkat I (III/d)</option>
                                <option value="13">Pembina (IV/a)</option>
                                <option value="13">Pembina Tingkat I (IV/b)</option>
                                <option value="13">Pembina Utama Muda (IV/c)</option>
                                <option value="13">Pembina Utama Madya (IV/d)</option>
                                <option value="13">Pembina Utama (IV/e)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <select class="custom-select" id="Jabatan" name="Jabatan">
                                <option selected disabled>Pilih...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Role" class="col-sm-3 col-form-label">Sebagai<span class="text-danger">*</span></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <select class="custom-select @error('Role') is-invalid @enderror" id="Role" name="Role">
                                <option selected disabled>Pilih...</option>
                                <option value="1">Admin</option>
                                <option value="2">Kepala Bidang</option>
                                <option value="3">Pegawai</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label><span class="text-danger col-sm-3 col-form-label">*</span>Harus di isi.</label>
                    </div>
                    <div class="form-group text-left">
                        <a href="{{ Route('Dashboard') }}" class="btn btn-danger btn-md">Batal</a>
                        <button type="submit" class="btn btn-primary btn-md">Buat User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@section('script-down')
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endsection

