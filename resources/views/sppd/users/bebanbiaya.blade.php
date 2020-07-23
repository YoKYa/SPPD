@extends('layouts.app')

@section('title', request()->path() )
@section('content')
<style>
    .select2-container--default .select2-results__option[aria-disabled="true"] {
        color: rgb(196, 196, 196);
    }
</style>
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
            <div class="row justify-content-between">
                <div class="col-12">@include('layouts.help')</div>
            </div>


            {{-- Bagian Isi --}}
            <div class="tab-content bg-light rounded-lg shadow p-4 row justify-content-center" id="v-pills-tabContent">
                @if (session()->get('Success'))
                <div class="alert alert-success col-12">
                    {{ session()->get('Success') }}
                </div>
                @endif
                @if (session()->get('Failed'))
                <div class="alert alert-danger">
                    {{ session()->get('Failed') }}
                </div>
                @endif
                @include('layouts.sppdnav')
                <div class="tab-content bg-light rounded-lg shadow p-4 mb-5 col-12" id="v-pills-tabContent">
                    <form class="row justify-content-start" method="POST" action="{{ Route('SPPD') }}/{{ $sppd->id }}/bebanbiaya">
                        @method('patch')
                        @csrf
                        <h4 class="col-12 text-center">Beban Biaya</h4>
                        <hr class="d-flex row col-12">
                        {{-- SKPD --}}
                        <div class="col-12">
                            <div class="form-group row d-flex align-items-center">
                                <label for="SKPD" class="col-sm-3 col-form-label">Satuan Kerja Perangkat Daerah</label>
                                <div class="col-sm-1 text-right">:</div>
                                <div class="col-sm-8">
                                    <select class="form-control form-control-md" id="SKPD" name="SKPD">
                                        <option disabled>Pilih SKPD ...</option>
                                        @foreach ($skpd as $skpd_data)
                                        <option value="{{ $skpd_data->skpd }}" @if ($bbsppd->skpd == $skpd_data->skpd)
                                            selected
                                        @endif>
                                            {{ $skpd_data->skpd }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Program --}}
                        <div class="col-12">
                            <div class="form-group row d-flex align-items-center">
                                <label for="Program" class="col-sm-3 col-form-label">Program</label>
                                <div class="col-sm-1 text-right">:</div>
                                <div class="col-sm-8">
                                    <select class="form-control form-control-md" id="Program" name="Program">
                                        <option disabled>Pilih Program ...</option>
                                        @foreach ($program as $program_data)
                                        <option value="{{ $program_data->program }}" @if ($bbsppd->program == $program_data->program)
                                            selected
                                        @endif>
                                            {{ $program_data->program }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Kegiatan --}}
                        <div class="col-12">
                            <div class="form-group row d-flex align-items-center" >
                                <label for="Kegiatan" class="col-sm-3 col-form-label">Kegiatan</label>
                                <div class="col-sm-1 text-right">:</div>
                                <div class="col-sm-8">
                                    <select class="form-control form-control-md" id="Kegiatan" name="Kegiatan">
                                        <option disabled>Pilih Kegiatan ...</option>
                                        @foreach ($kegiatan as $kegiatan_data)
                                        <option value="{{ $kegiatan_data->kegiatan }}" @if ($bbsppd->kegiatan == $kegiatan_data->kegiatan)
                                            selected
                                        @endif>
                                            {{ $kegiatan_data->kegiatan }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Kode Rekening --}}
                        <div class="col-12">
                            <div class="form-group row d-flex align-items-center">
                                <label for="KodeRekening" class="col-sm-3 col-form-label">Kode Rekening</label>
                                <div class="col-sm-1 text-right">:</div>
                                <div class="col-sm-8">
                                    <select class="form-control form-control-md" id="KodeRekening" name="KodeRekening">
                                        <option disabled>Pilih Kode Rekening ...</option>
                                        @foreach ($rekening as $rekening_data)
                                        <option value="{{ $rekening_data->rekening }}" @if ($bbsppd->rekening == $rekening_data->rekening)
                                            selected
                                        @endif>
                                            {{ $rekening_data->rekening }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-md btn-primary btn-block" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-down')
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endsection