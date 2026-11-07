@php
    $mapUrl   = $page->map_embed_url;
    $mapOk    = filled($mapUrl) && \Illuminate\Support\Str::startsWith($mapUrl, 'https://www.google.com/maps/embed');
    $waDigits = preg_replace('/\D/', '', (string) $page->contact_whatsapp);
    $socials  = array_filter([
        'facebook'  => $page->facebook_url,
        'instagram' => $page->instagram_url,
        'x'         => $page->x_url,
        'youtube'   => $page->youtube_url,
    ]);
@endphp

<section class="section contact" id="contact">
    <div class="wrap contact__grid">
        <div class="contact__info">
            <h2 class="h2">{{ $page->contact_heading ?: 'Come and see us' }}</h2>
            @if(filled($page->contact_intro))<p class="lead">{{ $page->contact_intro }}</p>@endif

            <ul class="contact__list">
                @if(filled($schoolDetails['school_address'] ?? null))
                    <li>@include('fronts.edusoft-themes.elegant.includes.icon', ['name' => 'pin'])<span><strong>Address</strong>{!! nl2br(e($schoolDetails['school_address'])) !!}</span></li>
                @endif
                @if(filled($schoolDetails['school_phone'] ?? null))
                    <li>@include('fronts.edusoft-themes.elegant.includes.icon', ['name' => 'phone'])<span><strong>Phone</strong>{!! nl2br(e($schoolDetails['school_phone'])) !!}</span></li>
                @endif
                @if(filled($page->contact_email))
                    <li>@include('fronts.edusoft-themes.elegant.includes.icon', ['name' => 'mail'])<span><strong>Email</strong><a href="mailto:{{ $page->contact_email }}">{{ $page->contact_email }}</a></span></li>
                @endif
                @if(filled($page->office_hours))
                    <li>@include('fronts.edusoft-themes.elegant.includes.icon', ['name' => 'clock'])<span><strong>Office hours</strong>{{ $page->office_hours }}</span></li>
                @endif
            </ul>

            <div class="contact__actions">
                @if($waDigits)
                    <a class="btn btn--green" href="https://wa.me/{{ $waDigits }}" target="_blank" rel="noopener">@include('fronts.edusoft-themes.elegant.includes.icon', ['name' => 'whatsapp']) Chat on WhatsApp</a>
                @endif
                @foreach($socials as $key => $url)
                    <a class="icon-btn" href="{{ $url }}" target="_blank" rel="noopener" aria-label="{{ ucfirst($key) }}">@include('fronts.edusoft-themes.elegant.includes.icon', ['name' => $key])</a>
                @endforeach
            </div>
        </div>

        <div class="contact__form">
            @if(session('contact_success'))
                <div class="alert alert--ok" role="status" tabindex="-1" data-focus-me>
                    <strong>Message sent.</strong> Thank you for writing to us. The school office will reply soon.
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert--error" role="alert" tabindex="-1" data-focus-me>
                    <strong>Please check the form.</strong> Fix the highlighted fields and send again.
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" novalidate data-contact-form>
                @csrf
                <div class="hp" aria-hidden="true">
                    <label>Leave this empty<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                </div>

                <div class="field-row">
                    <div class="field">
                        <label for="c-name">Your name</label>
                        <input id="c-name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name" @error('name') aria-invalid="true" aria-describedby="c-name-err" @enderror>
                        @error('name')<p class="field__error" id="c-name-err">{{ $message }}</p>@enderror
                    </div>
                    <div class="field">
                        <label for="c-email">Email address</label>
                        <input id="c-email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" @error('email') aria-invalid="true" aria-describedby="c-email-err" @enderror>
                        @error('email')<p class="field__error" id="c-email-err">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="field-row">
                    <div class="field">
                        <label for="c-phone">Phone <small>(optional)</small></label>
                        <input id="c-phone" name="phone" type="tel" value="{{ old('phone') }}" autocomplete="tel">
                    </div>
                    <div class="field">
                        <label for="c-subject">Subject</label>
                        <input id="c-subject" name="subject" type="text" value="{{ old('subject') }}" required @error('subject') aria-invalid="true" aria-describedby="c-subject-err" @enderror>
                        @error('subject')<p class="field__error" id="c-subject-err">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="field">
                    <label for="c-message">Message</label>
                    <textarea id="c-message" name="message" rows="5" required @error('message') aria-invalid="true" aria-describedby="c-message-err" @enderror>{{ old('message') }}</textarea>
                    @error('message')<p class="field__error" id="c-message-err">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="btn btn--blue btn--lg" data-submit>Send message</button>
            </form>
        </div>
    </div>

    @if($mapOk)
        <div class="wrap contact__map">
            <iframe src="{{ $mapUrl }}" title="Map showing the school location" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
        </div>
    @endif
</section>
