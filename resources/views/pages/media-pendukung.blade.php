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
    <div class="media-container">
        @forelse($media as $item)
            <div class="media-card">
                <div class="media-icon">
                    <img src="{{ asset('images/icon/folders.png') }}" alt="{{ $item->file_type }}">
                </div>

                <div class="media-info">
                    <h3>{{ $item->title }}</h3>
                    <p class="media-description">{{ $item->description ?? 'Tidak ada deskripsi' }}</p>
                    <div class="media-meta">
                        <span class="file-type">{{ strtoupper($item->file_type) }}</span>
                        <span class="file-size">{{ $item->formatted_size }}</span>
                    </div>
                </div>

                <a href="{{ route('media.download', $item) }}" class="btn-download">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 13L6 9H8V4H12V9H14L10 13Z" fill="currentColor"/>
                        <path d="M17 16H3V11H5V14H15V11H17V16Z" fill="currentColor"/>
                    </svg>
                    Download
                </a>
            </div>
        @empty
            <div class="empty-state">
                <img src="{{ asset('images/icon/folders.png') }}" alt="No Media" style="width: 100px; opacity: 0.5;">
                <p>Belum ada media pendukung yang tersedia.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection
