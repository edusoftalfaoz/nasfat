<div style="display: grid; gap: 1rem;">
    <dl style="display: grid; grid-template-columns: max-content 1fr; gap: .4rem 1.25rem; margin: 0;">
        <dt style="font-weight: 600;">From</dt>
        <dd style="margin: 0;">{{ $record->name }}</dd>

        <dt style="font-weight: 600;">Email</dt>
        <dd style="margin: 0;"><a href="mailto:{{ $record->email }}?subject={{ rawurlencode('Re: ' . $record->subject) }}" style="text-decoration: underline;">{{ $record->email }}</a></dd>

        @if($record->phone)
            <dt style="font-weight: 600;">Phone</dt>
            <dd style="margin: 0;"><a href="tel:{{ preg_replace('/[^\d+]/', '', $record->phone) }}" style="text-decoration: underline;">{{ $record->phone }}</a></dd>
        @endif

        <dt style="font-weight: 600;">Received</dt>
        <dd style="margin: 0;">{{ $record->created_at->format('j F Y, g:i a') }}</dd>
    </dl>

    <hr style="opacity: .2;">

    <div style="white-space: pre-line; line-height: 1.7;">{{ $record->message }}</div>
</div>
