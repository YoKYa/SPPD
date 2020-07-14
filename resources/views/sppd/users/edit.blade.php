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
                <h3 class="text-center">Edit SPPD</h3>
                <br>
                <div class="tab-content bg-light rounded-lg shadow p-4 mb-3" id="v-pills-tabContent">
                    <h5>Nomor dan Tahun Surat</h5>
                    <hr>
                    <span class="small">Nomor Surat : {{ $sppd->no_surat }} / {{ $sppd->tahun_surat }} </span>
                </div>
                <div class="tab-content bg-light rounded-lg shadow p-4 mb-3" id="v-pills-tabContent">
                    <h5>Dasar Surat</h5>
                    <hr><?php $no = 1; ?>
                    @foreach ($sppd->dasar_surat as $sppd_data)
                        <div class="small">{{ $no++ }}. {{ $sppd_data->dasar_surat }}</div>
                    @endforeach
                </div>
                <div class="tab-content bg-light rounded-lg shadow p-4 mb-3" id="v-pills-tabContent">
                    <h5>Daftar yang diperintah</h5>
                    <hr><?php $no = 1; ?>
                    @foreach ($sppd->user as $sppd_data)
                        <div class="small">{{ $no++ }}. {{ $sppd_data->nama }} / {{ $sppd_data->nip }}</div>
                    @endforeach
                </div>
                <div class="tab-content bg-light rounded-lg shadow p-4 mb-3" id="v-pills-tabContent">
                    <h5>Acara (Maksud Perjalanan Dinas)</h5>
                    <hr><?php $no = 1; ?>
                    <div class="small">{{ $sppd->acara }}</div>
                </div>
                <div class="tab-content bg-light rounded-lg shadow p-4 mb-3" id="v-pills-tabContent">
                    <h5>Tempat</h5>
                        <div class="small">Berangkat : {{ $sppd->tempat->tempat_berangkat }}</div>
                        <div class="small">Tujuan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $sppd->tempat->tempat_tujuan }}</div>
                </div>
                <div class="tab-content bg-light rounded-lg shadow p-4 mb-3" id="v-pills-tabContent">
                    <h5>Tanggal</h5>
                        <div class="small">Berangkat : {{ $sppd->tgl_pergi }}</div>
                        <div class="small">Tujuan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $sppd->tgl_kembali }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-down')
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endsection