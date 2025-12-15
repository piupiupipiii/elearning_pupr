@extends('layouts.layout')

@section('title', 'Login')

@push('styles')
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        overflow: hidden; /* Prevent scroll on desktop if possible */
    }

    .split-container {
        display: flex;
        min-height: 100vh;
        width: 100%;
        background: white;
    }

    /* Left Side: Illustration */
    .left-panel {
        flex: 1;
        background: radial-gradient(circle at center, #297BD8, #183658);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .left-panel img {
        width: 90%;
        max-width: 600px;
        height: auto;
        object-fit: contain;
        position: relative;
        z-index: 2;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    /* Decorative circles/elements on left panel */
    .circle-deco {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        z-index: 1;
    }

    .c1 { width: 300px; height: 300px; top: -50px; left: -50px; }
    .c2 { width: 200px; height: 200px; bottom: 50px; right: 50px; }

    /* Right Side: Form */
    .right-panel {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        padding: 40px;
        position: relative;
    }

    .auth-card-simple {
        width: 100%;
        max-width: 420px;
        padding: 20px;
        animation: slideInRight 0.8s ease-out;
    }

    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(50px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .auth-title {
        font-size: 32px;
        font-weight: 700;
        color: #1E40AF;
        margin-bottom: 10px;
        text-align: left;
    }

    .auth-subtitle {
        color: #6B7280;
        font-size: 16px;
        margin-bottom: 40px;
        text-align: left;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        color: #374151;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .input-wrapper {
        position: relative;
    }

    .form-input {
        width: 100%;
        padding: 14px 16px 14px 45px;
        border: 2px solid #E5E7EB;
        border-radius: 12px;
        font-size: 15px;
        transition: all 0.3s ease;
        box-sizing: border-box;
        background: #F9FAFB;
    }

    .form-input:focus {
        outline: none;
        border-color: #2563EB;
        background: white;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 18px;
        color: #9CA3AF;
        transition: color 0.3s;
    }

    .form-input:focus + .input-icon {
        color: #2563EB;
    }

    .password-toggle {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
        color: #9CA3AF;
    }

    .btn-submit {
        width: 100%;
        padding: 16px;
        background: #2563EB;
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 20px;
    }

    .btn-submit:hover {
        background: #1D4ED8;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
    }

    .auth-link {
        text-align: center;
        margin-top: 30px;
        color: #6B7280;
        font-size: 14px;
    }

    .auth-link a {
        color: #2563EB;
        text-decoration: none;
        font-weight: 600;
    }

    .auth-link a:hover {
        text-decoration: underline;
    }

    /* Alerts */
    .error-message {
        background: #FEF2F2;
        border: 1px solid #FECACA;
        color: #B91C1C;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .success-message {
        background: #ECFDF5;
        border: 1px solid #A7F3D0;
        color: #047857;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .split-container {
            flex-direction: column;
        }
        .left-panel {
            display: none; /* Hide image on mobile for cleaner look */
        }
        .right-panel {
            padding: 20px;
        }
        .auth-card-simple {
            max-width: 100%;
            padding: 10px;
        }
    }
</style>
@endpush

@section('content')
<div class="split-container">
    {{-- Left Panel: Illustration --}}
    <div class="left-panel">
        <div class="circle-deco c1"></div>
        <div class="circle-deco c2"></div>
        <img src="{{ asset('images/illust-kontruksi.png') }}" alt="Ilustrasi Konstruksi">
    </div>

    {{-- Right Panel: Login Form --}}
    <div class="right-panel">
        <div class="auth-card-simple">
            <h1 class="auth-title">Selamat Datang</h1>
            <p class="auth-subtitle">Silakan login untuk melanjutkan ke E-Learning PUPR</p>

            @if (session('success'))
                <div class="success-message">{{ session('success') }}</div>
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
                        <input type="email" id="email" name="email" class="form-input" 
                            value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
                        <span class="input-icon">📧</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" class="form-input" 
                            placeholder="••••••••" required>
                        <span class="input-icon">🔒</span>
                        <button type="button" class="password-toggle" onclick="togglePassword('password', this)">👁️</button>
                    </div>
                </div>

                <button type="submit" class="btn-submit">MASUK</button>
            </form>

            <div class="auth-link">
                Belum punya akun? <a href="{{ route('signup') }}">Daftar disini</a>
            </div>
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
