@extends('layouts.layout')

@section('title', 'Profil Pengguna')

@push('styles')
<style>
    .profile-container {
        padding: 40px 60px;
        min-height: 80vh;
        max-width: 1200px;
        margin: 0 auto;
        color: #333;
    }

    .profile-header {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 8px;
        background: linear-gradient(90deg, #1E40AF, #0066CC, #FBBF24);
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        background: #EFF6FF;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 30px;
        border: 4px solid #DBEAFE;
    }

    .profile-avatar img {
        width: 50px;
        height: 50px;
        opacity: 0.8;
    }

    .profile-info h1 {
        margin: 0;
        font-size: 28px;
        color: #1E3A8A;
        font-weight: 700;
    }

    .profile-info p {
        margin: 5px 0 0;
        color: #6B7280;
        font-size: 16px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-value {
        font-size: 48px;
        font-weight: 800;
        color: #F59E0B;
        margin-bottom: 5px;
        line-height: 1;
    }

    .stat-label {
        color: #6B7280;
        font-size: 16px;
        font-weight: 500;
    }
    
    .progress-track {
        font-size: 20px;
        color: #1E3A8A;
        font-weight: 600;
    }

    .section-title {
        font-size: 24px;
        font-weight: 700;
        color: white;
        margin-bottom: 20px;
        border-left: 5px solid #F59E0B;
        padding-left: 15px;
    }

    .history-table {
        width: 100%;
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        border-collapse: collapse;
        overflow: hidden;
    }

    .history-table th,
    .history-table td {
        padding: 20px;
        text-align: left;
    }

    .history-table th {
        background: #EFF6FF;
        color: #1E3A8A;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.5px;
    }

    .history-table tr {
        border-bottom: 1px solid #F3F4F6;
    }

    .history-table tr:last-child {
        border-bottom: none;
    }

    .history-table tr:hover {
        background: #FAFAFA;
    }

    .score-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 14px;
    }

    .score-high {
        background: #D1FAE5;
        color: #065F46;
    }

    .score-medium {
        background: #FEF3C7;
        color: #92400E;
    }

    .score-low {
        background: #FEE2E2;
        color: #991B1B;
    }
    
    .empty-state {
        text-align: center;
        padding: 40px;
        color: #9CA3AF;
        background: white;
        border-radius: 16px;
    }

    /* Back Button - matches other pages */
    .btn-back {
        position: fixed;
        top: 88px;
        left: 80px;
        background: none;
        border: none;
        cursor: pointer;
        transition: transform 0.2s ease;
        z-index: 9999;
        padding: 0;
    }

    .btn-back:hover {
        transform: scale(1.1);
    }

    .btn-back img {
        width: 65px;
        height: 65px;
        filter: drop-shadow(0px 3px 5px rgba(0,0,0,0.3));
    }
</style>
@endpush

@section('content')
<div class="profile-container">
    <button class="btn-back" onclick="history.back()">
        <img src="{{ asset('images/icon/back.png') }}" alt="Kembali">
    </button>

    <div class="profile-header">
        <div class="profile-avatar">
            <img src="https://cdn-icons-png.flaticon.com/512/1077/1077063.png" alt="User">
        </div>
        <div class="profile-info">
            <h1>{{ $user->name }}</h1>
            <p>{{ $user->email }}</p>
            <p>Bergabung sejak {{ $user->created_at->format('d M Y') }}</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value">{{ $watchedCount }} / {{ $totalMaterials }}</div>
            <div class="stat-label">Video Pembelajaran Ditonton</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-value">
                @if($quizScores->count() > 0)
                    {{ round($quizScores->avg('score')) }}
                @else
                    -
                @endif
            </div>
            <div class="stat-label">Rata-rata Nilai Kuis</div>
        </div>
    </div>

    <h2 class="section-title">Riwayat Nilai Kuis</h2>

    @if($quizScores->count() > 0)
    <table class="history-table">
        <thead>
            <tr>
                <th>Materi</th>
                <th>Tanggal</th>
                <th>Benar / Total</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quizScores as $score)
            <tr>
                <td>SEKSI {{ $score->material->section_number }} - {{ $score->material->title }}</td>
                <td>{{ $score->created_at->format('d M Y, H:i') }}</td>
                <td>{{ $score->correct_answers }} / {{ $score->total_questions }}</td>
                <td>
                    @php
                        $badgeClass = 'score-low';
                        if ($score->score >= 80) $badgeClass = 'score-high';
                        elseif ($score->score >= 60) $badgeClass = 'score-medium';
                    @endphp
                    <span class="score-badge {{ $badgeClass }}">
                        {{ $score->score }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="empty-state">
        <p>Belum ada riwayat kuis yang dikerjakan.</p>
    </div>
    @endif
</div>
@endsection
