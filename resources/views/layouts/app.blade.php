<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Husein Alhafiz — Portfolio')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @stack('styles')
</head>
<body>
    @include('partials.navbar')
    
    @yield('content')

    @include('partials.footer')

    <a href="#" class="back-to-top">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
    </a>

    @stack('scripts')
</body>
</html>