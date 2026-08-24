<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Logicore Admin')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0A0F23] text-white antialiased" x-data="{ sidebarOpen: true }">
    {{-- Toast --}}
    @if(session('success'))
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,4000)" x-transition class="fixed top-6 right-6 z-[100] glass rounded-2xl px-6 py-4 text-green-400 flex items-center gap-3 shadow-2xl">
        <i class="fas fa-check-circle"></i><span>{{ session('success') }}</span>
        <button @click="show=false" class="ml-3 text-gray-400 hover:text-white"><i class="fas fa-times"></i></button>
    </div>
    @endif
    @if($errors->any())
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,8000)" x-transition class="fixed top-6 right-6 z-[100] glass rounded-2xl px-6 py-4 text-red-400 shadow-2xl max-w-md">
        <ul class="list-disc list-inside text-sm space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="fixed top-0 left-0 h-full bg-[#0A0F23] border-r border-primary-500/10 transition-all duration-300 z-40 flex flex-col">
            <div class="p-5 flex items-center gap-3 border-b border-white/5">
                <x-brand-logo :icon-only="true" mark-class="w-9 h-9" />
                <span x-show="sidebarOpen" class="text-lg font-bold text-white">Logicore Admin</span>
            </div>
            <nav class="flex-1 p-3 space-y-1 overflow-y-auto">
                @php $r = request()->route()->getName(); @endphp
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all {{ $r == 'admin.dashboard' ? 'gradient-primary text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fas fa-chart-pie w-5 text-center"></i><span x-show="sidebarOpen">Dashboard</span></a>
                <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all {{ str_starts_with($r,'admin.services') ? 'gradient-primary text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fas fa-cogs w-5 text-center"></i><span x-show="sidebarOpen">Services</span></a>
                <a href="{{ route('admin.team.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all {{ str_starts_with($r,'admin.team') ? 'gradient-primary text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fas fa-users w-5 text-center"></i><span x-show="sidebarOpen">Team</span></a>
                <a href="{{ route('admin.projects.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all {{ str_starts_with($r,'admin.projects') ? 'gradient-primary text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fas fa-folder w-5 text-center"></i><span x-show="sidebarOpen">Projects</span></a>
                <a href="{{ route('admin.skills.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all {{ str_starts_with($r,'admin.skills') ? 'gradient-primary text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fas fa-layer-group w-5 text-center"></i><span x-show="sidebarOpen">Skills</span></a>
                <a href="{{ route('admin.posts.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all {{ str_starts_with($r,'admin.posts') ? 'gradient-primary text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fas fa-blog w-5 text-center"></i><span x-show="sidebarOpen">Blog</span></a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all {{ str_starts_with($r,'admin.categories') ? 'gradient-primary text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fas fa-tags w-5 text-center"></i><span x-show="sidebarOpen">Categories</span></a>
                <a href="{{ route('admin.tags.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all {{ str_starts_with($r,'admin.tags') ? 'gradient-primary text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fas fa-hashtag w-5 text-center"></i><span x-show="sidebarOpen">Tags</span></a>
                <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all {{ str_starts_with($r,'admin.testimonials') ? 'gradient-primary text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fas fa-star w-5 text-center"></i><span x-show="sidebarOpen">Testimonials</span></a>
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all {{ str_starts_with($r,'admin.contacts') ? 'gradient-primary text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fas fa-envelope w-5 text-center"></i><span x-show="sidebarOpen">Messages</span></a>
                <a href="{{ route('admin.newsletter.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all {{ str_starts_with($r,'admin.newsletter') ? 'gradient-primary text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fas fa-paper-plane w-5 text-center"></i><span x-show="sidebarOpen">Newsletter</span></a>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all {{ str_starts_with($r,'admin.settings') ? 'gradient-primary text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fas fa-sliders-h w-5 text-center"></i><span x-show="sidebarOpen">Settings</span></a>
            </nav>
            <div class="p-3 border-t border-white/5">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                    <i class="fas fa-globe w-5 text-center"></i><span x-show="sidebarOpen">View Site</span></a>
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-400 hover:text-red-400 hover:bg-red-500/5 transition-all">
                        <i class="fas fa-sign-out-alt w-5 text-center"></i><span x-show="sidebarOpen">Logout</span></button>
                </form>
            </div>
        </aside>

        {{-- Main --}}
        <div :class="sidebarOpen ? 'ml-64' : 'ml-20'" class="flex-1 transition-all duration-300">
            <header class="h-16 glass-strong flex items-center justify-between px-6 sticky top-0 z-30">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-400 hover:text-white transition"><i class="fas fa-bars"></i></button>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-400">{{ auth()->user()->name ?? 'Admin' }}</span>
                    <div class="w-8 h-8 gradient-primary rounded-full flex items-center justify-center text-white text-sm font-bold">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</div>
                </div>
            </header>
            <main class="p-6">@yield('content')</main>
        </div>
    </div>
</body>
</html>
