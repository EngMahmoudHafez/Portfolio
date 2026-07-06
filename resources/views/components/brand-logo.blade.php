@props([
    'iconOnly' => false,
    'markClass' => 'w-10 h-10',
    'textClass' => 'text-xl',
])

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-3 ']) }}>
    <img src="{{ asset('magnific_svg_5xCkSwqKxe.png') }}" alt="Logicore Logo"
        class="w-full h-full object-contain" style="max-width: 200px; max-height: 90px;">

</span>
