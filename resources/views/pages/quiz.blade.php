@extends('layouts.parallax')

@section('title', 'Quiz - SEKSI ' . $material->section_number)

@section('parallax-content')

    <meta name="csrf-token" content="{{ csrf_token() }}">



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
        @endif
    </div>

@endsection

@push('styles')
<style>
    .quiz-content-new {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        margin-top: 120px;
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
        min-height: 500px;
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
        padding: 40px;
        margin-bottom: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        min-height: 150px;
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
        gap: 30px;
        margin-bottom: 40px;
    }

    .option-card {
        background: #F5F2DC;
        border-radius: 25px;
        padding: 30px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        min-height: 180px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .option-card:hover:not(.selected):not(.disabled) {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .option-badge {
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 45px;
        height: 45px;
        background: #FF9C00;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
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
        margin-top: 15px;
        font-size: 3rem;
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
        z-index: 1000;
    }

    .btn-next-question:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(255, 156, 0, 0.6);
    }

    .btn-next-question svg {
        color: #1B5AA1;
    }

    /* Background transition for wrong answer */
    body.wrong-answer-bg {
        background: linear-gradient(to bottom, #FF9C00, #F0A500, #D88C00) !important;
        transition: background 0.5s ease;
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
</style>
@endpush

@push('scripts')
<script src="{{ asset('js/quiz-navigation.js') }}"></script>
@endpush
