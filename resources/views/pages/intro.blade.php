@extends('layouts.layout')

@section('title', 'DIVISI 1 UMUM - Penerapan SMKK')

@push('styles')
<style>
    .intro-illustration {
        background: none;
        padding: 0;
        border-radius: 0;
        box-shadow: none;
        max-width: none;
        position: absolute;
        right: 80px;
        top: 100px;
    }
    .intro-illustration::after {
        display: none;
    }
    .intro-illustration img {
        width: 305px;
        height: 455px;
        object-fit: contain;
    }
    .btn-wide {
        width: 280px;
        height: 55px;
    }
</style>
@endpush

@section('content')
<div class="smkk-container">
    <div class="text-section">
        <h2>SELAMAT DATANG</h2>
        <h3>di Pelatihan Penerapan SMKK</h3>
        <p class="subtitle">(Sistem Manajemen Keselamatan Konstruksi)</p>
        <p class="desc">Pelatihan Spesifikasi Umum untuk Pekerjaan Konstruksi Jalan dan Jembatan</p>

        @auth
            <a href="{{ route('beranda') }}">
                <button class="btn-yellow btn-wide">Mulai Pembelajaran</button>
            </a>
        @else
            <a href="{{ route('login') }}">
                <button class="btn-yellow btn-wide">Login</button>
            </a>
        @endauth

    </div>

    <div class="illustration-section intro-illustration">
        <img src="{{ asset('images/kontraktor.png') }}" alt="Ilustrasi Konstruksi">
    </div>

    <div class="ornamen-bawah">
        <img src="{{ asset('images/Group 4.png') }}" alt="Dekorasi">
    </div>
</div>
@endsection
