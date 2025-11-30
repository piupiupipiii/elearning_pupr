@extends('layouts.layout')

@section('title', 'Daftar Akun')

@push('styles')
<style>
    .auth-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        padding: 20px;
    }

    .auth-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 16px;
        padding: 40px;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    }

    .auth-title {
        text-align: center;
        color: #333;
        font-size: 28px;
        margin-bottom: 30px;
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        color: #555;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 16px;
        transition: border-color 0.3s ease;
        box-sizing: border-box;
    }

    .form-input:focus {
        outline: none;
        border-color: #007bff;
    }

    .btn-submit {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #28a745, #1e7e34);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
    }

    .auth-link {
        text-align: center;
        margin-top: 20px;
        color: #666;
    }

    .auth-link a {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
    }

    .auth-link a:hover {
        text-decoration: underline;
    }

    .error-message {
        background: #fee;
        border: 1px solid #fcc;
        color: #c00;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .hint-text {
        font-size: 12px;
        color: #888;
        margin-top: 4px;
    }
</style>
@endpush

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h1 class="auth-title">Daftar Akun</h1>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('signup') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="name">Nama</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-input"
                    value="{{ old('name') }}"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-input"
                    value="{{ old('email') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input"
                    required
                >
                <div class="hint-text">Minimal 6 karakter</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="form-input"
                    required
                >
            </div>

            <button type="submit" class="btn-submit">Daftar</button>
        </form>

        <div class="auth-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login disini</a>
        </div>
    </div>
</div>
@endsection
