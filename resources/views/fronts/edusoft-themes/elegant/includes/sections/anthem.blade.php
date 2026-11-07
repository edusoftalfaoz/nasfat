@php
    $arabicLines  = \App\Models\HomepageSetting::lines($page->anthem_arabic);
    $meaningLines = \App\Models\HomepageSetting::lines($page->anthem_meaning);
    $pledge       = collect($page->pledge_items ?? [])->filter(fn ($p) => filled($p['meaning'] ?? null) || filled($p['arabic'] ?? null))->values();
@endphp

@if(($page->show_anthem ?? true) && (count($meaningLines) || count($arabicLines) || $pledge->count()))
<section class="section anthem" id="anthem">
    <div class="wrap">
        @if(count($meaningLines) || count($arabicLines))
            <div class="anthem__block">
                <h2 class="h2">{{ $page->anthem_heading ?: 'Our school anthem' }}</h2>

                @if(count($arabicLines))
                    <p class="anthem__arabic" lang="ar" dir="rtl">
                        @foreach($arabicLines as $line){{ $line }}@if(!$loop->last)<br>@endif @endforeach
                    </p>
                @endif

                @if(count($meaningLines))
                    <p class="anthem__meaning">
                        @foreach($meaningLines as $line){{ $line }}@if(!$loop->last)<br>@endif @endforeach
                    </p>
                @endif
            </div>
        @endif

        @if($pledge->count())
            <div class="pledge">
                <h2 class="h2">{{ $page->pledge_heading ?: 'Our school pledge' }}</h2>
                <ol class="pledge__list" style="--rows: {{ (int) ceil($pledge->count() / 2) }}">
                    @foreach($pledge as $item)
                        <li class="pledge__item">
                            <span class="pledge__num" aria-hidden="true">{{ $loop->iteration }}</span>
                            <div>
                                @if(filled($item['meaning'] ?? null))<p class="pledge__meaning">{{ $item['meaning'] }}</p>@endif
                                @if(filled($item['arabic'] ?? null))<p class="pledge__arabic" lang="ar" dir="rtl">{{ $item['arabic'] }}</p>@endif
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>
        @endif
    </div>
</section>
@endif
