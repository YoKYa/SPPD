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
                        <h4 class="col-12 text-center">Tambah Pengikut - SPPD ( Nomor Surat - {{ $sppd->no_surat }} )</h4>
                        <div class="col-12">
                            <hr>
                        </div>
                        <?php $no = 1; ?>
                        <div class="col-12">
                            @foreach ($sppduser as $sppd_data2)
                                @foreach ($sppduserpegawai as $sppd_data)
                                    @if ($sppd_data->id == $sppd_data2->users_id)
                                    <div>{{ $no++ }} . {{ $sppd_data->nama }} / NIP. {{ $sppd_data->nip }}
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal{{ $sppd_data->id }}">
                                            Hapus
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="Modal{{ $sppd_data->id }}" tabindex="-1" role="dialog" aria-labelledby="Hapus{{ $sppd_data->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="Hapus{{ $sppd_data->id }}">Anda yakin untuk menghapus ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Nama : {{ $sppd_data->nama }} </h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ Route('SPPD') }}/{{ $sppd_data2->sppd_id }}/{{ $sppd_data->id }}/delete" method="post">
                                                            @method('delete')
                                                            @csrf   
                                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <hr>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </div>

                    <?php $no = 1; ?>
                    @foreach ($sppd->user as $sppd_data)
                        <?php $data[$no++] = $sppd_data->nip; ?>
                    @endforeach
                    <?php $data = collect($data); ?>
                    <div class="row justify-content-start">
                        <form action="{{ Route('SPPD') }}/{{ $sppd->id }}/add" method="post" class="col-12">
                            @csrf
                            <div class="col-12 form-group" style="font-size: 20px; opacity:0.8;">
                                <select id="username" name="nip"
                                    class="form-control form-control-user @error('nip') is-invalid @enderror"
                                    required autocomplete="nip" autofocus placeholder="Ketik Nama atau NIP">
                                    <option disabled selected>- Ketik Nama atau NIP -</option>
                                    @foreach ($all_user as $this_user)
                                        <option value="{{ $this_user->nip }}" 
                                            <?php 
                                            foreach ($data as $dataa) { ?>
                                                @if (
                                                    $this_user->nip == $dataa
                                                ) disabled aria-disabled="false"
                                                @endif
                                            <?php } ?>
                                            required >
                                        {{ $this_user->nip }} - {{ $this_user->nama }} 
                                        </option>
                                    @endforeach
                                </select>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $('#username').select2();
                                    });
                                </script>
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-primary d-flex justify-content-center">Tambah</button>
                            </div>
                        </form>
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