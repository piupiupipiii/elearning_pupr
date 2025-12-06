<header class="header">
    <div class="logo-container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo KemenPU" class="logo">
    </div>

    <div class="icon-container">
        @auth
            <!-- User Icon: Shows dropdown with name and logout -->
            <div class="icon-wrapper" onclick="toggleUserMenu()">
                <img src="https://cdn-icons-png.flaticon.com/512/1077/1077063.png" alt="User" class="icon">
                <div class="user-dropdown" id="userDropdown">
                    <span>{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
        @else
            <!-- User Icon: Links to login page -->
            <a href="{{ route('login') }}">
                <img src="{{ asset('images/icon/pro.png') }}" alt="User" class="icon">
            </a>
        @endauth

        <!-- Question Icon: No-op for now -->
        <img src="https://cdn-icons-png.flaticon.com/512/4379/4379546.png" alt="Question" class="icon">
    </div>
</header>
