<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi SMKK')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logow.png') }}">

    <link rel="stylesheet" href="{{ asset('css/judul.css') }}">

    @stack('styles')
</head>

<body class="main-bg @yield('body-class')">

    @include('partials.header')

    <main class="content">
        @yield('content')
    </main>

    @stack('scripts')

    <script>
    function toggleUserMenu() {
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('show');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('userDropdown');
        const iconWrapper = event.target.closest('.icon-wrapper');

        if (!iconWrapper && dropdown) {
            dropdown.classList.remove('show');
        }
    });
    </script>
</body>
</html>
