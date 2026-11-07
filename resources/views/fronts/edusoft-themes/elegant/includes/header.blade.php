@php
    $page      = $page ?? new \App\Models\HomepageSetting();
    $logoUrl   = site_image($schoolDetails['school_logo'] ?? null);
    $phone     = $schoolDetails['school_phone'] ?? '';
    preg_match('/\+?\d[\d\s\-()]{6,}\d/', $phone, $m);
    $telHref   = isset($m[0]) ? 'tel:' . preg_replace('/[^\d+]/', '', $m[0]) : null;
    $home      = url('/');

    try { $navNews = \App\Models\NewsPost::published()->exists(); } catch (\Throwable $e) { $navNews = false; }
    $navGallery = isset($gallery) && $gallery->count() > 0;

    $studentLogin = \Illuminate\Support\Facades\Route::has('filament.student.auth.login') ? route('filament.student.auth.login') : null;
    $staffLogin   = \Illuminate\Support\Facades\Route::has('filament.admin.auth.login') ? route('filament.admin.auth.login') : null;
@endphp

@if($page->announcement_enabled && filled($page->announcement_text))
    <div class="announce">
        <div class="wrap announce__inner">
            <p>{{ $page->announcement_text }}</p>
            @if(filled($page->announcement_url))
                <a href="{{ \Illuminate\Support\Str::startsWith($page->announcement_url, '#') ? $home . $page->announcement_url : $page->announcement_url }}">Find out more @include('fronts.edusoft-themes.elegant.includes.icon', ['name' => 'arrow'])</a>
            @endif
        </div>
    </div>
@endif

<header class="site-header" id="top">
    <div class="topbar">
        <div class="wrap topbar__inner">
            @if(filled($schoolDetails['school_address'] ?? null))
                <span>@include('fronts.edusoft-themes.elegant.includes.icon', ['name' => 'pin']) {{ \Illuminate\Support\Str::limit($schoolDetails['school_address'], 90) }}</span>
            @endif
            @if($telHref)
                <a href="{{ $telHref }}">@include('fronts.edusoft-themes.elegant.includes.icon', ['name' => 'phone']) {{ $phone }}</a>
            @endif
        </div>
    </div>

    <div class="navbar">
        <div class="wrap navbar__inner">
            <a class="brand" href="{{ $home }}" aria-label="{{ $schoolDetails['school_name'] }} home">
                @if($logoUrl)
                    <img src="{{ $logoUrl }}" alt="" class="brand__logo" width="52" height="52">
                @endif
                <span class="brand__name">{{ $schoolDetails['school_name'] }}</span>
            </a>

            <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" data-nav-toggle>
                <span class="nav-toggle__bars" aria-hidden="true"></span>
                <span class="sr-only">Menu</span>
            </button>

            <nav class="nav" id="site-nav" aria-label="Main">
                <ul class="nav__list">
                    <li><a href="{{ $home }}">Home</a></li>
                    <li><a href="{{ $home }}#about">About</a></li>
                    <li><a href="{{ $home }}#programs">Programs</a></li>
                    <li><a href="{{ $home }}#admissions">Admissions</a></li>
                    @if($navGallery)<li><a href="{{ $home }}#gallery">Gallery</a></li>@endif
                    @if($navNews)<li><a href="{{ route('news.index') }}">News</a></li>@endif
                    <li><a href="{{ $home }}#contact">Contact</a></li>
                </ul>

                <div class="nav__actions">
                    @if($studentLogin || $staffLogin)
                        <details class="portals">
                            <summary>Portals</summary>
                            <div class="portals__menu">
                                @if($studentLogin)<a href="{{ $studentLogin }}">Student portal</a>@endif
                                @if($staffLogin)<a href="{{ $staffLogin }}">Staff portal</a>@endif
                            </div>
                        </details>
                    @endif
                    <a class="btn btn--gold" href="{{ $home }}#admissions">Apply now</a>
                </div>
            </nav>
        </div>
    </div>
</header>
