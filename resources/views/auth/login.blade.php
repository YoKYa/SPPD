@extends('layouts.app') {{-- Template Master --}}

@section('title', $path)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h2 text-gray-900 mb-4">Masuk</h1>
                                </div>
                                <form class="user" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group" style="font-size: 20px; opacity:0.8;">
                                        <select id="username" name="nip"
                                            class="form-control form-control-user @error('nip') is-invalid @enderror"
                                            required autocomplete="nip" autofocus placeholder="Ketik Nama atau NIP">
                                            <option disabled selected>- Ketik Nama atau NIP -</option>
                                            @foreach ($values as $value)
                                            <option value="{{ $value->nip }}">{{ $value->nip }} - {{ $value->nama }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('nip')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#username').select2();
                                        });
                                    </script>
                            <div class="form-group">
                                <input id="password" type="password"
                                    class="form-control form-control-user @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password" placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block"
                                style="font-size:20px; padding-top:8px; padding-bottom:8px"> {{ __('Login') }}
                            </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small btn btn-primary btn-user"
                                    href="javascript:alert('Silahkan Hubungi Admin');"
                                    style="border-radius:20px; padding: 5px 20px;">Lupa Password?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection