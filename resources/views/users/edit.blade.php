
@extends('layouts.app')

@section('title',  $path )
@section('content')
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
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent" >
                <h3 class="text-center">Edit Users</h3>
                <br>
                <form method="POST" action="{{ Route('Users/Profile/Edit') }}">
                    @method('patch')
                    @csrf
                    <div class="form-group row d-flex align-items-center">
                        <label for="NIP" class="col-sm-3 col-form-label">NIP <span class="text-danger">*</span></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8 ">
                            <input type="number" class="form-control justify-content-center @error('NIP') is-invalid @enderror" id="NIP" placeholder="Ketik NIP..." name="NIP" value="{{ $users->nip }}">
                        </div>
                    </div>                    
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Nama" class="col-sm-3 col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control justify-content-center @error('Nama') is-invalid @enderror" id="Nama" placeholder="Ketik Nama Lengkap..." name="Nama" value="{{ $users->nama }}">
                        </div>
                    </div> 
                    <div class="form-group row d-flex align-items-center">
                        <label for="Alamat" class="col-sm-3 col-form-label">Alamat Lengkap</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <textarea class="form-control justify-content-center" id="Alamat" placeholder="Ketik Alamat Lengkap..." name="Alamat">{{ $users->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="TglLahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="date" class="form-control justify-content-center" id="TglLahir" placeholder="Ketik Tanggal Lahir..." name="TglLahir" value="{{ $users->tgllahir }}">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Golongan" class="col-sm-3 col-form-label">Golongan</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <select class="custom-select" id="Golongan" name="Golongan">
                                <option selected disabled>Pilih...</option>
                                <option value="1" @if ($users->golongan == 'Juru Muda (I/a)') selected @endif >Juru Muda (I/a)</option>
                                <option value="2" @if ($users->golongan == 'Juru Muda Tingkat I (I/b)') selected @endif >Juru Muda Tingkat I (I/b)</option>
                                <option value="3" @if ($users->golongan == 'Juru (I/c)') selected @endif >Juru (I/c)</option>
                                <option value="4" @if ($users->golongan == 'Juru Tingkat I (I/d)') selected @endif >Juru Tingkat I (I/d)</option>
                                <option value="5" @if ($users->golongan == 'Pengatur Muda (II/a)') selected @endif >Pengatur Muda (II/a)</option>
                                <option value="6" @if ($users->golongan == 'Pengatur Muda Tingkat I (II/b)') selected @endif >Pengatur Muda Tingkat I (II/b)</option>
                                <option value="7" @if ($users->golongan == 'Pengatur (II/c)') selected @endif >Pengatur (II/c)</option>
                                <option value="8" @if ($users->golongan == 'Pengatur Tingkat I (II/d)') selected @endif >Pengatur Tingkat I (II/d)</option>
                                <option value="9" @if ($users->golongan == 'Penata Muda (III/a)') selected @endif >Penata Muda (III/a)</option>
                                <option value="10" @if ($users->golongan == 'Penata Muda Tingkat I (III/b)') selected @endif >Penata Muda Tingkat I (III/b)</option>
                                <option value="11" @if ($users->golongan == 'Penata (III/c)') selected @endif >Penata (III/c)</option>
                                <option value="12" @if ($users->golongan == 'Penata Tingkat I (III/d)') selected @endif >Penata Tingkat I (III/d)</option>
                                <option value="13" @if ($users->golongan == 'Pembina (IV/a)') selected @endif >Pembina (IV/a)</option>
                                <option value="14" @if ($users->golongan == 'Pembina Tingkat I (IV/b)') selected @endif >Pembina Tingkat I (IV/b)</option>
                                <option value="15" @if ($users->golongan == 'Pembina Utama Muda (IV/c)') selected @endif >Pembina Utama Muda (IV/c)</option>
                                <option value="16" @if ($users->golongan == 'Pembina Utama Madya (IV/d)') selected @endif >Pembina Utama Madya (IV/d)</option>
                                <option value="17" @if ($users->golongan == 'Pembina Utama (IV/e)') selected @endif >Pembina Utama (IV/e)</option>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <select class="custom-select" id="Jabatan" name="Jabatan">
                                <option selected disabled>Pilih...</option>
                                <option value="1" @if ($users->jabatan == "") @endif>One</option>
                                <option value="2" @if ($users->jabatan == "") @endif>Two</option>
                                <option value="3" @if ($users->jabatan == "") @endif>Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <a href="{{ Route('Dashboard') }}" class="btn btn-danger btn-md">Batal</a>
                        <button type="submit" class="btn btn-primary btn-md">Edit User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-down')
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endsection

