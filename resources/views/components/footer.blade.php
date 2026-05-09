{{-- Footer --}}
<footer class="relative bg-[#0a0a1a] border-t border-white/5">
    {{-- Gradient top border --}}
    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-primary-500 to-transparent"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            {{-- Brand --}}
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 gradient-primary rounded-xl flex items-center justify-center">
                        <i class="fas fa-code text-white text-lg"></i>
                    </div>
                    <span class="text-xl font-bold text-white">Port<span class="text-gradient">folio</span></span>
                </a>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    We craft exceptional digital experiences that drive growth and transform businesses.
                </p>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 glass rounded-xl flex items-center justify-center text-gray-400 hover:text-primary-400 hover:bg-primary-500/10 transition-all duration-300">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="#" class="w-10 h-10 glass rounded-xl flex items-center justify-center text-gray-400 hover:text-primary-400 hover:bg-primary-500/10 transition-all duration-300">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="w-10 h-10 glass rounded-xl flex items-center justify-center text-gray-400 hover:text-primary-400 hover:bg-primary-500/10 transition-all duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 glass rounded-xl flex items-center justify-center text-gray-400 hover:text-primary-400 hover:bg-primary-500/10 transition-all duration-300">
                        <i class="fab fa-dribbble"></i>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-white font-semibold mb-6">Quick Links</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}#about" class="text-gray-400 hover:text-primary-400 transition-colors text-sm">About Us</a></li>
                    <li><a href="{{ route('home') }}#services" class="text-gray-400 hover:text-primary-400 transition-colors text-sm">Services</a></li>
                    <li><a href="{{ route('projects.index') }}" class="text-gray-400 hover:text-primary-400 transition-colors text-sm">Projects</a></li>
                    <li><a href="{{ route('blog.index') }}" class="text-gray-400 hover:text-primary-400 transition-colors text-sm">Blog</a></li>
                    <li><a href="{{ route('home') }}#contact" class="text-gray-400 hover:text-primary-400 transition-colors text-sm">Contact</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div>
                <h4 class="text-white font-semibold mb-6">Services</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors text-sm">Web Development</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors text-sm">Mobile Apps</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors text-sm">UI/UX Design</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors text-sm">Branding</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors text-sm">AI Solutions</a></li>
                </ul>
            </div>

            {{-- Newsletter --}}
            <div>
                <h4 class="text-white font-semibold mb-6">Newsletter</h4>
                <p class="text-gray-400 text-sm mb-4">Subscribe to get the latest updates and insights.</p>
                <form action="{{ route('newsletter.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="email" name="email" placeholder="Enter your email"
                           class="w-full px-4 py-3 glass rounded-xl border-0 text-white placeholder-gray-500 text-sm focus:ring-2 focus:ring-primary-500 bg-white/5">
                    <button type="submit" class="w-full px-4 py-3 gradient-primary text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all">
                        Subscribe <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </form>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="mt-16 pt-8 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-gray-500 text-sm">
                &copy; {{ date('Y') }} Portfolio Agency. All rights reserved.
            </p>
            <div class="flex gap-6">
                <a href="#" class="text-gray-500 hover:text-gray-300 text-sm transition-colors">Privacy Policy</a>
                <a href="#" class="text-gray-500 hover:text-gray-300 text-sm transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
