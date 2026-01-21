@extends('layouts.layout')

@section('title', 'Beranda Modul')

@section('content')
<link rel="stylesheet" href="{{ asset('css/beranda.css') }}">

<div class="content-wrapper">

    {{-- HEADER: Back + Judul --}}
    <div class="header-row">
        <a href="{{ route('judul') }}">
            <button class="btn-back">
                <img src="{{ asset('images/icon/back.png') }}" alt="Kembali">
            </button>
        </a>

        <div class="judul-wrapper">
            <h1 class="judul">Beranda Modul</h1>
            <p class="subjudul">Pilih menu di bawah untuk memulai pembelajaran SMKK.</p>
        </div>
    </div>

    {{-- CONTAINER CARD --}}
    <div class="card-container">

        {{-- CARD 1 --}}
        <div class="card">
            <div class="card-icon">
                <img src="{{ asset('images/icon/kd.png') }}" alt="Kompetensi Dasar">
            </div>

            <h3>Kompetensi Dasar</h3>
            <p>
                Pelajari tujuan pembelajaran dan kompetensi yang akan dicapai dalam modul SMKK ini.
            </p>

            <a href="{{ route('kd') }}">
                <button class="btn-next">
                    <img src="{{ asset('images/icon/right-arrow (2).png') }}" alt="Next">
                </button>
            </a>
        </div>

        {{-- CARD 2 --}}
        <div class="card">
            <div class="card-icon">
                <img src="{{ asset('images/icon/video.png') }}" alt="Video Materi">
            </div>

            <h3>Video Materi</h3>
            <p>
                Tonton video pembelajaran tentang Sistem Manajemen Keselamatan Konstruksi secara berurutan.
            </p>

            <a href="{{ route('submenu') }}">
                <button class="btn-next">
                    <img src="{{ asset('images/icon/right-arrow (2).png') }}" alt="Next">
                </button>
            </a>
        </div>

        {{-- CARD 3 --}}
        <div class="card">
            <div class="card-icon">
                <img src="{{ asset('images/icon/folders.png') }}" alt="Media Pendukung">
            </div>

            <h3>Media Pendukung</h3>
            <p>
                Akses referensi dan tautan sumber materi untuk memperdalam pemahaman SMKK.
            </p>

            <a href="{{ route('media-pendukung') }}">
                <button class="btn-next">
                    <img src="{{ asset('images/icon/right-arrow (2).png') }}" alt="Next">
                </button>
            </a>
        </div>

    </div> {{-- /card-container --}}
</div> {{-- /content-wrapper --}}

@endsection
