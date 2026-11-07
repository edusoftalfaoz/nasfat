@if($programs->count())
<section class="section programs" id="programs">
    <div class="wrap">
        <div class="section__head">
            <h2 class="h2">What your child will learn</h2>
            <p class="section__intro">A balanced programme that looks after the mind, the body and the heart.</p>
        </div>

        <div class="programs__grid">
            @foreach($programs as $i => $program)
                <article class="program tone-{{ $i % 4 }}">
                    <span class="program__icon">@include('fronts.edusoft-themes.elegant.includes.icon', ['name' => $program->icon])</span>
                    <h3 class="h3">{{ $program->title }}</h3>
                    <p>{{ $program->description }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif
