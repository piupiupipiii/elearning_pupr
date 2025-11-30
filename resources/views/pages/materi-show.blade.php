@extends('layouts.parallax')

@section('title', 'Materi - SEKSI ' . $material->section_number)

@section('parallax-content')

    {{-- Ornamen kuning di kanan atas --}}
    <img src="{{ asset('images/line-10.png') }}" class="top-ornamen" alt="ornamen top">

    {{-- Judul halaman di tengah --}}
    <div class="submenu-header">
        <h1 class="title-center">SEKSI {{ $material->section_number }}</h1>
        <div class="subtitle-center">{{ $material->title }}</div>
    </div>

    {{-- Konten video --}}
    <div class="materi-content">
        <div class="video-container">
            <iframe
                src="https://www.youtube.com/embed/{{ $material->youtube_id }}"
                title="{{ $material->title }}"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>

        <div class="materi-info">
            <h3>Deskripsi</h3>
            <p>{{ $material->description ?? 'Tidak ada deskripsi untuk materi ini.' }}</p>
        </div>

        <div class="materi-actions">
            <a href="{{ route('submenu') }}" class="btn-back">← Kembali ke Daftar Materi</a>

            <a href="{{ route('quiz.show', $material) }}" class="btn-quiz">
                @if($progress->status === 'done')
                    Ulangi Quiz →
                @else
                    Lanjut ke Quiz →
                @endif
            </a>
        </div>
    </div>

@endsection

@push('styles')
<style>
    .materi-content {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
        margin-top: 120px;
    }

    .video-container {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%; /* 16:9 aspect ratio */
        background: #000;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .video-container iframe,
    .video-container #youtube-player {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .materi-info {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 12px;
        padding: 20px 25px;
        margin-top: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .materi-info h3 {
        color: #1B5AA1;
        margin-bottom: 10px;
        font-size: 1.2rem;
    }

    .materi-info p {
        color: #333;
        line-height: 1.6;
    }

    .materi-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .btn-back,
    .btn-quiz {
        display: inline-block;
        padding: 12px 25px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.9);
        color: #1B5AA1;
        border: 2px solid #1B5AA1;
    }

    .btn-back:hover {
        background: #1B5AA1;
        color: white;
    }

    .btn-quiz {
        background: linear-gradient(135deg, #F0B92F 0%, #FF9C00 100%);
        color: white;
        border: none;
        box-shadow: 0 4px 15px rgba(240, 185, 47, 0.4);
    }

    .btn-quiz:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(240, 185, 47, 0.5);
    }

    @media (max-width: 768px) {
        .materi-content {
            padding: 15px;
            margin-top: 100px;
        }

        .materi-actions {
            flex-direction: column;
        }

        .btn-back,
        .btn-quiz {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endpush
