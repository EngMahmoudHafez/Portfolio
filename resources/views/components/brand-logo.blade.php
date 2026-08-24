@props([
    'iconOnly' => false,
    'markClass' => 'h-10 w-auto',
    'textClass' => 'text-xl',
])

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-3']) }}>
    <img src="{{ asset('magnific_svg_5xCkSwqKxe.png') }}"
         alt="{{ $iconOnly ? '' : 'Logicore' }}"
         @if($iconOnly) aria-hidden="true" @endif
         width="200" height="90"
         class="{{ $markClass }} max-w-[12.5rem] object-contain object-left">
</span>
