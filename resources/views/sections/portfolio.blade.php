<section id="portfolio" class="lc-section relative overflow-hidden bg-surface-1" aria-labelledby="portfolio-heading">

    <div aria-hidden="true" class="pointer-events-none absolute inset-0">
        <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-primary-500/25 to-transparent"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_55%_50%_at_15%_25%,rgba(0,193,255,0.10),transparent_65%)]"></div>
        <div class="absolute inset-0 lc-grid-fine lc-mask-soft opacity-45"></div>
    </div>

    <div class="lc-shell relative">

        <div class="flex flex-col gap-8 md:flex-row md:items-end md:justify-between">
            <x-section-heading
                id="portfolio-heading"
                eyebrow="Our Work"
                lead="Explore how Logicore turns ideas into practical digital products."
                class="max-w-xl">
                <x-slot:title-slot>
                    Featured <span class="text-gradient">projects</span>.
                </x-slot:title-slot>
            </x-section-heading>

            @if(($projects ?? collect())->count())
                <a href="{{ route('projects.index') }}" class="lc-btn lc-btn-outline lc-rise shrink-0 self-start md:self-auto">
                    View all projects
                    <i class="fas fa-arrow-right lc-arrow text-[0.7rem]" aria-hidden="true"></i>
                </a>
            @endif
        </div>

        @if(($projects ?? collect())->count())
            <ul class="mt-14 grid gap-5 sm:grid-cols-2 lg:gap-6 xl:grid-cols-3">
                @foreach($projects as $project)
                    <li class="flex">
                        <x-project-card :project="$project" :index="$loop->index" />
                    </li>
                @endforeach
            </ul>
        @else
            <div class="lc-panel lc-edge-lit lc-rise relative mt-14 overflow-hidden px-6 py-16 text-center">
                <div aria-hidden="true" class="pointer-events-none absolute inset-0 lc-grid-micro lc-mask-soft opacity-40"></div>
                <div class="relative mx-auto max-w-md">
                    <span aria-hidden="true"
                          class="mx-auto flex h-14 w-14 items-center justify-center rounded-md border border-line bg-surface-base text-accent-500">
                        <i class="fas fa-folder-open text-lg"></i>
                    </span>
                    <h3 class="lc-h3 mt-6">Case studies coming soon</h3>
                    <p class="lc-body mt-3">
                        We're preparing the first set of published builds. In the meantime, tell us what you need
                        and we'll walk you through comparable work.
                    </p>
                    <a href="#contact" class="lc-btn lc-btn-primary mt-7">
                        Start a project
                        <i class="fas fa-arrow-right lc-arrow text-[0.7rem]" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>
