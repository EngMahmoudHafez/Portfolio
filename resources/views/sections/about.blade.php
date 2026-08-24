@php
    // Only real, published data is counted here — nothing is invented.
    $aboutFigures = collect([
        ['label' => 'Services',   'value' => ($services ?? collect())->count(), 'note' => 'End-to-end capabilities'],
        ['label' => 'Team Units', 'value' => ($team ?? collect())->count(),     'note' => 'Specialised disciplines'],
        ['label' => 'Skills',     'value' => ($skills ?? collect())->count(),   'note' => 'Tools and technologies'],
    ])->filter(fn ($figure) => $figure['value'] > 0)->values();

    $aboutPillars = [
        ['icon' => 'fas fa-eye', 'title' => 'Our Vision', 'body' => 'To become a trusted technology partner for businesses that want to innovate, scale, and operate smarter.'],
        ['icon' => 'fas fa-bullseye', 'title' => 'Our Mission', 'body' => 'To deliver high-quality, scalable, and intelligent digital solutions that solve real business problems and create measurable impact.'],
    ];
@endphp

<section id="about" class="lc-section relative overflow-hidden" aria-labelledby="about-heading">

    <div aria-hidden="true" class="pointer-events-none absolute inset-0">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_50%_60%_at_85%_20%,rgba(23,107,255,0.13),transparent_65%)]"></div>
        <div class="absolute inset-0 lc-circuit lc-mask-soft opacity-25"></div>
    </div>

    <div class="lc-shell relative">
        <div class="grid gap-14 lg:grid-cols-12 lg:gap-16">

            {{-- ---------- Narrative ---------- --}}
            <div class="lc-rise lg:col-span-7">
                <p class="lc-eyebrow">About Logicore</p>

                <h2 id="about-heading" class="lc-h2 mt-5 max-w-xl">
                    Transforming ideas into
                    <span class="text-gradient">intelligent, scalable systems</span>.
                </h2>

                <p class="lc-lead mt-6 max-w-xl">
                    Logicore helps businesses turn ambitious ideas into reliable digital products. We combine
                    software engineering, intelligent automation, and clean product design to create scalable
                    solutions built for real growth.
                </p>

                <div class="mt-10 grid gap-px overflow-hidden rounded-lg border border-line-soft bg-line-soft sm:grid-cols-2">
                    @foreach($aboutPillars as $pillar)
                        <div class="bg-surface-2 p-6">
                            <span aria-hidden="true"
                                  class="flex h-10 w-10 items-center justify-center rounded-md border border-line bg-surface-base text-accent-500">
                                <i class="{{ $pillar['icon'] }} text-sm"></i>
                            </span>
                            <h3 class="lc-h3 mt-4 text-[1.0625rem]">{{ $pillar['title'] }}</h3>
                            <p class="lc-body mt-2 text-[0.875rem]">{{ $pillar['body'] }}</p>
                        </div>
                    @endforeach
                </div>

                <a href="#services" class="lc-link mt-8 inline-flex">
                    See what we do
                    <i class="fas fa-arrow-right lc-arrow text-[0.7rem]" aria-hidden="true"></i>
                </a>
            </div>

            {{-- ---------- Studio index ---------- --}}
            <div class="lc-rise lg:col-span-5">
                <div class="relative lg:sticky lg:top-28">

                    <x-brand-logo :icon-only="true"
                                  mark-class="h-40 w-auto"
                                  class="pointer-events-none absolute -right-6 -top-14 hidden select-none opacity-[0.05] lg:inline-flex" />

                    <div class="lc-panel lc-edge-lit relative overflow-hidden">
                        <div class="flex items-center justify-between border-b border-line-soft bg-surface-base/70 px-5 py-3">
                            <p class="lc-meta uppercase tracking-[0.18em]">Studio Index</p>
                            <span aria-hidden="true" class="h-1.5 w-1.5 rounded-full bg-accent-500/70"></span>
                        </div>

                        @if($aboutFigures->isNotEmpty())
                            <dl class="divide-y divide-line-soft">
                                @foreach($aboutFigures as $figure)
                                    <div class="flex items-baseline justify-between gap-6 px-5 py-5">
                                        <div>
                                            <dt class="font-display text-[0.9375rem] font-semibold text-ink">{{ $figure['label'] }}</dt>
                                            <p class="lc-body mt-0.5 text-[0.8125rem]">{{ $figure['note'] }}</p>
                                        </div>
                                        <dd class="font-mono text-2xl font-medium text-accent-500 tabular-nums">
                                            {{ str_pad((string) $figure['value'], 2, '0', STR_PAD_LEFT) }}
                                        </dd>
                                    </div>
                                @endforeach
                            </dl>
                        @endif

                        <div class="border-t border-line-soft bg-surface-base/60 px-5 py-5">
                            <p class="lc-body text-[0.875rem]">
                                Every engagement runs the same loop: understand the constraint, design the system,
                                ship it, then make it scale.
                            </p>
                            <a href="#contact" class="lc-link mt-4 text-sm">
                                Talk to the team
                                <i class="fas fa-arrow-right lc-arrow text-[0.65rem]" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
