
@extends('layouts.app')

@section('title',  $path )
@section('content')
<div class="container" style="font-size: 20px">
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
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent">
                <h3 class="text-center">Profile</h3>
                <br>
                <div class="form-group row d-flex align-items-center">
                    <label for="NIP" class="col-sm-3 col-form-label">NIP </label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8 ">
                        <input type="number" class="form-control justify-content-center @error('NIP') is-invalid @enderror" readonly id="NIP" placeholder="Ketik NIP..." name="NIP" value="{{ $users->nip }}" >
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="Password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <a href="" class="btn btn-primary" id="Password" placeholder="Ketik Password..." name="Password" readonly> Ganti Password</a>
                    </div>
                </div>
                <hr>
                <div class="form-group row d-flex align-items-center">
                    <label for="Nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center @error('Nama') is-invalid @enderror" id="Nama" readonly placeholder="Ketik Nama Lengkap..." name="Nama" value="{{ $users->nama }}">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="Alamat" class="col-sm-3 col-form-label">Alamat Lengkap</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <textarea class="form-control justify-content-center" id="Alamat" readonly placeholder="Ketik Alamat Lengkap..." name="Alamat">{{ $users->alamat }}</textarea>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="TglLahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="date" class="form-control justify-content-center" id="TglLahir" placeholder="Ketik Tanggal Lahir..." name="TglLahir" readonly value="{{ $users->tgllahir }}">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="Golongan" class="col-sm-3 col-form-label">Golongan</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center" id="Golongan" readonly placeholder="Ketik Golongan..." name="Golongan" value="{{ $users->golongan }}">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="Jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center" id="Jabatan" readonly placeholder="Ketik Jabatan..." name="Jabatan" value="{{ $users->jabatan }}">
                    </div>
                </div>
                <hr>
                <div class="form-group row d-flex align-items-center">
                    <label for="Role" class="col-sm-3 col-form-label">Sebagai</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center" id="Role" readonly placeholder="Role..." name="Role" value="{{ $users->role }}">
                    </div>
                </div>
                <hr>
                <div class="form-group text-left">
                    <a href="{{ Route('Dashboard') }}" class="btn btn-danger btn-md">Kembali</a>
                    <a href=" {{-- Route('Users/Profile/Edit') --}} " class="btn btn-primary btn-md">Edit User</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script-down')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endsection

