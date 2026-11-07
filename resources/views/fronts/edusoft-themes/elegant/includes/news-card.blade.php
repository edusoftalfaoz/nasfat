@php
    $img  = site_image($post->image);
    $when = $post->type === 'event' && $post->event_date ? $post->event_date : ($post->published_at ?? $post->created_at);
@endphp
<article class="news-card">
    <a class="news-card__media" href="{{ route('news.show', $post->slug) }}" tabindex="-1" aria-hidden="true">
        @if($img)
            <img src="{{ $img }}" alt="" loading="lazy">
        @else
            <span class="news-card__placeholder">@include('fronts.edusoft-themes.elegant.includes.icon', ['name' => $post->type === 'event' ? 'clock' : 'pencil'])</span>
        @endif
    </a>
    <div class="news-card__body">
        <p class="news-card__meta">
            <span class="tag {{ $post->type === 'event' ? 'tag--gold' : 'tag--blue' }}">{{ $post->type === 'event' ? 'Event' : 'News' }}</span>
            <time datetime="{{ $when?->toDateString() }}">{{ $when?->format('j F Y') }}</time>
        </p>
        <h3 class="h3"><a href="{{ route('news.show', $post->slug) }}">{{ $post->title }}</a></h3>
        <p>{{ $post->summary }}</p>
    </div>
</article>
