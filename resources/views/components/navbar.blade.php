@php
    $onHome = request()->routeIs('home');

    // Anchor links resolve against the homepage from anywhere on the site.
    $navLinks = [
        ['label' => 'Home',     'href' => route('home') . '#hero',     'current' => $onHome],
        ['label' => 'About',    'href' => route('home') . '#about',    'current' => false],
        ['label' => 'Services', 'href' => route('home') . '#services', 'current' => false],
        ['label' => 'Team',     'href' => route('home') . '#team',     'current' => false],
        ['label' => 'Projects', 'href' => route('projects.index'),     'current' => request()->routeIs('projects.*')],
        ['label' => 'Blog',     'href' => route('blog.index'),         'current' => request()->routeIs('blog.*')],
        ['label' => 'Contact',  'href' => route('home') . '#contact',  'current' => false],
    ];
@endphp

<header x-data="{ open: false, scrolled: false }"
        x-init="scrolled = window.scrollY > 24"
        @scroll.window="scrolled = window.scrollY > 24"
        @keydown.escape.window="open = false"
        @resize.window="if (window.innerWidth >= 1024) open = false"
        :class="(scrolled || open) ? 'lc-nav-scrolled' : ''"
        class="lc-nav">

    {{-- Luminous hairline under the bar once scrolled --}}
    <div aria-hidden="true" x-show="scrolled" x-transition.opacity.duration.300ms
         class="absolute inset-x-0 bottom-0 h-px bg-gradient-to-r from-transparent via-accent-500/45 to-transparent"></div>

    <nav aria-label="Primary" class="lc-shell">
        <div class="flex h-18 items-center justify-between gap-4 lg:h-20">

            {{-- Logo --}}
            <a href="{{ route('home') }}"
               class="group -ml-1 inline-flex shrink-0 items-center rounded-sm px-1 py-1"
               aria-label="Logicore — home">
                <x-brand-logo mark-class="h-9 w-auto lg:h-10"
                              class="transition-opacity duration-200 group-hover:opacity-80" />
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden items-center gap-0.5 lg:flex">
                @foreach($navLinks as $link)
                    <a href="{{ $link['href'] }}"
                       class="lc-nav-link"
                       @if($link['current']) aria-current="page" @endif>{{ $link['label'] }}</a>
                @endforeach
            </div>

            {{-- Desktop CTA --}}
            <div class="hidden shrink-0 items-center gap-3 lg:flex">
                <span aria-hidden="true" class="h-5 w-px bg-line"></span>
                <a href="{{ route('home') }}#contact" class="lc-btn lc-btn-primary lc-btn-sm">
                    Start a project
                    <i class="fas fa-arrow-right lc-arrow text-[0.7rem]" aria-hidden="true"></i>
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <button type="button"
                    @click="open = !open"
                    :aria-expanded="open ? 'true' : 'false'"
                    aria-controls="mobile-menu"
                    class="lc-btn lc-btn-outline lc-btn-sm -mr-1 h-10 w-10 !px-0 lg:hidden">
                <span class="sr-only">Toggle navigation menu</span>
                <i x-show="!open" class="fas fa-bars text-base" aria-hidden="true"></i>
                <i x-show="open" x-cloak class="fas fa-xmark text-base" aria-hidden="true"></i>
            </button>
        </div>
    </nav>

    {{-- Mobile Menu --}}
    <div id="mobile-menu"
         x-show="open"
         x-cloak
         x-transition:enter="transition ease-out duration-250"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden">
        <div class="lc-shell pb-4">
            <nav aria-label="Mobile" class="lc-panel lc-edge-lit overflow-hidden p-2 shadow-2xl">
                @foreach($navLinks as $link)
                    <a href="{{ $link['href'] }}"
                       @click="open = false"
                       class="lc-nav-mobile-link"
                       @if($link['current']) aria-current="page" @endif>
                        <span>{{ $link['label'] }}</span>
                        <i class="fas fa-chevron-right text-[0.65rem] opacity-40" aria-hidden="true"></i>
                    </a>
                @endforeach

                <div class="mt-2 border-t border-line-soft p-2 pt-3">
                    <a href="{{ route('home') }}#contact" @click="open = false" class="lc-btn lc-btn-primary lc-btn-block">
                        Start a project
                        <i class="fas fa-arrow-right lc-arrow text-[0.7rem]" aria-hidden="true"></i>
                    </a>
                </div>
            </nav>
        </div>
    </div>
</header>
