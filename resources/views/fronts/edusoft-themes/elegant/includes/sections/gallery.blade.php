@if($gallery->count())
<section class="section gallery" id="gallery">
    <div class="wrap">
        <div class="section__head">
            <h2 class="h2">Life at our school</h2>
            <p class="section__intro">Select a photo to see it larger.</p>
        </div>

        <div class="gallery__grid">
            @foreach($gallery as $item)
                @php $src = site_image($item->image); @endphp
                @if($src)
                    <button type="button" class="gallery__item" data-lightbox="{{ $src }}" data-caption="{{ $item->title }}">
                        <img src="{{ $src }}" alt="{{ $item->title ?: 'School photo' }}" loading="lazy">
                        @if(filled($item->title))<span class="gallery__caption">{{ $item->title }}</span>@endif
                    </button>
                @endif
            @endforeach
        </div>
    </div>

    <dialog class="lightbox" data-lightbox-dialog aria-label="Photo viewer">
        <form method="dialog"><button class="lightbox__close" aria-label="Close photo">&times;</button></form>
        <img src="" alt="" data-lightbox-img>
        <p class="lightbox__caption" data-lightbox-caption></p>
    </dialog>
</section>
@endif
