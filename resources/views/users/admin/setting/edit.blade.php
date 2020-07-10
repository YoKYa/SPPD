
@extends('layouts.app')

@section('title',  request()->path() )
@section('content')
<div class="container-fluid" style="font-size: 20px">
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
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent">
                <h3 class="text-center">Edit Dasar</h3>
                <br>
                <form action="{{ Route('DasarSurat') }}/{{ $dasar->id }}/edit" method="post" class="form-group row d-flex align-items-center">
                    @method('patch')
                    @csrf
                    <label for="Role" class="col-sm-3 col-form-label">Edit Dasar Surat</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <textarea class="form-control justify-content-center" id="DasarSurat" placeholder="Dasar Surat" name="DasarSurat"">{{ $dasar->dasar }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary btn-sm mt-3" data-toggle="modal" data-target="#Modal{{ $dasar->id }}">Simpan</button>
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

