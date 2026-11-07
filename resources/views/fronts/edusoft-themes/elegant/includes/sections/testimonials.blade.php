@if($testimonials->count())
<section class="section testimonials" id="testimonials">
    <div class="wrap">
        <div class="section__head">
            <h2 class="h2">What our community says</h2>
        </div>

        <div class="quotes" tabindex="0" role="group" aria-label="Testimonials">
            @foreach($testimonials as $t)
                @php $photo = site_image($t->photo); @endphp
                <figure class="quote">
                    <blockquote><p>{{ $t->quote }}</p></blockquote>
                    <figcaption>
                        @if($photo)
                            <img src="{{ $photo }}" alt="" class="quote__photo" loading="lazy">
                        @else
                            <span class="quote__photo quote__photo--initial" aria-hidden="true">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($t->name, 0, 1)) }}</span>
                        @endif
                        <span><strong>{{ $t->name }}</strong>@if(filled($t->role))<small>{{ $t->role }}</small>@endif</span>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
@endif
