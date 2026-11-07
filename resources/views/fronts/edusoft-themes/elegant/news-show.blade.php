@extends('fronts.edusoft-themes.layouts.app')

@section('title', $post->title . ' | ' . $schoolDetails['school_name'])

@section('content')
    @include('fronts.edusoft-themes.elegant.includes.header')

    @php
        $img        = site_image($post->image);
        $when       = $post->type === 'event' && $post->event_date ? $post->event_date : ($post->published_at ?? $post->created_at);
        $paragraphs = preg_split('/\R{2,}/', trim((string) $post->body)) ?: [];
    @endphp

    <main id="main">
        <article class="article">
            <div class="wrap wrap--narrow">
                <a class="link-back" href="{{ route('news.index') }}">All news and events</a>
                <p class="news-card__meta">
                    <span class="tag {{ $post->type === 'event' ? 'tag--gold' : 'tag--blue' }}">{{ $post->type === 'event' ? 'Event' : 'News' }}</span>
                    <time datetime="{{ $when?->toDateString() }}">{{ $when?->format('j F Y') }}</time>
                </p>
                <h1 class="h1">{{ $post->title }}</h1>

                @if($img)<img class="article__image" src="{{ $img }}" alt="">@endif

                <div class="article__body">
                    @foreach($paragraphs as $para)
                        @if(filled($para))<p>{!! nl2br(e($para)) !!}</p>@endif
                    @endforeach
                </div>
            </div>
        </article>

        @if($more->count())
            <section class="section news">
                <div class="wrap">
                    <div class="section__head"><h2 class="h2">More from the school</h2></div>
                    <div class="news__grid">
                        @foreach($more as $post)
                            @include('fronts.edusoft-themes.elegant.includes.news-card', ['post' => $post])
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </main>

    @include('fronts.edusoft-themes.elegant.includes.footer')
@endsection
