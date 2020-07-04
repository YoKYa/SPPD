@extends('layouts.app')

@section('title',  $path )
@section('content')
<div class="container" style="font-size: 20px">
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
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent" @if ($role != 'Admin') hidden @endif>
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
                
                <div class="tab-pane fade table-responsive-xl @if ($role == 'Admin') active show @endif" id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-user-tab">
                    <a class="btn btn-primary" style="font-size: 12px" href="{{ Route('Users/CreateUser') }}">
                        <i class="fa fa-user-plus"></i>&nbsp;
                        Tambah User
                    </a>
                    <br><br>
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endsection