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
                @if (session()->get('Failed'))
                <div class="alert alert-danger">
                    {{ session()->get('Failed') }}
                </div>
                @endif
                @if (session()->get('Success'))
                <div class="alert alert-success">
                    {{ session()->get('Success') }}
                </div>
                @endif
                <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="text-center col-sm-8">
                                <h3>Surat Perintah Tugas</h3>
                                <hr>
                                <span class="small">Nomor : {{ $sppd->no_surat }} / {{ $sppd->tahun_surat }} </span>
                            </div>
                        </div>
                        <br>
                        <div class="row justify-content-end small"><?php $no=1; ?>
                            <div class="col-2">Dasar :</div>
                            @foreach ($sppd->dasar_surat as $sppd_data)
                            <div class="col-10"> 
                                {{ $no++ }}. &nbsp; {{ $sppd_data->dasar_surat }}
                            </div>
                            @endforeach
                        </div>
                        <br>
                        <div class="row justify-content-center">
                            <b class="small text-bold"> Memerintahkan </b>
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