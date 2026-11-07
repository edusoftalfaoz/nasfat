@extends('fronts.edusoft-themes.layouts.app')

@section('title', 'News and events | ' . $schoolDetails['school_name'])

@section('content')
    @include('fronts.edusoft-themes.elegant.includes.header')

    <main id="main">
        <section class="page-head">
            <div class="wrap">
                <h1 class="h1">News and events</h1>
                <p class="lead">The latest from {{ $schoolDetails['school_name'] }}.</p>
            </div>
        </section>

        <section class="section">
            <div class="wrap">
                @if($posts->count())
                    <div class="news__grid">
                        @foreach($posts as $post)
                            @include('fronts.edusoft-themes.elegant.includes.news-card', ['post' => $post])
                        @endforeach
                    </div>

                    @if($posts->hasPages())
                        <nav class="pager" aria-label="Pagination">
                            @if($posts->onFirstPage())<span class="pager__link is-off">Newer</span>@else<a class="pager__link" href="{{ $posts->previousPageUrl() }}">Newer</a>@endif
                            <span class="pager__count">Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</span>
                            @if($posts->hasMorePages())<a class="pager__link" href="{{ $posts->nextPageUrl() }}">Older</a>@else<span class="pager__link is-off">Older</span>@endif
                        </nav>
                    @endif
                @else
                    <div class="empty">
                        <h2 class="h3">Nothing posted yet</h2>
                        <p>New stories and events will appear here. Check back soon.</p>
                        <a class="btn btn--blue" href="{{ url('/') }}">Back to home</a>
                    </div>
                @endif
            </div>
        </section>
    </main>

    @include('fronts.edusoft-themes.elegant.includes.footer')
@endsection
