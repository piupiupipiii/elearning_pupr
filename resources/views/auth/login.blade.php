@extends('layouts.layout')

@section('title', 'Login')

@push('styles')
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .auth-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .auth-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 50px 45px;
        width: 100%;
        max-width: 440px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3), 
                    0 0 0 1px rgba(255, 255, 255, 0.5) inset;
        position: relative;
        z-index: 1;
        animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .auth-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #1E40AF, #0066CC, #FBBF24);
        border-radius: 24px 24px 0 0;
    }

    .auth-logo {
        text-align: center;
        margin-bottom: 10px;
    }

    .auth-logo-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #1E40AF, #0066CC);
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #FBBF24;
        font-size: 32px;
        font-weight: bold;
        box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
        margin-bottom: 5px;
    }

    .auth-title {
        text-align: center;
        background: linear-gradient(135deg, #1E40AF, #0066CC);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 32px;
        margin-bottom: 10px;
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    .auth-subtitle {
        text-align: center;
        color: #666;
        font-size: 14px;
        margin-bottom: 35px;
        font-weight: 400;
    }

    .form-group {
        margin-bottom: 24px;
        position: relative;
    }

    .form-label {
        display: block;
        color: #1E40AF;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #0066CC;
        font-size: 18px;
        pointer-events: none;
        transition: color 0.3s ease;
    }

    .password-toggle {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #0066CC;
        font-size: 18px;
        cursor: pointer;
        padding: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.3s ease;
    }

    .password-toggle:hover {
        color: #FBBF24;
    }

    .form-input {
        width: 100%;
        padding: 14px 16px 14px 48px;
        border: 2px solid #E5E7EB;
        border-radius: 12px;
        font-size: 15px;
        transition: all 0.3s ease;
        box-sizing: border-box;
        background: #FAFAFA;
    }

    .form-input:focus {
        outline: none;
        border-color: #0066CC;
        background: white;
        box-shadow: 0 0 0 4px rgba(0, 102, 204, 0.1);
    }

    .form-input:focus + .input-icon {
        color: #FBBF24;
    }

    .btn-submit {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #1E40AF 0%, #0066CC 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
        margin-top: 10px;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(251, 191, 36, 0.3), transparent);
        transition: left 0.5s ease;
    }

    .btn-submit:hover::before {
        left: 100%;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(30, 64, 175, 0.4);
    }

    .btn-submit:active {
        transform: translateY(-1px);
    }

    .auth-link {
        text-align: center;
        margin-top: 28px;
        color: #666;
        font-size: 14px;
    }

    .auth-link a {
        color: #0066CC;
        text-decoration: none;
        font-weight: 600;
        position: relative;
        transition: color 0.3s ease;
    }

    .auth-link a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #0066CC, #FBBF24);
        transition: width 0.3s ease;
    }

    .auth-link a:hover {
        color: #1E40AF;
    }

    .auth-link a:hover::after {
        width: 100%;
    }

    .error-message {
        background: linear-gradient(135deg, #FEE2E2, #FECACA);
        border: 2px solid #F87171;
        color: #991B1B;
        padding: 14px 16px;
        border-radius: 12px;
        margin-bottom: 24px;
        font-size: 14px;
        font-weight: 500;
        animation: shake 0.5s ease;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-10px); }
        75% { transform: translateX(10px); }
    }

    .error-message div {
        margin-bottom: 4px;
    }

    .error-message div:last-child {
        margin-bottom: 0;
    }

    .success-message {
        background: linear-gradient(135deg, #D1FAE5, #A7F3D0);
        border: 2px solid #34D399;
        color: #065F46;
        padding: 14px 16px;
        border-radius: 12px;
        margin-bottom: 24px;
        font-size: 14px;
        font-weight: 500;
        animation: slideDown 0.5s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 480px) {
        .auth-card {
            padding: 40px 30px;
        }
        
        .auth-title {
            font-size: 26px;
        }
    }
</style>
@endpush

@section('content')
<div class="auth-container">
    <div class="auth-card">

        <h1 class="auth-title">Selamat Datang</h1>
        <p class="auth-subtitle">Silakan login untuk melanjutkan ke E-Learning PUPR</p>

        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

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
                <div class="input-wrapper">
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        autocomplete="new-password"
                        readonly
                        onfocus="this.removeAttribute('readonly');"
                        required
                        autofocus
                    >
                    <span class="input-icon">📧</span>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="input-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input"
                        placeholder="Masukkan password Anda"
                        autocomplete="new-password"
                        readonly
                        onfocus="this.removeAttribute('readonly');"
                        required
                    >
                    <span class="input-icon">🔒</span>
                    <button type="button" class="password-toggle" onclick="togglePassword('password', this)">
                        👁️
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-submit">Masuk</button>
        </form>

        <div class="auth-link">
            Belum punya akun? <a href="{{ route('signup') }}">Daftar disini</a>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, button) {
    const input = document.getElementById(inputId);
    if (input.type === 'password') {
        input.type = 'text';
        button.textContent = '👁️‍🗨️';
    } else {
        input.type = 'password';
        button.textContent = '👁️';
    }
}
</script>
@endsection
