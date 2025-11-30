@extends('layouts.parallax')

@section('title', 'Sub Menu Video Materi')

{{-- JANGAN include partial lagi di sini, sudah di-layout --}}
{{-- @include('partials.parallax') --}}

@section('parallax-content')

    {{-- Ornamen kuning di kanan atas --}}
    <img src="{{ asset('images/line-10.png') }}" class="top-ornamen" alt="ornamen top">

    {{-- Judul halaman di tengah --}}
    <div class="submenu-header">
        <h1 class="title-center">Sub Menu Video Materi</h1>
        <div class="subtitle-center">(Divisi 1 - Penerapan SMKK)</div>
    </div>

    {{-- Ingat: .parallax-inner.submenu-main sudah ada di layout,
         jadi di sini langsung isi anak flex-nya saja: kiri info, kanan slider --}}

    {{-- KIRI: teks seksi --}}
    <div class="left-info">
        <h2 id="left-title">SEKSI 1.1</h2>
        <h3 id="left-subtitle">Ringkasan Pekerjaan</h3>
        <p id="left-desc">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt
            ut labore et dolore magna aliqua. Ut enim ad minim veniam.
        </p>
        <button class="btn-start">Mulai</button>
    </div>

    {{-- KANAN: slider kartu --}}
    <div class="slider-area">
        <button class="nav-btn nav-left" aria-label="previous">&#10094;</button>

        <div class="slider-viewport">
            <div class="slider-track">

                {{-- Card 1 (mulai sebagai kartu besar / aktif) --}}
                <div class="slider-card size-large"
                     data-title="SEKSI 1.1"
                     data-subtitle="Ringkasan Pekerjaan"
                     data-desc="Penjelasan ringkas mengenai pekerjaan.">
                    <h4>SEKSI 1.1</h4>
                    <img class="icon-lock" src="{{ asset('images/icon/unlocked.png') }}" alt="unlock">
                    <img class="illustration" src="{{ asset('images/icon/crane.png') }}" alt="ilustrasi crane">
                </div>

                {{-- Card 2 --}}
                <div class="slider-card size-small"
                     data-title="SEKSI 1.2"
                     data-subtitle="Mobilisasi"
                     data-desc="Penjelasan tentang proses mobilisasi.">
                    <h4>SEKSI 1.2</h4>
                    <img class="icon-lock" src="{{ asset('images/icon/lock.png') }}" alt="lock">
                    <img class="illustration" src="{{ asset('images/mobilisasi.png') }}" alt="ilustrasi mobilisasi">
                </div>

                {{-- Card 3 --}}
                <div class="slider-card size-small"
                     data-title="SEKSI 1.3"
                     data-subtitle="Pengawasan"
                     data-desc="Tahapan pengawasan lapangan.">
                    <h4>SEKSI 1.3</h4>
                    <img class="icon-lock" src="{{ asset('images/lock.png') }}" alt="lock">
                    <img class="illustration" src="{{ asset('images/safety.png') }}" alt="ilustrasi safety">
                </div>

                {{-- Contoh tambahan card sampai SEKSI 22 --}}
                @for ($i = 4; $i <= 22; $i++)
                    <div class="slider-card size-small"
                         data-title="SEKSI {{ $i }}"
                         data-subtitle="Sub {{ $i }}"
                         data-desc="Deskripsi {{ $i }}">
                        <h4>SEKSI {{ $i }}</h4>
                        <img class="icon-lock" src="{{ asset('images/lock.png') }}" alt="lock">
                    </div>
                @endfor
            </div>
        </div>

        <button class="nav-btn nav-right" aria-label="next">&#10095;</button>
    </div>
<!-- 
    {{-- Ornamen garis putih di kanan bawah --}}
    <img src="{{ asset('images/Group 1.png') }}" class="bottom-ornamen" alt="ornamen bottom"> -->

@endsection

@push('scripts')
    {{-- pastikan nama file JS-nya sama dengan yang di public/js --}}
    <script src="{{ asset('js/slider.js') }}"></script>
@endpush
