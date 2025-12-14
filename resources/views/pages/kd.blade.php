@extends('layouts.layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pendahuluan.css') }}?v={{ filemtime(public_path('css/pendahuluan.css')) }}">
@endpush

@section('content')
<div class="smkk-container kd-page">

    <button class="btn-back" onclick="window.history.back()">
        <img src="{{ asset('images/icon/back.png') }}" alt="Kembali">
    </button>

    {{-- KIRI: TEKS --}}
    <div class="text-section">
        <h2>PENDAHULUAN</h2>

        <p class="kd-text">
            Media pembelajaran ini disusun untuk membantu peserta memahami Dasar-dasar Penerapan SMKK pada pekerjaan konstruksi. Materi disajikan secara interaktif melalui video, ilustrasi, dan kuis, sehingga peserta dapat mempelajari setiap bagian dengan lebih mudah dan terarah. Melalui pengenalan konsep, tujuan, serta ruang lingkup SMKK, diharapkan peserta mampu menerapkan prinsip keselamatan konstruksi secara tepat dalam kegiatan proyek di lapangan.
        </p>
    </div>

    {{-- KANAN: 3 KOTAK ORANYE --}}
    <div class="kd-illustration-test">
        <div class="kd-box kd-box-2"></div>
        <div class="kd-box kd-box-1"></div>
        <div class="kd-box kd-box-3"></div>

        <img src="{{ asset('images/pupr.jpg') }}" alt="gambar" class="kd-image">

    </div>

</div>
@endsection
