@php
    $headName   = $schoolDetails['principal_name'] ?? '';
    $headPhoto  = site_image($page->head_photo, 'school-images/head-of-school.jpg');
    $signature  = site_image($schoolDetails['principal_signature'] ?? null);
    $paragraphs = preg_split('/\R{2,}/', trim((string) $page->head_message)) ?: [];
@endphp

@if(count(array_filter($paragraphs)))
<section class="section head" id="head">
    <div class="wrap head__grid">
        <figure class="arch head__photo">
            <img src="{{ $headPhoto }}" alt="{{ $headName ?: 'Head of School' }}" loading="lazy">
        </figure>

        <div class="head__copy">
            <h2 class="h2">{{ $page->head_heading ?: 'A word from our Head of School' }}</h2>

            <div class="head__message">
                @foreach($paragraphs as $i => $para)
                    @if(filled($para))<p class="{{ $i === 0 ? 'head__first' : '' }}">{!! nl2br(e($para)) !!}</p>@endif
                @endforeach
            </div>

            <div class="head__sign">
                @if($signature)<img src="{{ $signature }}" alt="Signature of {{ $headName ?: 'the Head of School' }}" class="head__signature" loading="lazy">@endif
                <p class="head__name">{{ $headName ?: ($page->head_title ?: 'Head of School') }}</p>
                @if($headName)<p class="head__title">{{ $page->head_title ?: 'Head of School' }}</p>@endif
            </div>
        </div>
    </div>
</section>
@endif
