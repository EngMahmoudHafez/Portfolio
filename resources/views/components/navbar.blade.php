{{-- Navigation Bar --}}
<nav x-data="{ open: false, scrolled: false }"
     @scroll.window="scrolled = (window.scrollY > 50)"
     :class="scrolled ? 'glass-strong shadow-2xl' : 'bg-transparent'"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 gradient-primary rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-code text-white text-lg"></i>
                </div>
                <span class="text-xl font-bold text-white">
                    Port<span class="text-gradient">folio</span>
                </span>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden lg:flex items-center gap-1">
                <a href="{{ route('home') }}#hero" class="px-4 py-2 text-sm font-medium text-gray-300 hover:text-white rounded-xl hover:bg-white/10 transition-all duration-300">Home</a>
                <a href="{{ route('home') }}#about" class="px-4 py-2 text-sm font-medium text-gray-300 hover:text-white rounded-xl hover:bg-white/10 transition-all duration-300">About</a>
                <a href="{{ route('home') }}#services" class="px-4 py-2 text-sm font-medium text-gray-300 hover:text-white rounded-xl hover:bg-white/10 transition-all duration-300">Services</a>
                <a href="{{ route('home') }}#team" class="px-4 py-2 text-sm font-medium text-gray-300 hover:text-white rounded-xl hover:bg-white/10 transition-all duration-300">Team</a>
                <a href="{{ route('projects.index') }}" class="px-4 py-2 text-sm font-medium text-gray-300 hover:text-white rounded-xl hover:bg-white/10 transition-all duration-300">Projects</a>
                <a href="{{ route('blog.index') }}" class="px-4 py-2 text-sm font-medium text-gray-300 hover:text-white rounded-xl hover:bg-white/10 transition-all duration-300">Blog</a>
                <a href="{{ route('home') }}#contact" class="px-4 py-2 text-sm font-medium text-gray-300 hover:text-white rounded-xl hover:bg-white/10 transition-all duration-300">Contact</a>
            </div>

            {{-- CTA + Dark Mode --}}
            <div class="hidden lg:flex items-center gap-4">
                <a href="{{ route('home') }}#contact"
                   class="px-6 py-2.5 gradient-primary text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all duration-300 hover:shadow-lg hover:shadow-primary-500/25">
                    Let's Talk
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <button @click="open = !open" class="lg:hidden text-white p-2 rounded-xl hover:bg-white/10 transition">
                <i x-show="!open" class="fas fa-bars text-xl"></i>
                <i x-show="open" x-cloak class="fas fa-times text-xl"></i>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="lg:hidden glass-strong mx-4 mb-4 rounded-2xl overflow-hidden">
        <div class="p-4 space-y-1">
            <a href="{{ route('home') }}#hero" @click="open = false" class="block px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-xl transition">Home</a>
            <a href="{{ route('home') }}#about" @click="open = false" class="block px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-xl transition">About</a>
            <a href="{{ route('home') }}#services" @click="open = false" class="block px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-xl transition">Services</a>
            <a href="{{ route('home') }}#team" @click="open = false" class="block px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-xl transition">Team</a>
            <a href="{{ route('projects.index') }}" @click="open = false" class="block px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-xl transition">Projects</a>
            <a href="{{ route('blog.index') }}" @click="open = false" class="block px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-xl transition">Blog</a>
            <a href="{{ route('home') }}#contact" @click="open = false" class="block px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-xl transition">Contact</a>
            <div class="pt-4">
                <a href="{{ route('home') }}#contact" class="block text-center px-6 py-3 gradient-primary text-white font-semibold rounded-xl">Let's Talk</a>
            </div>
        </div>
    </div>
</nav>
