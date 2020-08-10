@include('layouts.TDev')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.nama', 'SPPD') }} - @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('img/gres.png') }}" type="image/x-icon">

    {{-- Script dan css yang digunakan untuk Pilihan NIP dan nama (Harus Online untuk skrip)  --}}
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/list.js') }}"></script>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    {{-- Fonts Harus Online --}}
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@600&display=swap" rel="stylesheet">

    {{-- Styles --}}
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.css') }}">
</head>

<body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                {{-- Header Nama dan Logo --}}
                <a class="navbar-brand" href="{{ url('/') }}" style="font-weight:bold;">
                    <img src="{{ asset('img/gres.png') }}" alt="Logo" width="50px">
                    {{ config('app.nama', 'SPPD') }} DPU SDA Jawa Timur
                </a>
                {{-- Hanya diperlukan kalau ukuran Kecil --}}
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{-- Navigasi Kanan --}}
                    <ul class="navbar-nav ml-auto">
                        {{-- Autentikasi Link --}}
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" v-pre> <b>
                                    {{ Auth::user()->nama }}</b> <span class="caret"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        {{-- Isi Konten --}}
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    {{-- Script tambahan dalam sebuah halaman --}}
    @yield('script-down')
</body>
</html>