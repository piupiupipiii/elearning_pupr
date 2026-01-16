@extends('layouts.parallax')

@section('title', 'Quiz - SEKSI ' . $material->section_number)

@section('parallax-content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/ornamen-atas.css') }}">

    {{-- Ornamen Kanan Atas --}}
    <div class="ornamen-atas">
        <img src="{{ asset('images/ornamen-atas.png') }}" alt="Ornamen">
    </div>

    {{-- Judul halaman di tengah --}}
    <div class="submenu-header">
        <h1 class="title-center" id="quiz-title">QUIZ {{ $questions->count() > 0 ? '1' : '' }}</h1>
    </div>

    {{-- Konten Quiz --}}
    <div class="quiz-content-new">
        @if($questions->isEmpty())
            <div class="quiz-empty">
                <h3>Belum ada pertanyaan untuk quiz ini.</h3>
                <p>Silakan hubungi admin untuk menambahkan pertanyaan.</p>
                <a href="{{ route('materi.show', $material) }}" class="btn-back-empty">← Kembali ke Materi</a>
            </div>
        @else
            {{-- Question Container --}}
            <div class="question-container">
                @foreach($questions as $index => $question)
                    <div class="question-slide" data-question-index="{{ $index }}" data-question-id="{{ $question->id }}" style="{{ $index === 0 ? '' : 'display: none;' }}">
                        {{-- Question Box --}}
                        <div class="question-box">
                            <p class="question-text">{{ $question->question_text }}</p>
                        </div>

                        {{-- Answer Options --}}
                        <div class="options-grid">
                            @foreach($question->options as $key => $option)
                                <div class="option-card" data-answer="{{ $key }}" data-correct="{{ $key === $question->correct_answer ? 'true' : 'false' }}">
                                    <div class="option-badge">{{ $key }}</div>
                                    <div class="option-text">{{ $option }}</div>
                                    <div class="feedback-icon"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Next Button (initially hidden) --}}
            <button class="btn-next-question" id="btn-next-question" style="display: none;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 5l7 7-7 7" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>

            {{-- Hidden form for final submission --}}
            <form id="quiz-submit-form" action="{{ route('quiz.submit', $material) }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="answers" id="quiz-answers" value="">
            </form>

            {{-- Popup GIF untuk feedback --}}
            <div id="lottie-popup" class="lottie-popup" style="display: none;">
                <div class="lottie-popup-content">
                    <img id="popup-gif" src="" alt="Feedback">
                </div>
            </div>

            {{-- Ornamen kiri bawah --}}
            <div class="quiz-ornamen-bawah">
                <img src="{{ asset('images/Group 4.png') }}" alt="Ornamen">
            </div>
        @endif
    </div>

@endsection

@push('styles')
<style>
    .quiz-content-new {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        margin-top: 80px;
        position: relative;
    }

    .quiz-empty {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 12px;
        padding: 40px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .quiz-empty h3 {
        color: #1B5AA1;
        margin-bottom: 15px;
    }

    .quiz-empty p {
        color: #666;
        margin-bottom: 25px;
    }

    .btn-back-empty {
        display: inline-block;
        padding: 14px 30px;
        border-radius: 25px;
        background: rgba(255, 255, 255, 0.9);
        color: #1B5AA1;
        border: 2px solid #1B5AA1;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-back-empty:hover {
        background: #1B5AA1;
        color: white;
    }

    /* Question Container */
    .question-container {
        position: relative;
        min-height: 400px;
    }

    .question-slide {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Question Box */
    .question-box {
        background: rgba(255, 255, 255, 0.95);
        border: 3px solid #FF9C00;
        border-radius: 30px;
        padding: 35px 60px;
        margin-bottom: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        min-height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .question-text {
        color: #1B5AA1;
        font-size: 1.3rem;
        font-weight: 600;
        text-align: center;
        line-height: 1.6;
        margin: 0;
    }

    /* Options Grid */
    .options-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 40px;
    }

    .option-card {
        background: #F5F2DC;
        border-radius: 18px;
        padding: 22px 15px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        height: 130px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        z-index: 20;
    }

    .option-card:hover:not(.selected):not(.disabled) {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .option-badge {
        position: absolute;
        top: -14px;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 40px;
        background: #FF9C00;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        font-weight: 700;
        color: white;
        box-shadow: 0 3px 10px rgba(255, 156, 0, 0.4);
    }

    .option-text {
        color: #333;
        font-size: 1rem;
        line-height: 1.5;
        margin-top: 10px;
    }

    .feedback-icon {
        display: none;
        margin-top: 12px;
        font-size: 2.5rem;
    }

    /* Selected and feedback states */
    .option-card.selected {
        cursor: default;
    }

    .option-card.correct .feedback-icon {
        display: block;
        color: #4CAF50;
    }

    .option-card.correct .feedback-icon::before {
        content: '✓';
    }

    .option-card.wrong .feedback-icon {
        display: block;
        color: #f44336;
    }

    .option-card.wrong .feedback-icon::before {
        content: '✕';
    }

    .option-card.disabled {
        cursor: not-allowed;
        opacity: 0.7;
    }

    /* Next Button */
    .btn-next-question {
        position: fixed;
        bottom: 50px;
        right: 50px;
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #FF9C00 0%, #F0B92F 100%);
        border: 3px solid #1B5AA1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 156, 0, 0.5);
        z-index: 9000;
    }

    /* Hide default ornaments on quiz page */
    .bottom-ornamen,
    .top-right-ornamen {
        display: none !important;
    }

    /* Keep quiz content above ornaments */
    .quiz-content-new {
        position: relative;
        z-index: 10;
    }

    .question-container {
        position: relative;
        z-index: 10;
    }

    .option-card {
        z-index: 10;
    }

    /* Ornamen kiri bawah */
    .quiz-ornamen-bawah {
        position: fixed;
        bottom: 0;
        left: 0;
        z-index: 5;
        pointer-events: none;
    }

    .quiz-ornamen-bawah img {
        width: 350px;
        height: auto;
        opacity: 0.9;
    }

    .btn-next-question:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(255, 156, 0, 0.6);
    }

    .btn-next-question svg {
        color: #1B5AA1;
    }

    /* Background transition for wrong answer - targets parallax-wrapper */
    .parallax-wrapper {
        transition: background 0.5s ease;
    }

    .parallax-wrapper.wrong-answer-bg {
        background: linear-gradient(135deg, #C47F17 0%, #D4920F 50%, #A06A10 100%) !important;
    }

    /* Full page yellow when wrong - including body and header */
    body.wrong-answer-bg,
    body.wrong-answer-bg .main-bg {
        background: linear-gradient(135deg, #C47F17 0%, #D4920F 50%, #A06A10 100%) !important;
    }

    body.wrong-answer-bg .header {
        background: transparent !important;
    }

    .parallax-wrapper.wrong-answer-bg .question-box,
    body.wrong-answer-bg .question-box {
        border-color: #FF9C00;
    }

    .parallax-wrapper.wrong-answer-bg .option-badge,
    body.wrong-answer-bg .option-badge {
        background: #C47F17;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .options-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
    }

    @media (max-width: 768px) {
        .quiz-content-new {
            padding: 15px;
            margin-top: 100px;
        }

        .question-box {
            padding: 25px;
            min-height: 120px;
        }

        .question-text {
            font-size: 1.1rem;
        }

        .options-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .option-card {
            min-height: 120px;
            padding: 25px 15px;
        }

        .btn-next-question {
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
        }
    }

    /* Popup GIF Styles */
    .lottie-popup {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 99999;
    }

    /* Header icons should be behind popup */
    .header,
    .icon-container {
        z-index: 100;
    }

    .lottie-popup-content {
        background: white;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    }

    .lottie-popup-content img {
        width: 150px;
        height: 150px;
        object-fit: contain;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('js/quiz-navigation.js') }}"></script>
@endpush
