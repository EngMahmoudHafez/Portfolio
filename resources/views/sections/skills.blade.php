@php
    $skillNames = ($skills ?? collect())->pluck('name')->filter()->values();

    if ($skillNames->isEmpty()) {
        $skillNames = collect(['Laravel', 'React', 'PHP', 'UI/UX', 'Mobile Apps', 'AI Solutions', 'DevOps', 'Backend Engineering']);
    }
@endphp

<section id="skills" class="lc-section-tight relative overflow-hidden" aria-labelledby="skills-heading">

    <div aria-hidden="true" class="pointer-events-none absolute inset-0 lc-grid-fine lc-mask-soft opacity-40"></div>

    <div class="lc-shell relative">
        <div class="grid gap-10 lg:grid-cols-12 lg:items-center lg:gap-16">

            <div class="lc-rise lg:col-span-4">
                <p class="lc-eyebrow">Expertise</p>
                <h2 id="skills-heading" class="lc-h2 mt-5 text-[1.75rem] md:text-[2.25rem]">
                    The stack we <span class="text-gradient">work in</span>.
                </h2>
                <p class="lc-body mt-4">
                    Tools chosen for maintainability and scale — not novelty.
                </p>
            </div>

            <div class="lc-rise lg:col-span-8">
                <ul class="grid gap-px overflow-hidden rounded-lg border border-line-soft bg-line-soft sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($skillNames as $i => $skill)
                        <li class="group flex items-center justify-between gap-4 bg-surface-2 px-5 py-4 transition-colors duration-200 hover:bg-surface-3">
                            <span class="font-display text-[0.9375rem] font-medium text-ink-muted transition-colors duration-200 group-hover:text-ink">
                                {{ $skill }}
                            </span>
                            <span aria-hidden="true" class="lc-meta text-ink-subtle/60 transition-colors duration-200 group-hover:text-accent-500">
                                {{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
