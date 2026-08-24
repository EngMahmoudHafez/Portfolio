<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#070B1A">

    <title>@yield('title', 'Logicore - Think. Build. Scale.')</title>
    <meta name="description" content="@yield('meta_description', 'Logicore builds intelligent digital solutions and scalable systems that help businesses innovate, automate, and grow.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Logicore, scalable systems, AI solutions, web development, mobile apps, UI/UX design, backend engineering')">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logicore-icon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', 'Logicore')">
    <meta property="og:description" content="@yield('meta_description', 'Think. Build. Scale.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Fonts: Space Grotesk (display) + IBM Plex Sans (body) + IBM Plex Mono (technical labels) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style"
          href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@400;500;600&family=Space+Grotesk:wght@500;600;700&display=swap">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@400;500;600&family=Space+Grotesk:wght@500;600;700&display=swap"
          media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@400;500;600&family=Space+Grotesk:wght@500;600;700&display=swap">
    </noscript>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>

    @stack('head')
</head>
<body class="bg-surface-base text-ink antialiased overflow-x-hidden selection:bg-primary-500/40">

    {{-- Skip link --}}
    <a href="#main" class="lc-skip lc-btn lc-btn-primary lc-btn-sm">Skip to main content</a>

    {{-- Ambient page light source — purely decorative --}}
    <div aria-hidden="true" class="pointer-events-none fixed inset-0 -z-10">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_90%_55%_at_50%_-10%,rgba(23,107,255,0.20),transparent_70%)]"></div>
        <div class="absolute inset-0 lc-grid-fine lc-mask-top opacity-[0.55]"></div>
        <div class="absolute inset-0 lc-noise opacity-[0.035] mix-blend-soft-light"></div>
    </div>

    {{-- Toast Notifications --}}
    <div class="pointer-events-none fixed top-24 right-4 sm:right-6 z-[90] flex w-[min(24rem,calc(100vw-2rem))] flex-col gap-3">
        @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-4"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             role="status" aria-live="polite"
             class="lc-glass lc-edge-lit pointer-events-auto relative flex items-start gap-3 px-4 py-3.5 shadow-2xl">
            <i class="fas fa-circle-check mt-0.5 text-emerald-400" aria-hidden="true"></i>
            <p class="flex-1 text-sm leading-relaxed text-ink">{{ session('success') }}</p>
            <button type="button" @click="show = false" class="lc-btn-quiet -mr-1 -mt-1 rounded p-1.5 text-ink-subtle hover:text-ink" aria-label="Dismiss notification">
                <i class="fas fa-xmark text-xs" aria-hidden="true"></i>
            </button>
        </div>
        @endif

        @if($errors->any())
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 9000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-4"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             role="alert" aria-live="assertive"
             class="lc-glass lc-edge-lit pointer-events-auto relative px-4 py-3.5 shadow-2xl">
            <div class="mb-2 flex items-start gap-3">
                <i class="fas fa-triangle-exclamation mt-0.5 text-rose-400" aria-hidden="true"></i>
                <p class="flex-1 text-sm font-semibold text-ink">Please fix the following</p>
                <button type="button" @click="show = false" class="lc-btn-quiet -mr-1 -mt-1 rounded p-1.5 text-ink-subtle hover:text-ink" aria-label="Dismiss errors">
                    <i class="fas fa-xmark text-xs" aria-hidden="true"></i>
                </button>
            </div>
            <ul class="space-y-1 pl-7 text-sm text-ink-muted">
                @foreach($errors->all() as $error)
                    <li class="list-disc">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    {{-- Navigation --}}
    <x-navbar />

    {{-- Main Content --}}
    <main id="main" tabindex="-1" class="focus:outline-none">
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-footer />

    {{-- WhatsApp Button --}}
    <a href="https://wa.me/1234567890" target="_blank" rel="noopener"
       class="group fixed bottom-5 right-4 z-50 flex h-13 w-13 items-center justify-center rounded-full bg-[#25D366] shadow-[0_10px_30px_-10px_rgba(37,211,102,0.8)] transition duration-200 hover:bg-[#1FBE5A] focus-visible:outline-2 focus-visible:outline-offset-3 focus-visible:outline-white sm:bottom-6 sm:right-6 sm:h-14 sm:w-14"
       aria-label="Chat with Logicore on WhatsApp">
        <span aria-hidden="true" class="absolute inset-0 rounded-full ring-1 ring-white/25"></span>
        <i class="fab fa-whatsapp text-2xl text-[#04220f] sm:text-[1.65rem]" aria-hidden="true"></i>
        <span aria-hidden="true"
              class="pointer-events-none absolute right-full mr-3 hidden whitespace-nowrap rounded-md border border-line bg-surface-1 px-3 py-1.5 text-xs font-medium text-ink opacity-0 shadow-lg transition-opacity duration-200 group-hover:opacity-100 group-focus-visible:opacity-100 sm:block">
            Chat with us
        </span>
    </a>

    @stack('scripts')
</body>
</html>
