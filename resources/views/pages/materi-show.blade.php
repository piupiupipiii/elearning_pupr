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
            
            {{-- Local Video for ALL Materials --}}
            <video class="fullscreen-video" controls autoplay disablePictureInPicture controlsList="nodownload">
                <source src="{{ asset('video/ringkasan.mp4') }}" type="video/mp4">
                Browser Anda tidak mendukung tag video.
            </video>

            {{-- Circular next button --}}
            <a href="{{ route('quiz.show', $material) }}" 
               class="btn-circle btn-next-circle @if($progress->status !== 'done') btn-disabled @endif" 
               @if($progress->status !== 'done') data-tooltip="Selesaikan video terlebih dahulu" @else title="Ulangi Quiz" @endif>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>
        </div>

    </div>
@endsection

@push('styles')
<style>
    /* Disabled Button Style */
    .btn-disabled {
        opacity: 0.5;
        cursor: not-allowed !important;
        /* pointer-events: none; REMOVED to allow hover tooltip */
        filter: grayscale(100%);
    }

    /* Disable Fullscreen & PiP Buttons for Local Video */
    video::-webkit-media-controls-fullscreen-button,
    video::-webkit-media-controls-picture-in-picture-button {
        display: none !important;
    }
    
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
        background: #ffffff; /* User requested all white background */
        position: relative;
        display: flex;
        align-items: center;
        justify-content: flex-end; /* Align content to the right */
        overflow: hidden;
    }

    .fullscreen-video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border: none;
    }

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
        position: relative; /* For tooltip positioning context */
    }

    /* Custom Tooltip Logic */
    .btn-disabled[data-tooltip]:hover::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 85px; /* Position above button */
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 14px;
        white-space: nowrap;
        pointer-events: none;
        z-index: 1000;
        animation: fadeIn 0.2s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateX(-50%) translateY(5px); }
        to { opacity: 1; transform: translateX(-50%) translateY(0); }
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

    /* Back button positioning (top-left, same as beranda .btn-back) */
    .btn-back-circle {
        top: 88px;
        left: 80px;
        position: fixed;
    }

    /* Next button positioning (bottom-right of screen) */
    .btn-next-circle {
        bottom: 80px;
        right: 40px;
        position: fixed;
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
            bottom: 60px;
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
            bottom: 40px;
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

    /* FORCE WHITE BACKGROUND GLOBALLY FOR THIS PAGE */
    body, html, .main-bg, .content {
        background: #ffffff !important;
        background-image: none !important;
        padding: 0 !important; /* Ensure no padding prevents edge-to-edge */
        margin: 0 !important;
        width: 100%;
    }

    /* Custom Header Styles for this page */
    .header {
        display: flex !important; /* Restore header */
        position: absolute !important; /* Overlay on top */
        top: 0;
        left: 0;
        width: 100%;
        background: transparent !important; /* Transparent bg */
        box-shadow: none !important;
        z-index: 999;
        padding: 20px 40px !important; /* Adjust padding if needed */
    }

    /* Hide User/QnA Icons */
    .header .icon-container {
        display: none !important;
    }

    /* Adjust Left Panel Padding to compensate for absolute header */
    .materi-left-panel {
        padding-top: 140px !important; /* Push content down */
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const video = document.querySelector('video');
        const nextBtn = document.querySelector('.btn-next-circle');

        if (video && nextBtn && nextBtn.classList.contains('btn-disabled')) {
            // Listen for video end
            video.addEventListener('ended', function() {
                nextBtn.classList.remove('btn-disabled');
                // Optional: Play a sound or small animation to indicate it's enabled
                console.log('Video finished, next button enabled.');
            });

            // Prevent click just in case CSS pointer-events fails (e.g. older browsers)
            nextBtn.addEventListener('click', function(e) {
                if (this.classList.contains('btn-disabled')) {
                    e.preventDefault();
                    alert('Silakan tonton video sampai selesai untuk melanjutkan!');
                }
            });
        }
    });
</script>
@endpush
