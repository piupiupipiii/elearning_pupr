@extends('layouts.layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pendahuluan.css') }}?v={{ filemtime(public_path('css/pendahuluan.css')) }}">
@endpush

@section('content')
<div class="smkk-container kd-page">

    <button class="btn-back">
        <img src="{{ asset('images/icon/back.png') }}" alt="Kembali">
    </button>

    {{-- KIRI: TEKS --}}
    <div class="text-section">
        <h2>PENDAHULUAN</h2>

        <p class="kd-text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
            dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
            mollit anim id est laborum.
        </p>
    </div>

    {{-- KANAN: 3 KOTAK ORANYE --}}
    <div class="kd-illustration-test">
        <div class="kd-box kd-box-2"></div>
        <div class="kd-box kd-box-1"></div>
        <div class="kd-box kd-box-3"></div>

        <img src="{{ asset('images/kd.png') }}" alt="gambar" class="kd-image">

    </div>

</div>
@endsection
