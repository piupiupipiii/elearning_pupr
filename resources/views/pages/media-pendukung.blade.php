@extends('layouts.layout')

@section('title', 'Media Pendukung')

@section('content')
<link rel="stylesheet" href="{{ asset('css/media-pendukung.css') }}">

<div class="content-wrapper">

    {{-- HEADER: Back + Judul --}}
    <div class="header-row">
        <a href="{{ route('beranda') }}">
            <button class="btn-back">
                <img src="{{ asset('images/icon/back.png') }}" alt="Kembali">
            </button>
        </a>

        <div class="judul-wrapper">
            <h1 class="judul">Media Pendukung</h1>
            <p class="subjudul">Dokumen dan file pendukung pembelajaran</p>
        </div>
    </div>

    {{-- MEDIA CONTAINER --}}
    <div class="media-container-grid">
        
        {{-- Item 1 --}}
        <a href="https://binamarga.pu.go.id/uploads/files/1772/skh-1122-sistem-manajemen-keselamatan-konstruksi.pdf" target="_blank" class="book-card">
            <div class="book-cover">
                <div class="book-spine"></div>
                <div class="book-content">
                    <div class="book-header">
                        <p class="agency-name">KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT</p>
                        <p class="agency-unit">DIREKTORAT JENDERAL BINA MARGA</p>
                    </div>
                    
                    <div class="book-logo">
                        <img src="{{ asset('images/icon/pupr.png') }}" alt="Logo PUPR">
                    </div>

                    <div class="book-title-section">
                        <h2 class="book-title">SKH-1.1.22</h2>
                        <h3 class="book-subtitle">SISTEM MANAJEMEN KESELAMATAN KONSTRUKSI</h3>
                    </div>
                    
                    <div class="book-footer">
                        <span class="book-year">2021</span>
                    </div>
                </div>
            </div>
            <div class="book-shadow"></div>
        </a>

        {{-- Item 2 --}}
        <a href="https://peraturan.bpk.go.id/Details/159697/permen-pupr-no-21prtm2019-tahun-2019" target="_blank" class="book-card">
            <div class="book-cover">
                <div class="book-spine"></div>
                <div class="book-content">
                    <div class="book-header">
                        <p class="agency-name">KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT</p>
                    </div>
                    
                    <div class="book-logo">
                        <img src="{{ asset('images/icon/pupr.png') }}" alt="Logo PUPR">
                    </div>

                    <div class="book-title-section">
                        <h2 class="book-title">PERMEN PUPR NO. 21</h2>
                        <h3 class="book-subtitle">PEDOMAN SISTEM MANAJEMEN KESELAMATAN KONSTRUKSI</h3>
                    </div>

                    <div class="book-footer">
                        <span class="book-year">2019</span>
                    </div>
                </div>
            </div>
            <div class="book-shadow"></div>
        </a>

        {{-- Item 3 --}}
        <a href="https://peraturan.bpk.go.id/Details/216875/permen-pupr-no-10-tahun-2021" target="_blank" class="book-card">
            <div class="book-cover">
                <div class="book-spine"></div>
                <div class="book-content">
                    <div class="book-header">
                        <p class="agency-name">KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT</p>
                    </div>
                    
                    <div class="book-logo">
                        <img src="{{ asset('images/icon/pupr.png') }}" alt="Logo PUPR">
                    </div>

                    <div class="book-title-section">
                        <h2 class="book-title">PERMEN PUPR NO. 10</h2>
                        <h3 class="book-subtitle">PEDOMAN SISTEM MANAJEMEN KESELAMATAN KONSTRUKSI</h3>
                    </div>

                    <div class="book-footer">
                        <span class="book-year">2021</span>
                    </div>
                </div>
            </div>
            <div class="book-shadow"></div>
        </a>

    </div>

</div>
@endsection
