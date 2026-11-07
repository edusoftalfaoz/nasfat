@if($features->count())
<section class="section features" id="why-us">
    <div class="wrap">
        <div class="section__head">
            <h2 class="h2">{{ $page->features_heading ?: 'Why parents choose us' }}</h2>
        </div>

        <div class="features__grid">
            @foreach($features as $feature)
                <div class="feature">
                    <span class="feature__icon">@include('fronts.edusoft-themes.elegant.includes.icon', ['name' => $feature->icon])</span>
                    <div>
                        <h3 class="h3">{{ $feature->title }}</h3>
                        <p>{{ $feature->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
