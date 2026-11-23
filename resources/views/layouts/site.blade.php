<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', csetting('site_title'))</title>
    <meta name="description" content="{{ csetting('site_description') }}">
    <meta name="theme-color" content="{{ csetting('color_primary') }}">
    <link rel="canonical" href="{{ url('/') }}">
    <link rel="icon" href="{{ cmedia(csetting('logo_path')) }}">

    <meta property="og:type" content="website">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="{{ csetting('brand_name') }}">
    <meta property="og:title" content="@yield('title', csetting('site_title'))">
    <meta property="og:description" content="{{ csetting('site_description') }}">
    <meta property="og:image" content="{{ cmedia(csetting('logo_path')) }}">
    <meta name="twitter:card" content="summary">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">

    <style>
        :root {
            --c-primary: {{ csetting('color_primary', '#0B3D91') }};
            --c-primary-dark: {{ csetting('color_primary_dark', '#061F4E') }};
            --c-accent: {{ csetting('color_accent', '#FFC42E') }};
            --c-ink: {{ csetting('color_ink', '#0E1A2B') }};
            --c-paper: {{ csetting('color_paper', '#F4F3EF') }};
            --c-line: {{ csetting('color_line', '#E2E1DB') }};
            --c-muted: {{ csetting('color_muted', '#5C6B80') }};
        }
    </style>
</head>
<body>
    <a class="skip-link" href="#konten">Lewati ke konten</a>

    @include('site.partials.header')

    <main id="konten">
        @yield('content')
    </main>

    @include('site.partials.footer')

    <script src="{{ asset('js/site.js') }}" defer></script>
</body>
</html>
