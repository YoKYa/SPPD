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
                <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="text-center col-sm-8">
                                <h3>Surat Perintah Tugas</h3>
                                <hr>
                                <span class="small">Nomor : 094 / {{ $sppd->no_surat }} / 104.2 / {{ $sppd->tahun_surat }} </span>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-end small"><?php $no=1; ?>
                            <div class="col-2">DASAR :</div>
                            @foreach ($sppd->dasar_surat as $sppd_data)
                            <div class="col-10"> 
                                {{ $no++ }}. &nbsp; {{ $sppd_data->dasar_surat }}
                            </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="row justify-content-center">
                            <b class="small text-bold"> MEMERINTAHKAN </b>
                        </div>
                        <br>
                        <div class="row justify-content-start small">
                            <div class="col-2">KEPADA :</div>
                            <div class="col-10 row justify-content-end"><?php $no=1; ?>

                                @foreach ($sppduser as $sppd_data2)
                                    @foreach ($sppduserpegawai as $sppd_data)
                                        @if ($sppd_data->id == $sppd_data2->users_id)
                                        <div class="col-4">
                                            {{ $no++ }}. Nama / NIP 
                                        </div>
                                        <div class="col-1 text-left">:</div>
                                        <div class="col-7">{{ $sppd_data->nama }} / NIP. {{ $sppd_data->nip }}</div>
                                        <div class="col-4">
                                            &nbsp;&nbsp;&nbsp;&nbsp;Pangkat / Golongan
                                        </div>
                                        <div class="col-1 text-left">:</div>
                                        <div class="col-7">{{ $sppd_data->golongan->golongan ?? " - " }}</div>
                                        <div class="col-4">
                                            &nbsp;&nbsp;&nbsp;&nbsp;Jabatan
                                        </div>
                                        <div class="col-1 text-left">:</div>
                                        <div class="col-7">{{ $sppd_data->jabatan->jabatan ?? " - "}}</div>
                                        <br>            
                                        @endif
                                    @endforeach
                                
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-start small">
                            <div class="col-2">UNTUK :</div>
                            <div class="col-10 row justify-content-start">
                                {{ $sppd->acara }}
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-start small">
                            <div class="col-2"></div>
                            <div class="col-1">Ke</div>
                            <div class="col-9">{{ $sppd->tempat->tempat_tujuan }}</div>
                            <div class="col-2"></div>
                            <div class="col-1">Tanggal</div>
                            <div class="col-3">{{ date('d-m-Y',strtotime($sppd->tgl_pergi)) }} s/d {{ date('d-m-Y',strtotime($sppd->tgl_kembali)) }}</div>
                            <div class="col-1">Selama </div>
                            <div class="col-1">{{ $lama }}</div>
                            <div class="col-2">Hari</div>
                        </div>
                        <hr>
                        <div class="row justify-content-end small">
                            <div class="col-6 justify-content-lg-center">
                                <div class="col-12 text-center">Dikeluarkan di {{ $sppd->tempat->tempat_berangkat }}</div>
                                <div class="col-12 text-center">Pada Tanggal {{ date('d-m-Y',strtotime($sppd->tgl_surat)) }}</div>
                                <div class="col-12 text-center">Plt. <span class=" text-uppercase">Kepala Bidang Perencanaan Sumber Daya Air</span></div>
                                <div class="col-12 text-center text-uppercase">Dinas PU Sumber daya air provinsi jawa timur</div>
                                <br><br><br><br><br>
                                <div class="col-12 text-center text-uppercase"><u>{{ $sppd->kabid->nama_kabid }}</u></div>
                                <div class="col-12 text-center">{{ $sppd->kabid->jabatan }}</div>
                                <div class="col-12 text-center">NIP. {{ $sppd->kabid->nip }}</div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <div class="tab-content bg-light rounded-lg shadow p-4 mt-2  mb-5 col-12" id="v-pills-tabContent">
                    <div class="text-center justify-content-center">
                        <h4>SPT</h4>
                        <hr>
                        <div class="row justify-content-center">
                            <a href="" class="ml-2 btn btn-block btn-primary shadow-sm mb-2" style="font-weight: 600">Cetak</a>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ Route('SPPD') }}/{{$sppd->id}}/add" class="btn btn-primary shadow-sm mb-2 col-6 m-1" style="font-weight: 600">Tambah/Hapus Pengikut</a>
                            <a href="{{ Route('SPPD') }}/{{ $sppd->id }}/edit" class="btn btn-primary shadow-sm mb-2 col-6 m-1" style="font-weight: 600">Lengkapi Data</a>
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