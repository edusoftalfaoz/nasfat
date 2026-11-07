@php
    $aboutImg1  = site_image($page->about_image, 'school-images/mosque-front.jpg');
    $aboutImg2  = site_image($page->about_image_2, 'school-images/building-1.jpg');
    $paragraphs = preg_split('/\R{2,}/u', trim((string) $page->about_body)) ?: [];
    $highlights = collect($page->about_highlights ?? [])->pluck('text')->filter()->values();
@endphp

<section class="section about" id="about">
    <div class="wrap about__grid">
        <div class="about__art" aria-hidden="true">
            <figure class="arch arch--a"><img src="{{ $aboutImg1 }}" alt="" loading="lazy"></figure>
            <figure class="arch arch--b"><img src="{{ $aboutImg2 }}" alt="" loading="lazy"></figure>
        </div>

        <div class="about__copy">
            <h2 class="h2">{{ $page->about_heading ?: 'About our school' }}</h2>
            @if(filled($page->about_lead))<p class="lead">{{ $page->about_lead }}</p>@endif

            @foreach($paragraphs as $para)
                @if(filled($para))<p>{!! nl2br(e($para)) !!}</p>@endif
            @endforeach

            @if($highlights->count())
                <ul class="ticks">
                    @foreach($highlights as $item)
                        <li>@include('fronts.edusoft-themes.elegant.includes.icon', ['name' => 'check']) <span>{{ $item }}</span></li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</section>
