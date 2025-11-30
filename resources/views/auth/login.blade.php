@extends('layouts.layout')

@section('title', 'Login')

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
        background: linear-gradient(135deg, #007bff, #0056b3);
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
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.4);
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
</style>
@endpush

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h1 class="auth-title">Login</h1>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-input"
                    value="{{ old('email') }}"
                    required
                    autofocus
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
            </div>

            <button type="submit" class="btn-submit">Login</button>
        </form>

        <div class="auth-link">
            Belum punya akun? <a href="{{ route('signup') }}">Daftar disini</a>
        </div>
    </div>
</div>
@endsection
