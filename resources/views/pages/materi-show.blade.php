@extends('layouts.layout')

@section('title', 'Materi - SEKSI ' . $material->section_number)

@section('content')
    {{-- Split-screen layout: Left panel (text) + Right panel (video) --}}
    <div class="materi-split-layout">

        {{-- LEFT PANEL: Title and back button --}}
        <div class="materi-left-panel">
            {{-- Circular back button --}}
            <a href="{{ route('submenu') }}" class="btn-circle btn-back-circle" title="Kembali ke Daftar Materi">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </a>

            {{-- Title area (vertically centered) --}}
            <div class="left-title-area">
                <h1 class="section-number">SEKSI {{ $material->section_number }}</h1>
                <h2 class="section-title">{{ $material->title }}</h2>
            </div>
        </div>

        {{-- RIGHT PANEL: Video and next button --}}
        <div class="materi-right-panel">
            {{-- YouTube video embed --}}
            <iframe
                src="https://www.youtube.com/embed/{{ $material->youtube_id }}"
                title="{{ $material->title }}"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
                class="fullscreen-video">
            </iframe>

            {{-- Circular next button --}}
            <a href="{{ route('quiz.show', $material) }}" class="btn-circle btn-next-circle" title="@if($progress->status === 'done') Ulangi Quiz @else Lanjut ke Quiz @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>
        </div>

    </div>
@endsection

@push('styles')
<style>
    /* ============================================
       SPLIT-SCREEN LAYOUT
       ============================================ */
    .materi-split-layout {
        display: flex;
        width: 100%;
        min-height: 100vh;
        overflow: hidden;
    }

    /* ============================================
       LEFT PANEL - Title Section
       ============================================ */
    .materi-left-panel {
        width: 50%;
        background: #ffffff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        padding: 60px 40px;
        box-sizing: border-box;
    }

    .left-title-area {
        text-align: center;
        max-width: 600px;
    }

    .section-number {
        font-size: 64px;
        font-weight: 800;
        color: #1a1a1a;
        margin: 0 0 20px 0;
        letter-spacing: -1px;
        line-height: 1.1;
    }

    .section-title {
        font-size: 36px;
        font-weight: 700;
        color: #333333;
        margin: 0;
        line-height: 1.3;
    }

    /* ============================================
       RIGHT PANEL - Video Section
       ============================================ */
    .materi-right-panel {
        width: 50%;
        background: linear-gradient(135deg, #F0B92F 0%, #FF9C00 100%);
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .fullscreen-video {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        border: none;
    }

    /* ============================================
       CIRCULAR NAVIGATION BUTTONS
       ============================================ */
    .btn-circle {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: #1B5AA1;
        border: 4px solid #F0B92F;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        cursor: pointer;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
        text-decoration: none;
        z-index: 100;
    }

    .btn-circle:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        background: #1a4d8f;
    }

    .btn-circle:active {
        transform: scale(0.95);
    }

    .btn-circle svg {
        width: 28px;
        height: 28px;
    }

    /* Back button positioning (top-left of left panel) */
    .btn-back-circle {
        top: 40px;
        left: 40px;
    }

    /* Next button positioning (bottom-right of right panel) */
    .btn-next-circle {
        bottom: 40px;
        right: 40px;
    }

    /* ============================================
       RESPONSIVE DESIGN
       ============================================ */

    /* Tablet and below */
    @media (max-width: 1024px) {
        .section-number {
            font-size: 52px;
        }

        .section-title {
            font-size: 28px;
        }

        .btn-circle {
            width: 60px;
            height: 60px;
        }

        .btn-circle svg {
            width: 24px;
            height: 24px;
        }

        .btn-back-circle {
            top: 30px;
            left: 30px;
        }

        .btn-next-circle {
            bottom: 30px;
            right: 30px;
        }
    }

    /* Mobile - Stack vertically */
    @media (max-width: 768px) {
        .materi-split-layout {
            flex-direction: column;
        }

        .materi-left-panel,
        .materi-right-panel {
            width: 100%;
            min-height: 50vh;
        }

        .materi-left-panel {
            padding: 80px 30px 40px;
        }

        .materi-right-panel {
            min-height: 50vh;
        }

        .section-number {
            font-size: 42px;
        }

        .section-title {
            font-size: 24px;
        }

        .btn-back-circle {
            top: 20px;
            left: 20px;
        }

        .btn-next-circle {
            bottom: 20px;
            right: 20px;
        }

        .btn-circle {
            width: 55px;
            height: 55px;
            border-width: 3px;
        }

        .btn-circle svg {
            width: 22px;
            height: 22px;
        }
    }

    /* Small mobile */
    @media (max-width: 480px) {
        .materi-left-panel {
            padding: 70px 20px 30px;
        }

        .section-number {
            font-size: 36px;
        }

        .section-title {
            font-size: 20px;
        }

        .btn-back-circle {
            top: 15px;
            left: 15px;
        }

        .btn-next-circle {
            bottom: 15px;
            right: 15px;
        }

        .btn-circle {
            width: 50px;
            height: 50px;
        }

        .btn-circle svg {
            width: 20px;
            height: 20px;
        }
    }
</style>
@endpush
