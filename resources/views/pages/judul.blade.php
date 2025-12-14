@extends('layouts.layout')

@section('title', 'DIVISI 1 UMUM - Penerapan SMKK')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/ornamen.css') }}">
@endpush

@section('content')
<div class="smkk-container">
    <div class="text-section">
        <h2>DIVISI 1 UMUM</h2>
        <h3>Penerapan SMKK</h3>
        <p class="subtitle">(Sistem Manajemen Keselamatan Konstruksi)</p>
        <p class="desc">Pelatihan Spesifikasi Umum untuk Pekerjaan Konstruksi Jalan dan Jembatan</p>

        @auth
            <a href="{{ route('beranda') }}">
                <button class="btn-yellow">Mulai</button>
            </a>
        @else
            <a href="{{ route('signup') }}">
                <button class="btn-yellow">Daftar</button>
            </a>
        @endauth 

    </div>

    <div class="illustration-section">
        <img src="{{ asset('images/illust.png') }}" alt="Ilustrasi Konstruksi">
    </div>

    <div class="ornamen-bawah">
        <img src="{{ asset('images/Group 4.png') }}" alt="Dekorasi">
    </div>
</div>
@endsection
