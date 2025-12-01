@extends('layouts.layout')

@section('title', 'Beranda Modul')

@section('content')
<link rel="stylesheet" href="{{ asset('css/beranda.css') }}">

<div class="content-wrapper">

    {{-- HEADER: Back + Judul --}}
    <div class="header-row">
        <button class="btn-back" onclick="window.history.back()">
            <img src="{{ asset('images/icon/back.png') }}" alt="Kembali">
        </button>

        <div class="judul-wrapper">
            <h1 class="judul">Beranda Modul</h1>
            <p class="subjudul">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
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
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
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
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
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
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
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
