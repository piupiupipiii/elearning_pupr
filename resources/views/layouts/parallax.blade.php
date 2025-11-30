{{-- resources/views/layouts/parallax.blade.php --}}
@extends('layouts.layout')

@push('styles')
    {{-- background + layout khusus halaman parallax / submenu --}}
    <link rel="stylesheet" href="{{ asset('css/parallax.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
@endpush

@section('content')
    <div class="parallax-wrapper">

        @include('partials.parallax')

        <img src="{{ asset('images/Group 1.png') }}" class="bottom-ornamen" alt="ornamen bottom">

        {{-- konten halaman yang duduk di atas background --}}
        <div class="parallax-inner submenu-main">
            @yield('parallax-content')
        </div>
    </div>
@endsection
