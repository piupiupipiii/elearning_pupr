@extends('layouts.parallax')

@section('title', 'Sub Menu Video Materi')

{{-- JANGAN include partial lagi di sini, sudah di-layout --}}
{{-- @include('partials.parallax') --}}

@section('parallax-content')



    {{-- Judul halaman di tengah --}}
    <div class="submenu-header">
        <h1 class="title-center">Sub Menu Video Materi</h1>
        <div class="subtitle-center">(Divisi 1 - Penerapan SMKK)</div>
    </div>

    @if(session('success'))
        <div style="background: #4CAF50; color: white; padding: 10px 20px; border-radius: 8px; margin: 10px auto; max-width: 500px; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Ingat: .parallax-inner.submenu-main sudah ada di layout,
         jadi di sini langsung isi anak flex-nya saja: kiri info, kanan slider --}}

    {{-- KIRI: teks seksi --}}
    <div class="left-info">
        @if($materials->isNotEmpty())
            @php $firstMaterial = $materials->first(); @endphp
            <h2 id="left-title">SEKSI {{ $firstMaterial->section_number }}</h2>
            <h3 id="left-subtitle">{{ $firstMaterial->title }}</h3>
            <p id="left-desc">{{ $firstMaterial->description ?? 'Tidak ada deskripsi.' }}</p>
        @else
            <h2 id="left-title">Belum Ada Materi</h2>
            <h3 id="left-subtitle">-</h3>
            <p id="left-desc">Silakan tambahkan materi melalui halaman admin.</p>
        @endif
        <a href="#" class="btn-start" id="btn-mulai" style="display: none;">Mulai</a>
    </div>

    {{-- Home button (bottom-left corner) --}}
    <a href="{{ route('beranda') }}" class="home-btn" title="Kembali ke Beranda Modul">
        <img src="{{ asset('images/icon/home.png') }}" alt="home">
    </a>

    {{-- KANAN: slider kartu --}}
    <div class="slider-area">
        <button class="nav-btn nav-left" aria-label="previous">&#10094;</button>

        <div class="slider-viewport">
            <div class="slider-track">

                @forelse($materials as $index => $material)
                    @php
                        $status = $userProgress[$material->id] ?? null;
                        $isFirst = $index === 0;
                        $isSecond = $index === 1;
                        $isLocked = $status === null;
                        $isDone = $status === 'done';
                        $isUnlocked = $status === 'unlocked';
                        $cardSize = $isFirst ? 'size-large' : ($isSecond ? 'size-medium' : 'size-small');
                        $href = $isLocked ? 'javascript:void(0)' : route('materi.show', $material);
                    @endphp

                    <a href="{{ $href }}"
                       class="slider-card {{ $cardSize }} {{ $isLocked ? 'locked' : '' }}"
                       data-title="SEKSI {{ $material->section_number }}"
                       data-subtitle="{{ $material->title }}"
                       data-desc="{{ $material->description ?? 'Tidak ada deskripsi.' }}"
                       data-material-id="{{ $material->id }}"
                       data-locked="{{ $isLocked ? 'true' : 'false' }}"
                       @if($isLocked) onclick="alert('Materi ini masih terkunci. Selesaikan materi sebelumnya terlebih dahulu.'); return false;" @endif>
                        <h4>SEKSI {{ $material->section_number }}</h4>
                        @if($isDone)
                            <img class="icon-lock" src="{{ asset('images/icon/check.png') }}" alt="selesai">
                        @elseif($isUnlocked)
                            <img class="icon-lock" src="{{ asset('images/icon/unlocked.png') }}" alt="terbuka">
                        @else
                            <img class="icon-lock" src="{{ asset('images/icon/lock.png') }}" alt="terkunci">
                        @endif
                        <img class="illustration" src="{{ asset('images/icon/crane.png') }}" alt="ilustrasi">
                    </a>
                @empty
                    <div class="slider-card size-large">
                        <h4>Belum Ada Materi</h4>
                        <p>Silakan tambahkan materi melalui <a href="{{ route('admin.materials.index') }}">halaman admin</a>.</p>
                    </div>
                @endforelse

            </div>
        </div>

        <button class="nav-btn nav-right" aria-label="next">&#10095;</button>
    </div>

@endsection

@push('scripts')
    {{-- pastikan nama file JS-nya sama dengan yang di public/js --}}
    <script src="{{ asset('js/slider.js') }}"></script>
    <script>
        // Update Mulai button when active card changes
        document.addEventListener('DOMContentLoaded', function() {
            const btnMulai = document.getElementById('btn-mulai');
            const cards = document.querySelectorAll('.slider-card');

            function updateMulaiButton() {
                const activeCard = document.querySelector('.slider-card.size-large');
                if (activeCard) {
                    const isLocked = activeCard.dataset.locked === 'true';
                    const href = activeCard.getAttribute('href');

                    if (isLocked) {
                        btnMulai.style.display = 'none';
                    } else {
                        btnMulai.style.display = 'inline-block';
                        btnMulai.href = href;
                    }
                }
            }

            // Initial update
            updateMulaiButton();

            // Observe card changes (for slider navigation)
            cards.forEach(card => {
                const observer = new MutationObserver(updateMulaiButton);
                observer.observe(card, { attributes: true, attributeFilter: ['class'] });
            });
        });
    </script>
@endpush
