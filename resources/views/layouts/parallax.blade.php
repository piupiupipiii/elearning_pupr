{{-- resources/views/layouts/parallax.blade.php --}}
@extends('layouts.layout')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/parallax.css') }}">
@endpush

@section('content')
    <div class="parallax-wrapper">
        {{-- include ornaments partial (kanan & bawah) --}}
        @include('partials.parallax')

        {{-- content halaman --}}
        <div class="parallax-inner">
            @yield('parallax-content')
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('js/parallax.js') }}"></script>
@endpush
