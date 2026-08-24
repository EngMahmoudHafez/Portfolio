@extends('layouts.app')

@section('title', 'Projects - Logicore')
@section('meta_description', 'Selected work from Logicore — scalable digital products, intelligent systems, and engineered interfaces.')

@section('content')

{{-- ============================================================
     PAGE HEADER
     ============================================================ --}}
<section class="relative overflow-hidden pt-28 pb-14 md:pt-36 md:pb-20" aria-labelledby="projects-heading">

    {{-- Technical atmosphere --}}
    <div aria-hidden="true" class="pointer-events-none absolute inset-0">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_70%_60%_at_20%_0%,rgba(23,107,255,0.22),transparent_65%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_45%_50%_at_95%_10%,rgba(0,193,255,0.12),transparent_70%)]"></div>
        <div class="absolute inset-0 lc-grid-fine lc-mask-soft opacity-70"></div>
        <div class="absolute inset-0 lc-circuit lc-mask-soft opacity-35"></div>
    </div>

    <div class="lc-shell relative">
        <div class="grid items-end gap-10 lg:grid-cols-12 lg:gap-12">

            {{-- Editorial title block --}}
            <div class="lc-enter lg:col-span-7" style="--lc-delay: 40ms">
                <nav aria-label="Breadcrumb" class="mb-6">
                    <ol class="lc-meta flex items-center gap-2">
                        <li><a href="{{ route('home') }}" class="rounded-sm transition hover:text-accent-500">Home</a></li>
                        <li aria-hidden="true" class="text-ink-subtle/50">/</li>
                        <li aria-current="page" class="text-ink-muted">Projects</li>
                    </ol>
                </nav>

                <p class="lc-eyebrow">Selected Work</p>

                <h1 id="projects-heading" class="lc-h1 mt-5">
                    Systems we<br class="hidden sm:block">
                    <span class="text-gradient">designed, built</span>, and shipped.
                </h1>

                <p class="lc-lead mt-6 max-w-xl">
                    Explore scalable digital products and intelligent systems built by Logicore — each one
                    engineered end to end, from architecture to interface.
                </p>
            </div>

            {{-- Index spec panel --}}
            <div class="lc-enter lg:col-span-5 lg:justify-self-end" style="--lc-delay: 160ms">
                <dl class="lc-panel lc-edge-lit grid w-full grid-cols-2 divide-x divide-line-soft sm:max-w-sm lg:w-72">
                    <div class="px-5 py-4">
                        <dt class="lc-spec-key">Projects</dt>
                        <dd class="lc-spec-val mt-1.5">{{ str_pad((string) $projects->total(), 2, '0', STR_PAD_LEFT) }}</dd>
                    </div>
                    <div class="px-5 py-4">
                        <dt class="lc-spec-key">Categories</dt>
                        <dd class="lc-spec-val mt-1.5">{{ str_pad((string) $categories->count(), 2, '0', STR_PAD_LEFT) }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <div aria-hidden="true" class="lc-rule absolute inset-x-0 bottom-0"></div>
</section>

{{-- ============================================================
     PROJECT NAVIGATOR + GRID
     ============================================================ --}}
<section class="lc-section-tight" aria-labelledby="projects-navigator-heading">
    <div class="lc-shell">

        @php
            $activeCategory = $categories->firstWhere('id', $currentCategory ?? null);
            $hasFilter = ($search ?? null) || ($currentCategory ?? null);
        @endphp

        <h2 id="projects-navigator-heading" class="sr-only">Browse projects</h2>

        {{-- ---------- Navigator ---------- --}}
        <div class="lc-navigator lc-edge-lit lc-enter overflow-hidden" style="--lc-delay: 240ms">

            {{-- Search --}}
            <div class="p-4 sm:p-5">
                <form action="{{ route('projects.index') }}" method="GET" role="search"
                      class="flex flex-col gap-3 sm:flex-row sm:items-center">

                    <div class="lc-search flex-1">
                        <label for="project-search" class="sr-only">Search projects</label>
                        <i class="fas fa-magnifying-glass lc-search-icon" aria-hidden="true"></i>

                        <input type="search"
                               id="project-search"
                               name="search"
                               value="{{ $search ?? '' }}"
                               placeholder="Search projects by name or description…"
                               autocomplete="off"
                               class="lc-field h-12 {{ ($search ?? null) ? 'pr-11' : '' }}">

                        @if($search ?? null)
                            <a href="{{ route('projects.index') }}" class="lc-search-clear" aria-label="Clear search">
                                <i class="fas fa-xmark text-xs" aria-hidden="true"></i>
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="lc-btn lc-btn-primary h-12 shrink-0 sm:px-6">
                        Search
                        <i class="fas fa-arrow-right lc-arrow text-[0.7rem]" aria-hidden="true"></i>
                    </button>
                </form>
            </div>

            {{-- Category filters --}}
            <div class="border-t border-line-soft bg-surface-base/60 px-4 py-3.5 sm:px-5">
                <div class="flex flex-col gap-3 md:flex-row md:items-center md:gap-5">
                    <p id="filter-label" class="lc-meta shrink-0 uppercase tracking-[0.18em]">Filter</p>

                    <div class="lc-rail" role="group" aria-labelledby="filter-label">
                        <a href="{{ route('projects.index') }}"
                           class="lc-filter"
                           @if(!($currentCategory ?? null)) aria-current="true" @endif>
                            All work
                        </a>

                        @foreach($categories as $cat)
                            <a href="{{ route('projects.index', ['category' => $cat->id]) }}"
                               class="lc-filter"
                               @if(($currentCategory ?? null) == $cat->id) aria-current="true" @endif>
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- ---------- Result summary ---------- --}}
        <div class="lc-enter mt-8 flex flex-wrap items-center justify-between gap-x-6 gap-y-3" style="--lc-delay: 300ms" role="status" aria-live="polite">
            <p class="lc-meta">
                <span class="text-ink-muted">{{ $projects->total() }}</span>
                {{ Str::plural('project', $projects->total()) }}
                @if($search ?? null)
                    matching <span class="text-accent-500">“{{ $search }}”</span>
                @elseif($activeCategory)
                    in <span class="text-accent-500">{{ $activeCategory->name }}</span>
                @endif
            </p>

            @if($hasFilter)
                <a href="{{ route('projects.index') }}" class="lc-link text-sm">
                    <i class="fas fa-rotate-left text-[0.7rem]" aria-hidden="true"></i>
                    Reset filters
                </a>
            @endif
        </div>

        {{-- ---------- Grid ---------- --}}
        @if($projects->count())
            <ul class="mt-6 grid gap-5 sm:grid-cols-2 lg:gap-6 xl:grid-cols-3">
                @foreach($projects as $project)
                    <li class="flex">
                        <x-project-card :project="$project"
                                        :index="$loop->index"
                                        :eager="$loop->index < 3" />
                    </li>
                @endforeach
            </ul>

            {{-- ---------- Pagination ---------- --}}
            <div class="mt-14">
                {{ $projects->appends(request()->except('page'))->links('vendor.pagination.logicore') }}
            </div>
        @else
            {{-- ---------- Empty state ---------- --}}
            <div class="lc-panel lc-edge-lit lc-enter relative mt-6 overflow-hidden px-6 py-16 text-center sm:py-20" style="--lc-delay: 340ms">
                <div aria-hidden="true" class="pointer-events-none absolute inset-0 lc-grid-micro lc-mask-soft opacity-40"></div>

                <div class="relative mx-auto max-w-md">
                    <span aria-hidden="true"
                          class="mx-auto flex h-14 w-14 items-center justify-center rounded-md border border-line bg-surface-base text-accent-500 shadow-[0_0_0_8px_rgba(10,15,35,0.6)]">
                        <i class="fas fa-folder-open text-lg"></i>
                    </span>

                    <h3 class="lc-h3 mt-6">No projects found</h3>

                    <p class="lc-body mt-3">
                        @if($search ?? null)
                            Nothing matched “{{ $search }}”. Try a different term, or browse the full index.
                        @elseif($activeCategory)
                            There is nothing published under {{ $activeCategory->name }} yet.
                        @else
                            Work is being published here soon.
                        @endif
                    </p>

                    <div class="mt-7 flex flex-col justify-center gap-3 sm:flex-row">
                        @if($hasFilter)
                            <a href="{{ route('projects.index') }}" class="lc-btn lc-btn-primary">
                                View all projects
                                <i class="fas fa-arrow-right lc-arrow text-[0.7rem]" aria-hidden="true"></i>
                            </a>
                        @endif
                        <a href="{{ route('home') }}#contact" class="lc-btn lc-btn-outline">
                            <i class="fas fa-paper-plane text-[0.7rem]" aria-hidden="true"></i>
                            Start a project
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     CLOSING CTA
     ============================================================ --}}
<section class="pb-24" aria-labelledby="projects-cta-heading">
    <div class="lc-shell">
        <div class="lc-panel lc-edge-lit lc-rise relative overflow-hidden px-6 py-12 sm:px-10 md:py-14">
            <div aria-hidden="true" class="pointer-events-none absolute inset-0">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_60%_120%_at_85%_50%,rgba(0,193,255,0.14),transparent_70%)]"></div>
                <div class="absolute inset-0 lc-circuit opacity-25"></div>
            </div>

            <div class="relative flex flex-col items-start justify-between gap-8 md:flex-row md:items-center">
                <div class="max-w-xl">
                    <p class="lc-eyebrow">Next Build</p>
                    <h2 id="projects-cta-heading" class="lc-h2 mt-4 text-[1.75rem] md:text-[2.25rem]">
                        Have a system that needs to scale?
                    </h2>
                    <p class="lc-body mt-3">
                        Tell us what you're building. We'll come back with an architecture, a scope, and a timeline.
                    </p>
                </div>

                <a href="{{ route('home') }}#contact" class="lc-btn lc-btn-primary lc-btn-lg shrink-0">
                    Start a project
                    <i class="fas fa-arrow-right lc-arrow text-[0.7rem]" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
