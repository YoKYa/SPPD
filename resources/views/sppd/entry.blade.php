@extends('layouts.app')

@section('title',  $path )
@section('content')
<div class="container-fluid" style="font-size: 20px">
    {{-- Breadcrump --}}
    @include('layouts.breadcrump')
    <div class="row row-cols-10 shadow rounded-lg p-3 justify-content-center m-0" style="background-color: rgb(0, 183, 255)">
        <div class="col-3">
            {{-- Navigasi Menu --}}
            @include('layouts.nav')
        </div>
        <div class="col-9">
            {{-- Tombol Petunjuk --}}
            @include('layouts.help')
            
            {{-- Bagian Isi --}}
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent">
                <form>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control justify-content" id="Nama" placeholder="Nama Saya" disabled>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="NIP" class="col-sm-3 col-form-label">NIP</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="number" class="form-control justify-content" id="NIP" placeholder="NIP Saya" disabled>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Golongan" class="col-sm-3 col-form-label">Golongan</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control justify-content" id="Golongan" placeholder="Golongan Saya" disabled>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control justify-content" id="Jabatan" placeholder="Jabatan Saya" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="P1" class="col-sm-3 col-form-label">Pengikut 1</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control justify-content" id="P1" placeholder="Ketikkan Nama Pengikut 1..">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="P2" class="col-sm-3 col-form-label">Pengikut 2</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control justify-content" id="P2" placeholder="Ketikkan Nama Pengikut 2..">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="P3" class="col-sm-3 col-form-label">Pengikut 3</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control justify-content" id="P3" placeholder="Ketikkan Nama Pengikut 3..">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="P4" class="col-sm-3 col-form-label">Pengikut 4</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control justify-content" id="P4" placeholder="Ketikkan Nama Pengikut 4..">
                        </div>
                    </div>
                    <hr>
                    <br>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Perintah" class="col-sm-4 col-form-label">Yang memberi perintah</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" id="Perintah" placeholder="Nama Kabid PSDA" disabled>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Maksud" class="col-sm-4 col-form-label">Maksud Perjalanan Dinas</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" id="Maksud" placeholder="Ketikkan Maksud Perjalanan Dinas..">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
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
                    <div class="form-group row d-flex align-items-center">
                        <label for="Berangkat" class="col-sm-4 col-form-label">Tempat Berangkat</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" id="Berangkat" placeholder="Tempat Berangkat..">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Tujuan" class="col-sm-4 col-form-label">Tempat Tujuan</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" id="Tujuan" placeholder="Tempat Tujuan..">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Tgl_berangkat" class="col-sm-4 col-form-label">Tanggal Berangkat</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control justify-content" id="Tgl_berangkat" placeholder="Tanggal Berangkat..">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Tgl_kembali" class="col-sm-4 col-form-label">Tanggal Kembali</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control justify-content" id="Tgl_kembali" placeholder="Tanggal Sampai..">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Durasi" class="col-sm-4 col-form-label">Durasi</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control justify-content" id="Durasi" placeholder="Durasi Waktu.." disabled>
                        </div>
                    </div>
                    <hr>
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
                </form>
                    <button type="submit" class="btn btn-primary btn-lg float-right">BUAT SPPD</button>
                <br>
                <br>
                    @php
                        $bln = array(
                            '01' => 'Januari',
                            '02' => 'Februari',
                            '03' => 'Maret',
                            '04' => 'April',
                            '05' => 'Mei',
                            '06' => 'Juni',
                            '07' => 'Juli',
                            '08' => 'Agustus',
                            '09' => 'September',
                            '10' => 'Oktober',
                            '11' => 'November',
                            '12' => 'Desember'
                        );
                    @endphp 
                <h5> Tanggal : {{date('d').' '.$bln[date('m')].' '.date('Y')}}</h5>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-down')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endsection