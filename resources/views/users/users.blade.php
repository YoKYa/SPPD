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
                            @foreach ($users as $user)
                            <tr>
                                <th>{{ $no }}</th>
                                <td>{{ $user->nip }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->role }}</td>
                                <td width="260px">
                                    <button type="button" class="btn btn-primary" style="font-size: 12px">Show</button>
                                    <button type="button" class="btn btn-info" style="font-size: 12px">Edit</button>
                                    <button type="button" class="btn btn-danger" style="font-size: 12px">Delete</button>
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
    </div>
</div>
@endsection

@section('script-down')
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endsection