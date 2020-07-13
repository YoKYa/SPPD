@extends('layouts.app')

@section('title', request()->path() )
@section('content')
<div class="container-fluid" style="font-size: 20px">
    {{-- Breadcrump --}}
    @include('layouts.breadcrump')
    <div class="row row-cols-10 shadow rounded-lg p-3 justify-content-center m-0"
        style="background-color: rgb(0, 183, 255)">
        <div class="col-3">
            {{-- Navigasi Menu --}}
            @include('layouts.nav')
        </div>
        <div class="col-9">
            {{-- Tombol Petunjuk --}}
            @include('layouts.help')
            {{-- Bagian Isi --}}
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent">
                <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="text-center">
                                <h5>Maaf Anda Tidak Punya akses untuk membuka SPPD halaman ini <br>
                                <a href="{{ Route('SPPD') }}">Klik Disini</a> <br>
                                Untuk Kembali</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-down')
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endsection