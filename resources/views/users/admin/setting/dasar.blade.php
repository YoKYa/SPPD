
@extends('layouts.app')

@section('title',  request()->path() )
@section('content')
<div class="container-fluid" style="font-size: 20px">
    @include('layouts.breadcrump')
    <div class="row row-cols-10 shadow rounded-lg p-3 justify-content-center m-0" style="background-color: rgb(0, 183, 255)">
        @if ($user->role_check(['Admin']))
        <div class="col-3">
            {{-- Navigasi Menu --}}
            @include('layouts.nav')
        </div>
        <div class="col-9">
            {{-- Tombol Petunjuk --}}
            @include('layouts.help')
            
            {{-- Bagian Isi --}}
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent">
                @if (session()->get('Success'))
                <div class="alert alert-success">
                    {{ session()->get('Success') }}
                </div>
                @endif
                @if (session()->get('Failed'))
                <div class="alert alert-danger">
                    {{ session()->get('Failed') }}
                </div>
                @endif
                <h3 class="text-center">Dasar Surat</h3>
                <br>
                <?php $no = 1 ?>
                @foreach ($dasar as $isi)
                <div class="form-group row d-flex align-items-center">
                    <label for="Dasar{{ $isi->id }}" class="col-sm-1 col-form-label">{{ $no++ }}</label>
                    <div class="col-sm-9">
                        <textarea class="form-control justify-content-center" id="Dasar{{ $isi->id }}"readonly>{{ $isi->dasar }}</textarea>
                    </div>
                    <div class="row d-flex">
                        <a href="{{ Route('DasarSurat') }}/{{ $isi->id }}/edit" class="col-sm-11 btn btn-sm btn-primary ml-3 mb-2">Edit</a>
                        <button href="{{ Route('DasarSurat') }}/{{ $isi->id }}/delete" class="col-sm-11 btn btn-sm btn-danger ml-3" data-toggle="modal" data-target="#Modal{{ $isi->id }}">Hapus</button>
                        <!-- Modal -->
                        <div class="modal fade" id="Modal{{ $isi->id }}" tabindex="-1" role="dialog" aria-labelledby="Hapus{{ $isi->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="Hapus{{ $isi->id }}">Anda yakin untuk menghapus ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h6>{{ $isi->dasar }}</h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="{{ Route('DasarSurat') }}/{{ $isi->id }}/delete" method="post">
                                            @method('delete')
                                            @csrf   
                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
                <hr>
                @endforeach
                <form action="{{ Route('DasarSurat') }}" method="post">
                    @csrf
                    <button href="" class="btn btn-block btn-primary ml-3 mb-2">Tambah</button>
                </form>
                
            </div>
            
        </div>
        @else
        @include('layouts.akses')
        @endif
    </div>
</div>

@endsection

@section('script-down')
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endsection

