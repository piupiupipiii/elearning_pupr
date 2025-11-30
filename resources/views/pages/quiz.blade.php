@extends('layouts.parallax')

@section('title', 'Quiz - SEKSI ' . $material->section_number)

@section('parallax-content')

    {{-- Ornamen kuning di kanan atas --}}
    <img src="{{ asset('images/line-10.png') }}" class="top-ornamen" alt="ornamen top">

    {{-- Judul halaman di tengah --}}
    <div class="submenu-header">
        <h1 class="title-center">Quiz SEKSI {{ $material->section_number }}</h1>
        <div class="subtitle-center">{{ $material->title }}</div>
    </div>

    {{-- Konten Quiz --}}
    <div class="quiz-content">
        @if($questions->isEmpty())
            <div class="quiz-empty">
                <h3>Belum ada pertanyaan untuk quiz ini.</h3>
                <p>Silakan hubungi admin untuk menambahkan pertanyaan.</p>
                <a href="{{ route('materi.show', $material) }}" class="btn-back">← Kembali ke Materi</a>
            </div>
        @else
            <form action="{{ route('quiz.submit', $material) }}" method="POST" class="quiz-form">
                @csrf

                @foreach($questions as $index => $question)
                    <div class="question-card">
                        <div class="question-number">Pertanyaan {{ $index + 1 }}</div>
                        <div class="question-text">{{ $question->question_text }}</div>

                        <div class="options-list">
                            @foreach($question->options as $key => $option)
                                <label class="option-item">
                                    <input type="radio"
                                           name="question_{{ $question->id }}"
                                           value="{{ $key }}"
                                           required>
                                    <span class="option-key">{{ $key }}</span>
                                    <span class="option-text">{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="quiz-actions">
                    <a href="{{ route('materi.show', $material) }}" class="btn-back">← Kembali ke Materi</a>
                    <button type="submit" class="btn-submit">Kirim Jawaban</button>
                </div>
            </form>
        @endif
    </div>

@endsection

@push('styles')
<style>
    .quiz-content {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        margin-top: 120px;
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

    .quiz-form {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .question-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .question-number {
        color: #F0B92F;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }

    .question-text {
        color: #1B5AA1;
        font-size: 1.15rem;
        font-weight: 600;
        margin-bottom: 20px;
        line-height: 1.5;
    }

    .options-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .option-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 2px solid transparent;
    }

    .option-item:hover {
        background: #e9ecef;
        border-color: #1B5AA1;
    }

    .option-item input[type="radio"] {
        display: none;
    }

    .option-item input[type="radio"]:checked + .option-key {
        background: #1B5AA1;
        color: white;
    }

    .option-item input[type="radio"]:checked ~ .option-text {
        color: #1B5AA1;
        font-weight: 600;
    }

    .option-item:has(input[type="radio"]:checked) {
        border-color: #1B5AA1;
        background: #e8f0fe;
    }

    .option-key {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        background: #ddd;
        color: #333;
        border-radius: 50%;
        font-weight: 700;
        font-size: 0.9rem;
        flex-shrink: 0;
        transition: all 0.2s ease;
    }

    .option-text {
        color: #333;
        line-height: 1.4;
        transition: all 0.2s ease;
    }

    .quiz-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .btn-back,
    .btn-submit {
        display: inline-block;
        padding: 14px 30px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
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

    .btn-submit {
        background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        color: white;
        border: none;
        box-shadow: 0 4px 15px rgba(76, 175, 80, 0.4);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(76, 175, 80, 0.5);
    }

    @media (max-width: 768px) {
        .quiz-content {
            padding: 15px;
            margin-top: 100px;
        }

        .question-card {
            padding: 20px;
        }

        .quiz-actions {
            flex-direction: column;
        }

        .btn-back,
        .btn-submit {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endpush
