@props([
    'eyebrow' => null,
    'title' => null,
    'lead' => null,
    'align' => 'start', // start | center
    'id' => null,
])

@php
    $isCenter = $align === 'center';
@endphp

<div {{ $attributes->merge(['class' => 'lc-rise ' . ($isCenter ? 'mx-auto text-center' : '')]) }}>
    @if($eyebrow)
        <p class="lc-eyebrow {{ $isCenter ? 'lc-eyebrow-plain' : '' }}">{{ $eyebrow }}</p>
    @endif

    @if($title || isset($titleSlot))
        <h2 @if($id) id="{{ $id }}" @endif class="lc-h2 mt-5">
            {{ $titleSlot ?? $title }}
        </h2>
    @endif

    @if($lead)
        <p class="lc-lead mt-5">{{ $lead }}</p>
    @endif

    {{ $slot }}
</div>
