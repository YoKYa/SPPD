@extends('layouts.app')

@section('title',  request()->path() )
@section('content')
<div class="container-fluid" style="font-size: 20px">
    {{-- Breadcrump --}}
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
                
                <div class="tab-pane fade table-responsive-xl active show" id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-user-tab">
                    <h3 class="text-center">Daftar Users</h3>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <form class="active-cyan-4 col-4 d-flex mb-1" action="{{ Route('Admin/Show') }}" method="GET">
                            <input class="form-control col-9" type="text" placeholder="Cari Nama atau NIP"
                            aria-label="Search" name="search" value="{{ request()->search }}">&nbsp;
                            <button type="submit" class="btn btn-primary col-3"><i class="fa fa-search"></i></button>
                        </form>
                        <a class="btn btn-primary mb-1" style="font-size: 14px" href="{{ Route('Admin/CreateUser') }}">
                            <i class="fa fa-user-plus"></i>&nbsp;
                            Tambah User
                        </a>
                        
                    </div>
                    
                    <table class="table table-striped table-hover" style="font-size: 14px">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">NIP</th>
                                <th scope="col" width="200px">Nama</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = $users->currentPage()*$users->perPage()-4; ?>
                            @foreach ($users as $user_peg)
                            <tr>
                                <th>{{ $no }}</th>
                                <td>{{ $user_peg->nip }}</td>
                                <td>{{ $user_peg->nama }}</td>
                                <td>{{ $user_peg->role }}</td>
                                <td width="260px">
                                    <form action="{{ Route('Admin/Show') }}/{{ $user_peg->nip }}/Delete" method="post">
                                        <a href="{{ Route('Admin/Show') }}/{{ $user_peg->nip }}"class="btn btn-primary" style="font-size: 12px">Lihat</a>
                                        <a href="{{ Route('Admin/Show') }}/{{ $user_peg->nip }}/Edit"class="btn btn-info" style="font-size: 12px">Edit</a>
                                        @method('delete')
                                        @csrf
                                        
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal{{ $user_peg->nip }}" @if ($user_peg->cek == 0) hidden @endif>
                                            Hapus
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="Modal{{ $user_peg->nip }}" tabindex="-1" role="dialog" aria-labelledby="Hapus{{ $user_peg->nip }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="Hapus{{ $user_peg->nim }}">Anda yakin untuk menghapus ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Nama : {{ $user_peg->nama }} </h6>
                                                        <h6>NIP&nbsp;&nbsp;&nbsp;&nbsp; : {{ $user_peg->nip }}</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ Route('Admin/Show') }}/{{ $user_peg->nip }}/delete" method="post">
                                                            @method('delete')
                                                            @csrf   
                                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <?php $no++;?>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->render() }}
                </div>
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