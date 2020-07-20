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
            <div class="row justify-content-end">
                <div class="col-12">@include('layouts.help')</div>
            </div>


            {{-- Bagian Isi --}}
            <div class="tab-content bg-light rounded-lg shadow p-4 row justify-content-center" id="v-pills-tabContent">
                <div class="row justify-content-start col-12 mb-2">
                    <a href="{{ Route('SPPD') }}" class="btn btn-primary">
                        <i class="fa fa-arrow-circle-o-left"></i>
                        Kembali
                    </a>
                </div>
                <div class="tab-content bg-light rounded-lg shadow p-4 mt-2  mb-5 col-12" id="v-pills-tabContent">
                    <div class="text-center justify-content-center">
                        <h4>Surat Perintah Perjalanan Dinas</h4>
                        <hr>
                        <div class="d-flex justify-content-center">
                            <a href="{{ Route('CetakSPPD') }}/{{ $sppd->id }}" target="_blank"  class="btn-lg btn-info shadow-sm mb-2 col-12 m-1"
                                style="font-weight: 600; text-decoration:none">Cetak</a>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ Route('SPPD') }}/{{$sppd->id}}/add"
                                class="btn btn-primary shadow-sm mb-2 col-12 m-1" style="font-weight: 600">Lengkapi Data</a>
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