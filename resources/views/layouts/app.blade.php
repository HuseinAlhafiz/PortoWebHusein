<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Husein Alhafiz — Portfolio')</title>
    <!-- SEO & Open Graph Meta Tags -->
    <meta name="description" content="Husein Alhafiz - IT Project Management Officer, UI/UX Enthusiast, and Web Developer. Welcome to my professional portfolio.">
    <meta name="keywords" content="Husein Alhafiz, Portfolio, IT PMO, Frontend Developer, Laravel, UI/UX">
    <meta name="author" content="Husein Alhafiz">
    
    <meta property="og:title" content="Husein Alhafiz — Professional Portfolio">
    <meta property="og:description" content="IT Project Management Officer, UI/UX Enthusiast, and Web Developer. Welcome to my professional portfolio.">
    <meta property="og:image" content="{{ asset('images/husein.png') }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Husein Alhafiz — Professional Portfolio">
    <meta name="twitter:description" content="IT Project Management Officer, UI/UX Enthusiast, and Web Developer.">
    <meta name="twitter:image" content="{{ asset('images/husein.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @stack('styles')
    <style>
        /* CSS Variables for Dark Mode are in home.css */
        /* Ensure smooth transition for background and color */
        body { transition: background-color 0.3s ease, color 0.3s ease; }
    </style>
</head>
<body>
    @include('partials.navbar')
    
    @yield('content')

    @include('partials.footer')

    <a href="#" class="back-to-top">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
    </a>

    @stack('scripts')
    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const html = document.documentElement;

        const sunIcon = `<circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>`;
        const moonIcon = `<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>`;

        // Cek LocalStorage
        if (localStorage.getItem('theme') === 'dark') {
            html.setAttribute('data-theme', 'dark');
            themeIcon.innerHTML = sunIcon;
        } else {
            themeIcon.innerHTML = moonIcon;
        }

        themeToggle.addEventListener('click', () => {
            if (html.getAttribute('data-theme') === 'dark') {
                html.removeAttribute('data-theme');
                localStorage.setItem('theme', 'light');
                themeIcon.innerHTML = moonIcon;
            } else {
                html.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
                themeIcon.innerHTML = sunIcon;
            }
        });
    </script>
</body>
</html>