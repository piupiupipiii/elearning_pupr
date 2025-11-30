<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi SMKK')</title>

    <link rel="stylesheet" href="{{ asset('css/judul.css') }}">

    {{-- TARUH INI WAJIB! --}}
    @stack('styles')
</head>

<body class="main-bg @yield('body-class')">

    @include('partials.header')

    <main class="content">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
