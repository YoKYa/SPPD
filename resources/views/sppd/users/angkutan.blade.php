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
                        <h4 class="col-12 text-center">Alat Angkutan</h4>
                        <?php $no = 1 ; ?>
                        @foreach ($tempatb as $tempat)
                            @if ($tempat == $sppd->tempat->tempat_tujuan)
                                @if ($no >= 32)
                                <h5 class="col-12 text-center small">(Luar Daerah)</h5>
                                <?php $dd = 0; ?>
                                @else
                                <h5 class="col-12 text-center small">(Dalam Daerah)</h5>
                                <?php $dd = 1; ?>
                                @endif
                            @endif
                            <?php $no++; ?>
                        @endforeach
                        <hr class="d-flex row col-12">
                        {{-- Kendaraan --}}
                        <div class="col-12">
                            <form class="form-group row d-flex align-items-center">
                                <label for="Angkutan" class="col-sm-3 col-form-label">Alat Angkutan</label>
                                <div class="col-sm-1 text-right">:</div>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-md" id="Angkutan">
                                        <option disabled selected>Pilih Alat Angkutan ...</option>
                                        <option>Angkutan Dinas</option>
                                        <option>Angkutan Pribadi</option>
                                        <option>Angkutan Umum</option>
                                        <option>Angkutan Sewa</option>
                                    </select>
                                </div>
                                <button type="submit" class="col-2 btn btn-primary">Simpan</button>
                            </form> 
                        </div>
                        {{-- Jenis angkutan --}}
                        <div class="col-12">
                            <form class="form-group row d-flex align-items-center">
                                <label for="Kendaraan" class="col-sm-3 col-form-label">Jenis Kendaraan</label>
                                <div class="col-sm-1 text-right">:</div>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-md" id="Kendaraan">
                                        <option disabled selected>Pilih Jenis Kendaraan ...</option>
                                        <option>Roda Dua</option>
                                        <option>Roda Empat</option>
                                    </select>
                                </div>
                                <button type="submit" class="col-2 btn btn-primary">Simpan</button>
                            </form> 
                        </div>
                        {{-- Plat Nomor --}}
                        <div class="col-12">
                            <form class="form-group row d-flex align-items-center">
                                <label for="PlatNomor" class="col-sm-3 col-form-label">Plat Nomor</label>
                                <div class="col-sm-1 text-right">:</div>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-md" id="PlatNomor" type="text" placeholder="Plat Nomor">
                                </div>
                                <button type="submit" class="col-2 btn btn-primary">Simpan</button>
                            </form> 
                        </div>
                        {{-- Angkutan Umum --}}
                        <div class="col-12">
                            <form class="form-group row d-flex align-items-center">
                                <label for="AngkutanUmum" class="col-sm-3 col-form-label">Angkutan Umum</label>
                                <div class="col-sm-1 text-right">:</div>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-md" id="AngkutanUmum">
                                        <option disabled selected>Pilih Alat Angkutan Umum ...</option>
                                        <option>Pesawat</option>
                                        <option>Kereta</option>
                                        <option>Kapal</option>
                                    </select>
                                </div>
                                <button type="submit" class="col-2 btn btn-primary">Simpan</button>
                            </form> 
                        </div>
                        {{-- Sewa Kendaraan --}}
                        <div class="col-12">
                            <form class="form-group row d-flex align-items-center">
                                <label for="Sewa" class="col-sm-3 col-form-label">Sewa</label>
                                <div class="col-sm-1 text-right">:</div>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-md" id="Sewa">
                                        <option disabled selected>Pilih Alat Angkutan Yang Disewa ...</option>
                                        <option>Roda Enam/Bus Besar</option>
                                        <option>Roda Enam/Bus Sedang</option>
                                        <option>Roda Empat/Bus Mini</option>
                                        <option>Roda Empat</option>
                                        @if ($dd == 1)
                                        <option>Roda Dua</option>
                                        @endif
                                    </select>
                                </div>
                                <button type="submit" class="col-2 btn btn-primary">Simpan</button>
                            </form> 
                        </div>

                    </div>
                    <div class="row justify-content-start">
                        
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