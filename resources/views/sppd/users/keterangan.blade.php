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
                    <div class="row justify-content-start">
                        <h4 class="col-12 text-center">Keterangan</h4>
                        <hr class="d-flex row col-12">
                        {{-- SKPD --}}
                        <div class="col-12">
                            <form class="form-group row d-flex align-items-center" action="{{ Route('SPPD') }}/{{ $sppd->id }}/keterangan" method="POST">
                                @method('patch')
                                @csrf
                                <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-sm-1 text-right">:</div>
                                <div class="col-sm-8">
                                    <textarea class="form-control justify-content-center" id="Keterangan" rows="2" placeholder="(Opsional. Isi bila ada)" name="Keterangan">{{ $sppd->keterangan->keterangan  }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary m-4">Simpan</button>
                            </form> 
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