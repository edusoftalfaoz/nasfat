@php
    $siteName   = $schoolDetails['school_name'] ?? 'School';
    $metaTitle  = $schoolDetails['meta_title'] ?: $siteName;
    $favicon    = site_image($schoolDetails['school_favicon'] ?? null);
    $logoUrl    = site_image($schoolDetails['school_logo'] ?? null);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script>document.documentElement.classList.add('js');</script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@hasSection('title')@yield('title')@else{{ $metaTitle }}@endif</title>

    <meta name="description" content="{{ $schoolDetails['meta_description'] ?? '' }}">
    <meta name="keywords" content="{{ $schoolDetails['meta_keywords'] ?? '' }}">
    <meta name="theme-color" content="#0f2e7a">

    {{-- Social sharing --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $schoolDetails['meta_description'] ?? '' }}">
    @if($logoUrl)<meta property="og:image" content="{{ $logoUrl }}">@endif

    @if($favicon)<link rel="icon" href="{{ $favicon }}">@endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Figtree:wght@400;500;600;700&family=Young+Serif&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/themes/elegant.css') }}?v={{ @filemtime(public_path('css/themes/elegant.css')) }}">
    @yield('styles')
    @stack('styles')
</head>
<body>
    <a class="skip-link" href="#main">Skip to content</a>

    @yield('content')

    <script src="{{ asset('js/themes/elegant.js') }}?v={{ @filemtime(public_path('js/themes/elegant.js')) }}" defer></script>
    @stack('scripts')
</body>
</html>
