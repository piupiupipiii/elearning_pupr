@extends('layouts.layout')

@section('title', 'DIVISI 1 UMUM - Penerapan SMKK')

@section('content')
<div class="smkk-container">
    <div class="text-section">
        <h2>SELAMAT DATANG</h2>
        <h3>di Pelatihan Penerapan SMKK</h3>
        <p class="subtitle">(Sistem Manajemen Keselamatan Konstruksi)</p>
        <p class="desc">Pelatihan Spesifikasi Umum untuk Pekerjaan Konstruksi Jalan dan Jembatan</p>

        <a href="{{ route('beranda') }}">
            <button class="btn-mulai">Mulai Pembelajaran</button>
        </a>

    </div>

    <div class="illustration-section">
        <img src="{{ asset('images/kontraktor.png') }}" alt="Ilustrasi Konstruksi">
    </div>

    <div class="ornamen-bawah">
        <img src="{{ asset('images/Group 4.png') }}" alt="Dekorasi">
    </div>
</div>
@endsection
