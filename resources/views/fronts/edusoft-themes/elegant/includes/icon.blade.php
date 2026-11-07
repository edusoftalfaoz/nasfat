{{-- Inline SVG icons: <x-… not needed, use @include('…icon', ['name' => 'book']) --}}
@php $name = $name ?? 'book'; @endphp
<svg class="icon" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
@switch($name)
    @case('book')
        <path d="M12 6.5C10.3 5 8 4.5 4 4.5v13c4 0 6.3.5 8 2 1.7-1.5 4-2 8-2v-13c-4 0-6.3.5-8 2z"/><path d="M12 6.5v13"/>
        @break
    @case('flask')
        <path d="M9 3h6"/><path d="M10 3v6L4.5 18.5A2 2 0 0 0 6.2 21.5h11.6a2 2 0 0 0 1.7-3L14 9V3"/><path d="M7.5 15h9"/>
        @break
    @case('palette')
        <path d="M12 3a9 9 0 1 0 0 18c1.4 0 2-1 1.6-2.1-.4-1.1.3-2.4 1.6-2.4H17a4 4 0 0 0 4-4C21 6.9 17 3 12 3z"/><circle cx="7.5" cy="11" r="1"/><circle cx="10" cy="7" r="1"/><circle cx="15" cy="7.5" r="1"/>
        @break
    @case('ball')
        <circle cx="12" cy="12" r="9"/><path d="m12 7 4 3-1.5 4.5h-5L8 10z"/><path d="M12 3v4M16 10l4.5-1M14.5 14.5l2.5 4M9.5 14.5 7 18.5M8 10 3.5 9"/>
        @break
    @case('crescent')
        <path d="M20 14.5A8.5 8.5 0 1 1 9.5 4a7 7 0 0 0 10.5 10.5z"/><path d="m17 4 .6 1.6L19.2 6l-1.6.6L17 8.2l-.6-1.6L14.8 6l1.6-.4z"/>
        @break
    @case('users')
        <circle cx="9" cy="8" r="3.2"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/><circle cx="17" cy="9" r="2.4"/><path d="M17 14.2c2.4 0 4.2 1.9 4.2 4.3"/>
        @break
    @case('graduation')
        <path d="m2 9 10-5 10 5-10 5z"/><path d="M6 11.5V16c0 1.4 2.7 3 6 3s6-1.6 6-3v-4.5"/><path d="M22 9v6"/>
        @break
    @case('building')
        <path d="M3 21h18"/><path d="M5 21V9l7-5 7 5v12"/><path d="M9 21v-5h6v5"/><path d="M9 11h.01M15 11h.01"/>
        @break
    @case('heart')
        <path d="M12 20s-7.5-4.6-9-9.5C2 7 4.2 4.5 7 4.5c1.9 0 3.4 1 5 3 1.6-2 3.1-3 5-3 2.8 0 5 2.5 4 6-1.5 4.9-9 9.5-9 9.5z"/>
        @break
    @case('shield')
        <path d="M12 3 4.5 6v5.5c0 4.5 3.1 8.2 7.5 9.5 4.4-1.3 7.5-5 7.5-9.5V6z"/><path d="m9 12 2.2 2.2L15.5 10"/>
        @break
    @case('bus')
        <rect x="4" y="3.5" width="16" height="14" rx="2.5"/><path d="M4 12h16M8 3.5v8.5M16 3.5v8.5"/><circle cx="8" cy="15" r=".6"/><circle cx="16" cy="15" r=".6"/><path d="M6 17.5V20M18 17.5V20"/>
        @break
    @case('laptop')
        <rect x="4" y="5" width="16" height="11" rx="1.5"/><path d="M2 20h20"/>
        @break
    @case('music')
        <path d="M9 18V5l11-2v13"/><circle cx="6.5" cy="18" r="2.5"/><circle cx="17.5" cy="16" r="2.5"/>
        @break
    @case('globe')
        <circle cx="12" cy="12" r="9"/><path d="M3 12h18"/><path d="M12 3c2.5 2.7 3.8 5.7 3.8 9S14.5 18.3 12 21c-2.5-2.7-3.8-5.7-3.8-9S9.5 5.7 12 3z"/>
        @break
    @case('pencil')
        <path d="m4 20 1-4L16.5 4.5a2.1 2.1 0 0 1 3 3L8 19z"/><path d="m14.5 6.5 3 3"/>
        @break
    @case('phone')
        <path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/>
        @break
    @case('mail')
        <rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 7 8.5 6 8.5-6"/>
        @break
    @case('pin')
        <path d="M12 21s7-6.1 7-11.5A7 7 0 0 0 5 9.5C5 14.9 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/>
        @break
    @case('clock')
        <circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>
        @break
    @case('arrow')
        <path d="M5 12h14"/><path d="m13 6 6 6-6 6"/>
        @break
    @case('check')
        <path d="m5 12.5 4.5 4.5L19 7.5"/>
        @break
    @case('facebook')
        <path d="M14 8.5h2.5V5H14a3.5 3.5 0 0 0-3.5 3.5V11H8v3.5h2.5V21H14v-6.5h2.5L17 11h-3V8.5a.5.5 0 0 1 .5-.5z"/>
        @break
    @case('instagram')
        <rect x="3.5" y="3.5" width="17" height="17" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17" cy="7" r=".5"/>
        @break
    @case('x')
        <path d="M4 4l16 16M20 4 4 20"/>
        @break
    @case('youtube')
        <rect x="2.5" y="5.5" width="19" height="13" rx="4"/><path d="m10 9.5 5 2.5-5 2.5z"/>
        @break
    @case('whatsapp')
        <path d="M3.5 20.5 5 16A8.5 8.5 0 1 1 8 19z"/><path d="M9 9.5c0 3 2.5 5.5 5.5 5.5l1-1.5-2-1-1 .8a4 4 0 0 1-1.8-1.8l.8-1-1-2z"/>
        @break
    @default
        <path d="m12 3 1.9 5.1L19 10l-5.1 1.9L12 17l-1.9-5.1L5 10l5.1-1.9z"/><path d="m18.5 16 .8 2.2 2.2.8-2.2.8-.8 2.2-.8-2.2-2.2-.8 2.2-.8z"/>
@endswitch
</svg>
