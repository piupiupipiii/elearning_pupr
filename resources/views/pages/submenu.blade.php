{{-- resources/views/submenu.blade.php --}}
@extends('layouts.parallax')

@section('title', 'Sub Menu Video Materi')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/parallax.css') }}">
@endpush

@section('parallax-content')

    <div style="width:100%; text-align:center;">
        <h1 class="title-center">Sub Menu Video Materi</h1>
        <div class="subtitle-center">(Divisi 1 - Penerapan SMKK)</div>
    </div>

    <div class="parallax-inner">

        {{-- LEFT TEXT --}}
        <div class="left-info">
            <h2 id="left-title">SEKSI 1.1</h2>
            <h3 id="left-subtitle">Ringkasan Pekerjaan</h3>

            <p id="left-desc">
                Media pembelajaran ini disusun untuk membantu peserta memahami dasar-dasar Penerapan SMKK pada pekerjaan konstruksi. Materi disajikan secara interaktif melalui video, ilustrasi, dan kuis sehingga peserta dapat mempelajari setiap bagian dengan lebih mudah.
            </p>

            <button class="btn-start">Mulai</button>
        </div>

        {{-- RIGHT SLIDER --}}
        <div class="slider-area">
            <button class="nav-btn nav-left nav-left">&#10094;</button>

            <div class="slider-viewport">
                <div class="slider-track">

                    <div class="slider-card"
                        data-title="SEKSI 1.1"
                        data-subtitle="Ringkasan Pekerjaan"
                        data-desc="Media pembelajaran ini membantu memahami ringkasan pekerjaan dan langkah awal.">
                        <h4>SEKSI 1.1</h4>
                        <img class="icon-lock" src="{{ asset('images/unlock.png') }}" alt="unlock">
                        <img class="illustration" src="{{ asset('images/crane.png') }}" alt="crane">
                    </div>

                    <div class="slider-card"
                        data-title="SEKSI 1.2"
                        data-subtitle="Mobilisasi"
                        data-desc="Penjelasan mengenai mobilisasi peralatan dan tenaga kerja sebelum memulai pekerjaan.">
                        <h4>SEKSI 1.2</h4>
                        <img class="icon-lock" src="{{ asset('images/lock.png') }}" alt="lock">
                        <img class="illustration" src="{{ asset('images/mobilisasi.png') }}" alt="mobilisasi">
                    </div>

                    <div class="slider-card"
                        data-title="SEKSI 1.3"
                        data-subtitle="Pengawasan"
                        data-desc="Tahapan pengawasan lapangan untuk menjamin mutu pelaksanaan konstruksi.">
                        <h4>SEKSI 1.3</h4>
                        <img class="icon-lock" src="{{ asset('images/lock.png') }}" alt="lock">
                        <img class="illustration" src="{{ asset('images/safety.png') }}" alt="safety">
                    </div>

                </div>
            </div>

            <button class="nav-btn nav-right nav-right">&#10095;</button>
        </div>

    </div>

@endsection
