@once
    <style>
        .logicore-footer__grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2.5rem;
            align-items: start;
        }

        .logicore-footer__links {
            display: grid;
            gap: 0.75rem;
        }

        .logicore-footer__link {
            color: #a8b3c7;
            font-size: 0.875rem;
            transition: color 180ms ease, transform 180ms ease;
        }

        .logicore-footer__link:hover {
            color: #00c1ff;
            transform: translateX(3px);
        }

        .logicore-footer__social {
            height: 2.5rem;
            width: 2.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            color: #a8b3c7;
            background: rgba(16, 26, 51, 0.72);
            border: 1px solid rgba(23, 107, 255, 0.18);
            transition: color 180ms ease, border-color 180ms ease, background 180ms ease, transform 180ms ease;
        }

        .logicore-footer__social:hover {
            color: #00c1ff;
            border-color: rgba(0, 193, 255, 0.46);
            background: rgba(23, 107, 255, 0.12);
            transform: translateY(-2px);
        }

        @media (min-width: 640px) {
            .logicore-footer__grid {
                grid-template-columns: minmax(0, 1.2fr) minmax(0, 1fr);
            }
        }

        @media (min-width: 900px) {
            .logicore-footer__grid {
                grid-template-columns: minmax(13rem, 1.45fr) minmax(7rem, 0.75fr) minmax(9rem, 0.85fr) minmax(15rem, 1.25fr);
                gap: 2rem;
            }
        }
    </style>
@endonce

{{-- Footer --}}
<footer class="relative bg-[#0A0F23] border-t border-primary-500/10">
    {{-- Gradient top border --}}
    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-primary-500 to-transparent"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-14">
        <div class="logicore-footer__grid">
            {{-- Brand --}}
            <div class="max-w-sm">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-5">
                    <x-brand-logo />
                </a>
                <p class="text-[#A8B3C7] text-sm leading-relaxed mb-5">
                    We build intelligent digital solutions and scalable systems that help businesses grow.
                </p>
                <div class="flex gap-3">
                    <a href="#" class="logicore-footer__social" aria-label="GitHub">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="#" class="logicore-footer__social" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="logicore-footer__social" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="{{ route('home') }}#contact" class="logicore-footer__social" aria-label="Email Logicore">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-white font-semibold mb-5">Quick Links</h4>
                <ul class="logicore-footer__links">
                    <li><a href="{{ route('home') }}#about" class="logicore-footer__link">About Us</a></li>
                    <li><a href="{{ route('home') }}#services" class="logicore-footer__link">Services</a></li>
                    <li><a href="{{ route('projects.index') }}" class="logicore-footer__link">Projects</a></li>
                    <li><a href="{{ route('blog.index') }}" class="logicore-footer__link">Blog</a></li>
                    <li><a href="{{ route('home') }}#contact" class="logicore-footer__link">Contact</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div>
                <h4 class="text-white font-semibold mb-5">Services</h4>
                <ul class="logicore-footer__links">
                    <li><a href="{{ route('home') }}#services" class="logicore-footer__link">Web Development</a></li>
                    <li><a href="{{ route('home') }}#services" class="logicore-footer__link">Mobile Apps</a></li>
                    <li><a href="{{ route('home') }}#services" class="logicore-footer__link">UI/UX Design</a></li>
                    <li><a href="{{ route('home') }}#services" class="logicore-footer__link">Branding</a></li>
                    <li><a href="{{ route('home') }}#services" class="logicore-footer__link">AI Solutions</a></li>
                </ul>
            </div>

            {{-- Newsletter --}}
            <div class="max-w-md">
                <h4 class="text-white font-semibold mb-5">Newsletter</h4>
                <p class="text-[#A8B3C7] text-sm leading-relaxed mb-4">Subscribe to get the latest updates and insights.</p>
                <form action="{{ route('newsletter.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="email" name="email" placeholder="Enter your email"
                           class="w-full px-4 py-3 glass rounded-lg border-0 text-white placeholder-gray-500 text-sm focus:ring-2 focus:ring-primary-500 bg-white/5">
                    <button type="submit" class="w-full px-4 py-3 gradient-primary text-white text-sm font-semibold rounded-lg hover:opacity-90 transition-all">
                        Subscribe <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </form>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="mt-12 pt-7 border-t border-primary-500/10 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-gray-500 text-sm">
                &copy; 2026 Logicore. All rights reserved.
            </p>
            <div class="flex gap-6">
                <a href="#" class="text-gray-500 hover:text-gray-300 text-sm transition-colors">Privacy Policy</a>
                <a href="#" class="text-gray-500 hover:text-gray-300 text-sm transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
