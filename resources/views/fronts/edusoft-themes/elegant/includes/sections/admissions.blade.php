@php
    $steps = collect($page->admissions_steps ?? [])->filter(fn ($s) => filled($s['title'] ?? null))->values();
    $fix   = fn ($url) => \Illuminate\Support\Str::startsWith((string) $url, '#') ? url('/') . $url : $url;
@endphp

<section class="section admissions" id="admissions">
    <div class="wrap admissions__grid">
        <div class="admissions__main">
            <h2 class="h2">{{ $page->admissions_heading ?: 'How to join our school' }}</h2>
            @if(filled($page->admissions_intro))<p class="lead">{{ $page->admissions_intro }}</p>@endif

            @if($steps->count())
                <ol class="steps">
                    @foreach($steps as $step)
                        <li class="step">
                            <span class="step__num" aria-hidden="true">{{ $loop->iteration }}</span>
                            <div>
                                <h3 class="h3">{{ $step['title'] }}</h3>
                                @if(filled($step['description'] ?? null))<p>{{ $step['description'] }}</p>@endif
                            </div>
                        </li>
                    @endforeach
                </ol>
            @endif

            @if(filled($page->admissions_cta_text))
                <a class="btn btn--blue btn--lg" href="{{ $fix($page->admissions_cta_url ?: '#contact') }}">{{ $page->admissions_cta_text }}</a>
            @endif
        </div>

        <aside class="admissions__side">
            @if(filled($page->curriculum_text))
                <div class="panel panel--blue">
                    <h3 class="h3">{{ $page->curriculum_heading ?: 'Our curriculum' }}</h3>
                    <p>{{ $page->curriculum_text }}</p>
                </div>
            @endif

            @if(filled($page->fees_text))
                <div class="panel panel--gold">
                    <h3 class="h3">{{ $page->fees_heading ?: 'Tuition fees' }}</h3>
                    <p>{{ $page->fees_text }}</p>
                    @if(filled($page->fees_cta_text))
                        <a class="link-arrow" href="{{ $fix($page->fees_cta_url ?: '#contact') }}">{{ $page->fees_cta_text }} @include('fronts.edusoft-themes.elegant.includes.icon', ['name' => 'arrow'])</a>
                    @endif
                </div>
            @endif
        </aside>
    </div>
</section>
