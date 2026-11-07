@if($news->count())
<section class="section news" id="news">
    <div class="wrap">
        <div class="section__head section__head--row">
            <h2 class="h2">News and events</h2>
            <a class="link-arrow" href="{{ route('news.index') }}">All news @include('fronts.edusoft-themes.elegant.includes.icon', ['name' => 'arrow'])</a>
        </div>

        <div class="news__grid">
            @foreach($news as $post)
                @include('fronts.edusoft-themes.elegant.includes.news-card', ['post' => $post])
            @endforeach
        </div>
    </div>
</section>
@endif
