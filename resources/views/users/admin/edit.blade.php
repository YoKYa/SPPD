
@extends('layouts.app')

@section('title',  request()->path() )
@section('content')
<div class="container-fluid" style="font-size: 20px">
    {{-- Breadcrump --}}
    @include('layouts.breadcrump')
    <div class="row row-cols-10 shadow rounded-lg p-3 justify-content-center m-0" style="background-color: rgb(0, 183, 255)">
        @if ($user->role_check(['Admin']))
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
                <form method="POST" action="{{ Route('Admin/Show') }}/{{ $user_pegawai->nip }}/Edit">
                    @method('patch')
                    @csrf
                    <div class="form-group row d-flex align-items-center">
                        <label for="NIP" class="col-sm-3 col-form-label">NIP <span class="text-danger">*</span></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8 ">
                            <input type="number" class="form-control justify-content-center @error('NIP') is-invalid @enderror" id="NIP" placeholder="Ketik NIP..." name="NIP" value="{{ $user_pegawai->nip }}">
                        </div>
                    </div>                    
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Nama" class="col-sm-3 col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control justify-content-center @error('Nama') is-invalid @enderror" id="Nama" placeholder="Ketik Nama Lengkap..." name="Nama" value="{{ $user_pegawai->nama }}">
                        </div>
                    </div> 
                    <div class="form-group row d-flex align-items-center">
                        <label for="Alamat" class="col-sm-3 col-form-label">Alamat Lengkap</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <textarea class="form-control justify-content-center" id="Alamat" placeholder="Ketik Alamat Lengkap..." name="Alamat">{{ $user_pegawai->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="TglLahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="date" class="form-control justify-content-center" id="TglLahir" placeholder="Ketik Tanggal Lahir..." name="TglLahir" value="{{ $user_pegawai->tgllahir }}">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Golongan" class="col-sm-3 col-form-label">Golongan</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <select class="custom-select" id="Golongan" name="Golongan">
                                <option selected disabled>Pilih...</option>
                                <?php $no = 1; ?>
                                @foreach ($golongan as $gol)
                                <option value="{{ $no }}" @if ($user_pegawai->golongan->golongan == $gol) selected @endif>{{ $gol }}</option>
                                <?php $no++; ?>
                                @endforeach
                            </select> 
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control justify-content-center" id="Jabatan" placeholder="Ketik Jabatan...." name="Jabatan" value="{{ $user_pegawai->jabatan->jabatan }}">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        @if ($user_pegawai->cek == 1)
                        <label for="Role" class="col-sm-3 col-form-label">Sebagai<span class="text-danger">*</span></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <select class="custom-select @error('Role') is-invalid @enderror" id="Role" name="Role">
                                <option selected disabled>Pilih...</option>
                                <option value="1" @if ($user_pegawai->role =='Admin')
                                    selected
                                @endif>Admin</option>
                                <option value="2" @if ((DB::table('users')->where('role','Kepala Bidang')->count()) >= 1 )
                                hidden                                    
                                @endif
                                @if ($user_pegawai->role =='Kepala Bidang')
                                    selected
                                @endif
                                >Kepala Bidang</option>
                                <option value="3" 
                                @if ($user_pegawai->role =='Kepala Seksi')
                                    selected
                                @endif>Kepala Seksi</option>
                                <option value="4" @if ($user_pegawai->role =='Staff')
                                    selected
                                @endif>Staff</option>
                            </select>
                        </div>
                        @else
                        <label for="Role" class="col-sm-3 col-form-label">Sebagai</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control justify-content-center" id="Role" placeholder="Role...." name="Role" value="{{ $user_pegawai->role }}" readonly>
                        </div>
                        @endif
                    </div>
                    <div class="form-group text-left">
                        <a href="{{ Route('Admin/Show') }}/{{ $user_pegawai->nip }}" class="btn btn-danger btn-md">Batal</a>
                        <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        @else
        @include('layouts.akses')
        @endif
        
    </div>
</div>
@endsection

@section('script-down')
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endsection

