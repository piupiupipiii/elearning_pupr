@extends('layouts.layout')

@section('title', 'Daftar Akun')

@push('styles')
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        overflow-x: hidden;
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
        background: radial-gradient(circle at center, #FBBF24, #B45309);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .left-panel img {
        width: 90%;
        max-width: 650px;
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

    /* Simple geometric deco */
    .deco-box {
        position: absolute;
        width: 150px;
        height: 150px;
        border: 4px solid rgba(255, 255, 255, 0.2);
        transform: rotate(45deg);
        z-index: 1;
    }
    .d1 { top: 10%; left: 10%; }
    .d2 { bottom: 10%; right: 10%; }

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
        max-width: 440px;
        padding: 20px;
        animation: slideInLeft 0.8s ease-out;
    }

    @keyframes slideInLeft {
        from { opacity: 0; transform: translateX(-50px); }
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
        margin-bottom: 35px;
        text-align: left;
    }

    .form-group {
        margin-bottom: 20px;
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
        padding: 12px 16px 12px 45px;
        border: 2px solid #E5E7EB;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
        box-sizing: border-box;
        background: #F9FAFB;
    }

    .form-input:focus {
        outline: none;
        border-color: #F59E0B;
        background: white;
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
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
        color: #F59E0B;
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
        padding: 15px;
        background: #F59E0B;
        color: #1E40AF;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 10px;
        text-transform: uppercase;
    }

    .btn-submit:hover {
        background: #D97706;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
    }

    .auth-link {
        text-align: center;
        margin-top: 25px;
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

    .hint-text {
        font-size: 12px;
        color: #6B7280;
        margin-top: 5px;
    }

    /* Alerts */
    .error-message {
        background: #FEF2F2;
        border: 1px solid #FECACA;
        color: #B91C1C;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .split-container {
            flex-direction: column;
        }
        .left-panel {
            display: none;
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
        <div class="deco-box d1"></div>
        <div class="deco-box d2"></div>
        <img src="{{ asset('images/illust-jembatan.png') }}" alt="Ilustrasi Jembatan">
    </div>

    {{-- Right Panel: Signup Form --}}
    <div class="right-panel">
        <div class="auth-card-simple">
            <h1 class="auth-title">Bergabung Sekarang</h1>
            <p class="auth-subtitle">Daftar akun baru untuk mengakses E-Learning PUPR</p>

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
                    <label class="form-label" for="name">Nama Lengkap</label>
                    <div class="input-wrapper">
                        <input type="text" id="name" name="name" class="form-input" 
                            value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required autofocus>
                        <span class="input-icon">👤</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" class="form-input" 
                            value="{{ old('email') }}" placeholder="nama@email.com" required>
                        <span class="input-icon">📧</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" class="form-input" 
                            placeholder="Minimal 6 karakter..." required>
                        <span class="input-icon">🔒</span>
                        <button type="button" class="password-toggle" onclick="togglePassword('password', this)">👁️</button>
                    </div>
                    <div class="hint-text">Min. 6 karakter, 1 huruf besar, 1 angka</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" 
                            placeholder="Ulangi password..." required>
                        <span class="input-icon">🔐</span>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Daftar Akun</button>
            </form>

            <div class="auth-link">
                Sudah punya akun? <a href="{{ route('login') }}">Login disini</a>
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
        // Auto sync if confirmation field exists
        if(inputId === 'password') {
            const confirmInput = document.getElementById('password_confirmation');
            if(confirmInput) confirmInput.type = 'text';
        }
    } else {
        input.type = 'password';
        button.textContent = '👁️';
        if(inputId === 'password') {
            const confirmInput = document.getElementById('password_confirmation');
            if(confirmInput) confirmInput.type = 'password';
        }
    }
}
</script>
@endsection
