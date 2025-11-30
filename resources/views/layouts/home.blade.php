@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

    {{-- HOME ICON (global untuk setiap page yang extend layout ini) --}}
    <a href="{{ url('/home') }}" class="home-icon">
        <img src="{{ asset('images/icon/home.png) }}" alt="Home">
    </a>

    {{-- ISI HALAMAN --}}
    <div class="home-icon-content">
        @yield('home-content')
    </div>

@endsection