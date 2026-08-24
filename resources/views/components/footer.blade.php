@php
    $footerQuickLinks = [
        ['label' => 'About Us', 'href' => route('home') . '#about'],
        ['label' => 'Services', 'href' => route('home') . '#services'],
        ['label' => 'Projects', 'href' => route('projects.index')],
        ['label' => 'Blog',     'href' => route('blog.index')],
        ['label' => 'Contact',  'href' => route('home') . '#contact'],
    ];

    $footerServices = [
        'Web Development',
        'Mobile Apps',
        'UI/UX Design',
        'Branding',
        'AI Solutions',
    ];

    // Social links come from admin settings; only configured channels render.
    $footerSocials = collect([
        ['platform' => 'github',   'icon' => 'fab fa-github',      'label' => 'GitHub'],
        ['platform' => 'linkedin', 'icon' => 'fab fa-linkedin-in', 'label' => 'LinkedIn'],
        ['platform' => 'twitter',  'icon' => 'fab fa-twitter',     'label' => 'Twitter'],
        ['platform' => 'facebook', 'icon' => 'fab fa-facebook-f',  'label' => 'Facebook'],
        ['platform' => 'instagram','icon' => 'fab fa-instagram',   'label' => 'Instagram'],
    ])->map(fn ($social) => $social + ['href' => \App\Models\Setting::get('social_' . $social['platform'])])
      ->filter(fn ($social) => filled($social['href']))
      ->push([
          'platform' => 'email',
          'icon' => 'fas fa-envelope',
          'label' => 'Contact Logicore',
          'href' => route('home') . '#contact',
      ])
      ->values();
@endphp

<footer class="relative mt-px overflow-hidden bg-surface-base">
    {{-- Luminous top edge --}}
    <div aria-hidden="true" class="lc-rule absolute inset-x-0 top-0"></div>

    {{-- Technical atmosphere --}}
    <div aria-hidden="true" class="pointer-events-none absolute inset-0">
        <div class="absolute inset-0 lc-grid-fine lc-mask-top opacity-40"></div>
        <div class="absolute inset-x-0 top-0 h-64 bg-[radial-gradient(ellipse_60%_100%_at_50%_0%,rgba(23,107,255,0.14),transparent_70%)]"></div>
    </div>

    <div class="lc-shell relative pt-16 pb-8 lg:pt-20">

        <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-12 lg:gap-10">

            {{-- Brand --}}
            <div class="lg:col-span-4">
                <a href="{{ route('home') }}" class="inline-flex rounded-sm" aria-label="Logicore — home">
                    <x-brand-logo mark-class="h-10 w-auto" />
                </a>
                <p class="lc-body mt-5 max-w-xs">
                    We build intelligent digital solutions and scalable systems that help businesses innovate, automate, and grow.
                </p>
                <p class="lc-meta mt-5">Think. Build. Scale.</p>

                <ul class="mt-6 flex gap-2.5">
                    @foreach($footerSocials as $social)
                        <li>
                            <a href="{{ $social['href'] }}"
                               class="flex h-10 w-10 items-center justify-center rounded-md border border-line-soft bg-surface-2 text-ink-subtle transition duration-200 hover:-translate-y-0.5 hover:border-accent-500/40 hover:bg-surface-3 hover:text-accent-500"
                               aria-label="{{ $social['label'] }}">
                                <i class="{{ $social['icon'] }} text-sm" aria-hidden="true"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Quick Links --}}
            <nav class="lg:col-span-2" aria-labelledby="footer-nav-heading">
                <h2 id="footer-nav-heading" class="lc-meta uppercase tracking-[0.18em] text-ink-subtle">Navigate</h2>
                <ul class="mt-5 space-y-3">
                    @foreach($footerQuickLinks as $link)
                        <li>
                            <a href="{{ $link['href'] }}"
                               class="inline-block rounded-sm text-sm text-ink-muted transition duration-200 hover:translate-x-0.5 hover:text-accent-500">
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            {{-- Services --}}
            <nav class="lg:col-span-2" aria-labelledby="footer-services-heading">
                <h2 id="footer-services-heading" class="lc-meta uppercase tracking-[0.18em] text-ink-subtle">Capabilities</h2>
                <ul class="mt-5 space-y-3">
                    @foreach($footerServices as $service)
                        <li>
                            <a href="{{ route('home') }}#services"
                               class="inline-block rounded-sm text-sm text-ink-muted transition duration-200 hover:translate-x-0.5 hover:text-accent-500">
                                {{ $service }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            {{-- Newsletter --}}
            <div class="lg:col-span-4">
                <div class="lc-panel lc-edge-lit p-6">
                    <h2 class="lc-h3">Signal, not noise</h2>
                    <p class="lc-body mt-2">
                        Occasional notes on scalable systems, automation, and product engineering.
                    </p>
                    <form action="{{ route('newsletter.store') }}" method="POST" class="mt-5 space-y-3">
                        @csrf
                        <div>
                            <label for="footer-newsletter-email" class="sr-only">Email address</label>
                            <input type="email"
                                   id="footer-newsletter-email"
                                   name="email"
                                   required
                                   autocomplete="email"
                                   placeholder="you@company.com"
                                   class="lc-field">
                        </div>
                        <button type="submit" class="lc-btn lc-btn-primary lc-btn-block">
                            Subscribe
                            <i class="fas fa-arrow-right lc-arrow text-[0.7rem]" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="mt-14 border-t border-line-soft pt-6">
            <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
                <p class="lc-meta">
                    &copy; {{ now()->year }} Logicore. All rights reserved.
                </p>
                <ul class="flex items-center gap-6">
                    <li><a href="#" class="rounded-sm text-xs text-ink-subtle transition hover:text-ink-muted">Privacy Policy</a></li>
                    <li><a href="#" class="rounded-sm text-xs text-ink-subtle transition hover:text-ink-muted">Terms of Service</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
