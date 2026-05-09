<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: true }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Portfolio Agency - Creative Digital Solutions')</title>
    <meta name="description" content="@yield('meta_description', 'We are a creative agency building premium digital experiences.')">
    <meta name="keywords" content="@yield('meta_keywords', 'web development, mobile apps, ui/ux design, branding, digital agency')">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', 'Portfolio Agency')">
    <meta property="og:description" content="@yield('meta_description', 'Creative Digital Solutions')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#0f0f23] text-white antialiased overflow-x-hidden">

    {{-- Toast Notifications --}}
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed top-6 right-6 z-[100] glass rounded-2xl px-6 py-4 text-green-400 flex items-center gap-3 shadow-2xl">
        <i class="fas fa-check-circle text-xl"></i>
        <span>{{ session('success') }}</span>
        <button @click="show = false" class="ml-4 text-gray-400 hover:text-white">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    @if($errors->any())
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 8000)"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="fixed top-6 right-6 z-[100] glass rounded-2xl px-6 py-4 text-red-400 shadow-2xl max-w-md">
        <div class="flex items-center gap-3 mb-2">
            <i class="fas fa-exclamation-circle text-xl"></i>
            <span class="font-semibold">Please fix the following errors:</span>
            <button @click="show = false" class="ml-auto text-gray-400 hover:text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <ul class="list-disc list-inside text-sm space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Navigation --}}
    <x-navbar />

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-footer />

    {{-- WhatsApp Button --}}
    <a href="https://wa.me/1234567890" target="_blank"
       class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-green-500 rounded-full flex items-center justify-center shadow-lg hover:bg-green-600 hover:scale-110 transition-all duration-300 group">
        <i class="fab fa-whatsapp text-white text-2xl"></i>
        <span class="absolute right-full mr-3 bg-gray-900 text-white text-sm px-3 py-1 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
            Chat with us
        </span>
    </a>

    @stack('scripts')
</body>
</html>
