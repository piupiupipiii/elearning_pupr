<header class="header">
    <div class="logo-container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo KemenPU" class="logo">
    </div>

    <div class="auth-links" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%);">
        @auth
            <span style="color: #333; margin-right: 10px;">Halo, {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: #dc3545; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 14px;">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" style="color: #007bff; text-decoration: none; margin-right: 15px; font-weight: 500;">Login</a>
            <a href="{{ route('signup') }}" style="background: #28a745; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 500;">Daftar</a>
        @endauth
    </div>

    <!-- <div class="icon-container">
        <img src="https://cdn-icons-png.flaticon.com/512/1077/1077063.png" alt="User" class="icon">
        <img src="https://cdn-icons-png.flaticon.com/512/4379/4379546.png" alt="Question" class="icon">
        <img src="https://cdn-icons-png.flaticon.com/512/786/786407.png" alt="Audio" class="icon">
    </div> -->
<!--
    Ornamen di pojok kanan atas
    <img src="{{ asset('images/ornamen-atas.png') }}" alt="Ornamen" class="ornamen-kanan"> -->
</header>
