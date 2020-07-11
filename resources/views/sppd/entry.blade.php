@extends('layouts.app')

@section('title', request()->path() )
@section('content')
<style>
    .select2-container--default
    .select2-selection--single
    .select2-selection__arrow {
    top: 5px;
    right: 10px;
    }
    .select2-container .select2-selection--single {
        height: 38px;
    }
    .select2-container--default
    .select2-selection--single
    .select2-selection__rendered {
    color: rgb(0, 0, 0);
    line-height: 18px;
    font-size: 0.8em;
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
            @include('layouts.help')
            {{-- Bagian Isi --}}
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent">
                <h3 class="text-center">Surat Perintah Tugas (SPT) <br> Surat Perintah Perjalanan Dinas (SPPD)</h3>
                <hr>
                <form method="POST" action="{{ Route('EntrySPPD') }}">
                    <div class="form-group row d-flex align-items-center">
                        <label for="Perintah" class="col-sm-4 col-form-label">Nama <div class="text-secondary small">( yang diperintah )</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" placeholder="Nama yang diperintah" disabled value="{{ $user->nama }}" name="Nama">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label class="col-sm-4 col-form-label">Nama Kabid<div class="text-secondary small">( yang memberi perintah )</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" placeholder="Nama Kabid PSDA" disabled value="{{ $kabid->nama ?? 'Kabid Tidak Ada' }}" name="NamaKabid">
                        </div>
                    </div>
                    <hr>
        
                    <div class="form-group row d-flex align-items-center">
                        <label for="Maksud" class="col-sm-4 col-form-label">Acara <div class="text-secondary small">( Maksud Perjalanan Dinas )</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" id="Maksud" placeholder="Ketikkan Maksud Perjalanan Dinas.." required name="Acara">
                        </div>
                    </div>
                    
                    <div class="form-group row d-flex align-items-center">
                        <label for="TBerangkat" class="col-sm-4 col-form-label">Tempat Berangkat</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class=" d-flex col-7 justify-content-center">
                            <select id="TBerangkat" name="TempatBerangkat" class="form-control" required autofocus>
                                <?php $no = 1; ?>
                                <option disabled style="color: black">==========Dalam Daerah==========</option>
                                <hr>
                                @foreach ($tempatb as $tempat)
                                @if ($no == 32)
                                    <option disabled class="text-center">==========Luar Daerah==========</option>
                                @endif
                                <option @if ($tempat == "Surabaya")
                                    selected
                                @endif value="{{ $no }}">{{ $tempat }}</option>
                                <?php $no++; ?>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="TTujuan" class="col-sm-4 col-form-label">Tempat Tujuan</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class=" d-flex col-7 justify-content-center">
                            <select id="TTujuan" name="TempatTujuan" class="form-control" required autofocus>
                                <option disabled selected style="color: black">- Ketik Tempat Tujuan -</option>
                                <?php $no = 1; ?>
                                <option disabled style="color: black">==========Dalam Daerah==========</option>
                                <hr>
                                @foreach ($tempatb as $tempat)
                                @if ($no == 32)
                                    <option disabled class="text-center">==========Luar Daerah==========</option>
                                @endif
                                <option value="{{ $no }}">{{ $tempat }}</option>
                                <?php $no++; ?>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Tgl_berangkat" class="col-sm-4 col-form-label">Tanggal Berangkat</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control justify-content" id="Tgl_berangkat" placeholder="Tanggal Berangkat.." required name="Tanggal_Berangkat">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Tgl_kembali" class="col-sm-4 col-form-label">Tanggal Kembali</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control justify-content" id="Tgl_kembali" placeholder="Tanggal Sampai.." required name="Tanggal_Kembali">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md float-right">BUAT SPPD</button>
                </form>
                <br>
                <br>
                <hr>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script-down')
<script type="text/javascript">
    $(document).ready(function() {
        $('#nama').select2();
        $('#TBerangkat').select2();
        $('#TTujuan').select2();
    });
</script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endsection

{{-- <div class="form-group row d-flex align-items-center">
                        <label for="Kendaraan" class="col-sm-4 col-form-label">Alat Transportasi</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <select class="form-control form-control-md" id="Kendaraan">
                                <option>Pilih Alat Transportasi ...</option>
                                <option>Kendaraan Umum</option>
                                <option>Kendaraan Dinas</option>
                                <option>Kendaraan Sewa</option>
                            </select>
                        </div>
                    </div> 
                    <br>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Instansi" class="col-sm-4 col-form-label">Instansi</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" id="Instansi" placeholder="Dinas PU Sumber Daya Air" disabled>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Program" class="col-sm-4 col-form-label">Program</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <select class="form-control form-control-md" id="Program">
                                <option>Pilih Program...</option>
                                <option>Program 1</option>
                                <option>Program 2</option>
                                <option>Program 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Kegiatan" class="col-sm-4 col-form-label">Kegiatan</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <select class="form-control form-control-md" id="Kegiatan">
                                <option>Pilih Kegiatan...</option>
                                <option>Kegiatan 1</option>
                                <option>Kegiatan 2</option>
                                <option>Kegiatan 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Rekening" class="col-sm-4 col-form-label">No. Rekening</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <select class="form-control form-control-md" id="Rekening">
                                <option>Pilih Rekening...</option>
                                <option>Rekening 1</option>
                                <option>Rekening 2</option>
                                <option>Rekening 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Keterangan" class="col-sm-4 col-form-label">Keterangan Tambahan</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <textarea class="form-control justify-content" id="Keterangan" rows="3" placeholder="(Opsional. Isi bila ada)"></textarea>
                        </div>
                    </div>
                    --}}