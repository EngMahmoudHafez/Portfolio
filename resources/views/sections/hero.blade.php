@php
    // Optional, admin-managed proof points. Nothing is rendered unless a real
    // value exists in settings — no placeholder counters.
    $heroStats = collect([
        ['key' => 'stat_projects', 'label' => 'Projects Delivered'],
        ['key' => 'stat_clients',  'label' => 'Happy Clients'],
        ['key' => 'stat_years',    'label' => 'Years Experience'],
    ])->map(fn ($stat) => $stat + ['value' => \App\Models\Setting::get($stat['key'])])
      ->filter(fn ($stat) => filled($stat['value']))
      ->values();

    // The studio's operating model, drawn from the brand promise.
    $heroPhases = [
        ['tag' => 'think', 'title' => 'Discovery & architecture', 'note' => 'Scope, constraints, system design'],
        ['tag' => 'build', 'title' => 'Engineering & interface',  'note' => 'Web, mobile, APIs, UI/UX'],
        ['tag' => 'scale', 'title' => 'Automation & growth',      'note' => 'AI workflows, integrations, ops'],
    ];

    $heroCapabilities = ($services ?? collect())->pluck('title')->filter()->take(6);
    if ($heroCapabilities->isEmpty()) {
        $heroCapabilities = collect(['Web Development', 'Mobile Apps', 'UI/UX Design', 'AI Solutions', 'Backend Systems']);
    }
@endphp

<section id="hero" class="relative flex min-h-[min(100svh,54rem)] items-center overflow-hidden pt-28 pb-16 lg:pt-32">

    {{-- Layered technical atmosphere --}}
    <div aria-hidden="true" class="pointer-events-none absolute inset-0">
        <div class="absolute inset-0 bg-[linear-gradient(160deg,#0A0F23_0%,#0C1330_45%,#070B1A_100%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_55%_50%_at_12%_8%,rgba(23,107,255,0.30),transparent_62%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_45%_45%_at_88%_78%,rgba(0,193,255,0.16),transparent_66%)]"></div>
        <div class="absolute inset-0 lc-grid-fine lc-mask-soft opacity-80"></div>
        <div class="absolute inset-0 lc-circuit lc-mask-soft opacity-40"></div>
    </div>

    <div class="lc-shell relative w-full">
        <div class="grid items-center gap-14 lg:grid-cols-12 lg:gap-12 xl:gap-16">

            {{-- ---------- Editorial column ---------- --}}
            <div class="lg:col-span-7">

                <p class="lc-enter inline-flex items-center gap-2.5 rounded-md border border-line bg-surface-1/70 px-3.5 py-2 backdrop-blur-sm"
                   style="--lc-delay: 60ms">
                    <span aria-hidden="true" class="lc-beacon h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                    <span class="lc-meta text-ink-muted">Available for new projects</span>
                </p>

                <h1 class="lc-h1 lc-enter mt-7" style="--lc-delay: 130ms">
                    <span class="block">Think.</span>
                    <span class="block text-gradient">Build.</span>
                    <span class="block">Scale.</span>
                </h1>

                <p class="lc-lead lc-enter mt-7 max-w-xl" style="--lc-delay: 200ms">
                    We build intelligent digital solutions and scalable systems that help businesses
                    innovate, automate, and grow.
                </p>

                <div class="lc-enter mt-9 flex flex-col gap-3 sm:flex-row" style="--lc-delay: 270ms">
                    <a href="#portfolio" class="lc-btn lc-btn-primary lc-btn-lg">
                        View Our Work
                        <i class="fas fa-arrow-right lc-arrow text-[0.7rem]" aria-hidden="true"></i>
                    </a>
                    <a href="#contact" class="lc-btn lc-btn-outline lc-btn-lg">
                        <i class="fas fa-paper-plane text-[0.7rem]" aria-hidden="true"></i>
                        Get in Touch
                    </a>
                </div>

                {{-- Capability strip --}}
                <div class="lc-enter mt-12" style="--lc-delay: 340ms">
                    <p class="lc-meta uppercase tracking-[0.18em]">Capabilities</p>
                    <ul class="mt-3 flex flex-wrap items-center gap-x-5 gap-y-2">
                        @foreach($heroCapabilities as $capability)
                            <li class="flex items-center gap-2 text-sm text-ink-muted">
                                <span aria-hidden="true" class="h-1 w-1 rounded-full bg-accent-500/70"></span>
                                {{ $capability }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                @if($heroStats->isNotEmpty())
                    <dl class="lc-enter mt-10 grid max-w-lg grid-cols-3 gap-6 border-t border-line-soft pt-8" style="--lc-delay: 400ms">
                        @foreach($heroStats as $stat)
                            <div>
                                <dt class="sr-only">{{ $stat['label'] }}</dt>
                                <dd>
                                    <span class="block font-display text-3xl font-semibold text-ink md:text-4xl">{{ $stat['value'] }}</span>
                                    <span class="lc-meta mt-1.5 block">{{ $stat['label'] }}</span>
                                </dd>
                            </div>
                        @endforeach
                    </dl>
                @endif
            </div>

            {{-- ---------- Operating-model panel ---------- --}}
            <div class="lc-enter lg:col-span-5" style="--lc-delay: 300ms">
                <div class="lc-panel lc-edge-lit relative overflow-hidden">

                    {{-- Panel chrome --}}
                    <div class="flex items-center justify-between gap-3 border-b border-line-soft bg-surface-base/70 px-5 py-3">
                        <div class="flex items-center gap-2" aria-hidden="true">
                            <span class="h-2 w-2 rounded-full bg-primary-500/70"></span>
                            <span class="h-2 w-2 rounded-full bg-accent-500/50"></span>
                            <span class="h-2 w-2 rounded-full bg-primary-300/40"></span>
                        </div>
                        <p class="lc-meta">logicore / how we work</p>
                    </div>

                    <div aria-hidden="true" class="pointer-events-none absolute inset-0 lc-grid-micro opacity-[0.35]"></div>

                    <ol class="relative divide-y divide-line-soft">
                        @foreach($heroPhases as $i => $phase)
                            <li class="flex items-start gap-4 px-5 py-5">
                                <span class="lc-meta mt-1 w-6 shrink-0 text-accent-500">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                <div class="min-w-0">
                                    <p class="font-mono text-xs uppercase tracking-[0.2em] text-primary-300">{{ $phase['tag'] }}</p>
                                    <p class="mt-1.5 font-display text-[0.9375rem] font-semibold text-ink">{{ $phase['title'] }}</p>
                                    <p class="lc-body mt-1 text-[0.8125rem]">{{ $phase['note'] }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ol>

                    <div class="relative flex items-center justify-between gap-4 border-t border-line-soft bg-surface-base/60 px-5 py-4">
                        <p class="lc-meta">Think. Build. Scale.</p>
                        <a href="#about" class="lc-link text-sm">
                            Our approach
                            <i class="fas fa-arrow-right lc-arrow text-[0.65rem]" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll cue --}}
    <a href="#about"
       class="lc-meta absolute bottom-6 left-1/2 hidden -translate-x-1/2 items-center gap-2 rounded-sm px-2 py-1 text-ink-subtle transition hover:text-accent-500 lg:inline-flex">
        <span>Scroll</span>
        <i class="fas fa-chevron-down text-[0.65rem]" aria-hidden="true"></i>
    </a>

    <div aria-hidden="true" class="lc-rule absolute inset-x-0 bottom-0"></div>
</section>
