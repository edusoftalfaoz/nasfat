@php
    $heroTitle    = $page->hero_title ?: 'Inspiring minds, shaping futures';
    $heroSubtitle = $page->hero_subtitle ?: 'Welcome to ' . $schoolDetails['school_name'] . ', where every child discovers their potential and grows in a supportive community.';
    $heroImg1     = site_image($page->hero_image, 'school-images/school-block-bus.jpg');
    $heroImg2     = site_image($page->hero_image_2, 'school-images/mosque-dome.jpg');

    $fixHref = fn ($url) => \Illuminate\Support\Str::startsWith((string) $url, '#') ? url('/') . $url : $url;

    $statItems = [];
    if ($page->show_stats ?? true) {
        foreach ([['totalStudents', 'Pupils'], ['totalTeachers', 'Teachers'], ['totalClasses', 'Classes']] as [$key, $label]) {
            $val = $stats[$key] ?? '0';
            if ($val !== '0' && $val !== '') { $statItems[] = [$val, $label]; }
        }
    }
@endphp

<section class="hero" aria-labelledby="hero-title">
    <div class="hero__arches" aria-hidden="true"></div>

    <div class="wrap hero__grid">
        <div class="hero__copy">
            @if(filled($page->hero_badge))
                <p class="badge"><span class="badge__dot" aria-hidden="true"></span>{{ $page->hero_badge }}</p>
            @endif

            <h1 id="hero-title" class="hero__title">{{ $heroTitle }}</h1>
            <p class="hero__lead">{{ $heroSubtitle }}</p>

            <div class="hero__actions">
                @if(filled($page->hero_primary_text))
                    <a class="btn btn--gold btn--lg" href="{{ $fixHref($page->hero_primary_url ?: '#admissions') }}">{{ $page->hero_primary_text }}</a>
                @endif
                @if(filled($page->hero_secondary_text))
                    <a class="btn btn--ghost btn--lg" href="{{ $fixHref($page->hero_secondary_url ?: '#about') }}">{{ $page->hero_secondary_text }}</a>
                @endif
            </div>
        </div>

        <div class="hero__art" aria-hidden="true">
            <figure class="arch arch--main"><img src="{{ $heroImg1 }}" alt="" fetchpriority="high"></figure>
            <figure class="arch arch--small"><img src="{{ $heroImg2 }}" alt="" loading="lazy"></figure>
            <span class="hero__sun"></span>
        </div>
    </div>
</section>

@if(count($statItems))
    <section class="stats" aria-label="School at a glance">
        <div class="wrap stats__inner">
            @foreach($statItems as [$value, $label])
                <p class="stat"><strong>{{ $value }}</strong><span>{{ $label }}</span></p>
            @endforeach
        </div>
    </section>
@endif
