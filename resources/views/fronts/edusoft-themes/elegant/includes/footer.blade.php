@php
    $logoUrl = site_image($schoolDetails['school_logo'] ?? null);
    $home    = url('/');
    $socials = array_filter([
        'facebook'  => $page->facebook_url ?? null,
        'instagram' => $page->instagram_url ?? null,
        'x'         => $page->x_url ?? null,
        'youtube'   => $page->youtube_url ?? null,
    ]);
    $studentLogin = \Illuminate\Support\Facades\Route::has('filament.student.auth.login') ? route('filament.student.auth.login') : null;
    $staffLogin   = \Illuminate\Support\Facades\Route::has('filament.admin.auth.login') ? route('filament.admin.auth.login') : null;
@endphp

<footer class="site-footer">
    <div class="wrap footer__grid">
        <div class="footer__brand">
            <a class="brand brand--light" href="{{ $home }}">
                @if($logoUrl)<img src="{{ $logoUrl }}" alt="" class="brand__logo" width="52" height="52">@endif
                <span class="brand__name">{{ $schoolDetails['school_name'] }}</span>
            </a>
            @if(filled($page->footer_text))<p>{{ $page->footer_text }}</p>@endif
            @if(count($socials))
                <div class="footer__social">
                    @foreach($socials as $key => $url)
                        <a class="icon-btn icon-btn--light" href="{{ $url }}" target="_blank" rel="noopener" aria-label="{{ ucfirst($key) }}">@include('fronts.edusoft-themes.elegant.includes.icon', ['name' => $key])</a>
                    @endforeach
                </div>
            @endif
        </div>

        <nav class="footer__col" aria-label="Footer">
            <h2 class="footer__title">Explore</h2>
            <a href="{{ $home }}#about">About us</a>
            <a href="{{ $home }}#programs">Programs</a>
            <a href="{{ $home }}#admissions">Admissions</a>
            <a href="{{ route('news.index') }}">News and events</a>
            <a href="{{ $home }}#contact">Contact</a>
        </nav>

        <div class="footer__col">
            <h2 class="footer__title">Portals</h2>
            @if($studentLogin)<a href="{{ $studentLogin }}">Student portal</a>@endif
            @if($staffLogin)<a href="{{ $staffLogin }}">Staff portal</a>@endif
        </div>

        <div class="footer__col">
            <h2 class="footer__title">Visit us</h2>
            @if(filled($schoolDetails['school_address'] ?? null))<p>{!! nl2br(e($schoolDetails['school_address'])) !!}</p>@endif
            @if(filled($schoolDetails['school_phone'] ?? null))<p>{!! nl2br(e($schoolDetails['school_phone'])) !!}</p>@endif
            @if(filled($page->contact_email ?? null))<p><a href="mailto:{{ $page->contact_email }}">{{ $page->contact_email }}</a></p>@endif
        </div>
    </div>

    <div class="footer__base">
        <div class="wrap">
            <p>&copy; {{ date('Y') }} {{ $schoolDetails['school_name'] }}. All rights reserved.</p>
        </div>
    </div>
</footer>
