
@extends('layouts.app')

@section('title',  $path )
@section('content')
<div class="container-fluid" style="font-size: 20px">
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
                <h3 class="text-center">Pegawai</h3>
                <br>
                <div class="form-group row d-flex align-items-center">
                    <label for="NIP" class="col-sm-3 col-form-label">NIP </label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8 ">
                        <input type="number" class="form-control justify-content-center @error('NIP') is-invalid @enderror" readonly id="NIP" placeholder="Ketik NIP..." name="NIP" value="{{ $user->nip }}" >
                    </div>
                </div>
                <hr>
                <div class="form-group row d-flex align-items-center">
                    <label for="Nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center @error('Nama') is-invalid @enderror" id="Nama" readonly placeholder="Ketik Nama Lengkap..." name="Nama" value="{{ $user->nama }}">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="Alamat" class="col-sm-3 col-form-label">Alamat Lengkap</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <textarea class="form-control justify-content-center" id="Alamat" readonly placeholder="Ketik Alamat Lengkap..." name="Alamat">{{ $user->alamat }}</textarea>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="TglLahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="date" class="form-control justify-content-center" id="TglLahir" placeholder="Ketik Tanggal Lahir..." name="TglLahir" readonly value="{{ $user->tgllahir }}">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="Golongan" class="col-sm-3 col-form-label">Golongan</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center" id="Golongan" readonly placeholder="Ketik Golongan..." name="Golongan" value="{{ $user->golongan }}">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="Jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center" id="Jabatan" readonly placeholder="Ketik Jabatan..." name="Jabatan" value="{{ $user->jabatan }}">
                    </div>
                </div>
                <hr>
                <div class="form-group row d-flex align-items-center">
                    <label for="Role" class="col-sm-3 col-form-label">Sebagai</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center" id="Role" readonly placeholder="Role..." name="Role" value="{{ $user->role }}">
                    </div>
                </div>
                <hr>
                <div class="form-group text-left">
                    <a href="{{ Route('Pegawai') }}" class="btn btn-danger btn-md">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script-down')
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endsection

