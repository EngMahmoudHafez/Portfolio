@extends('layouts.app')

@section('title', $project->title . ' - Logicore')
@section('meta_description', $project->short_description ?? Str::limit(strip_tags((string) $project->description), 160))

@section('content')

@php
    $technologies = is_array($project->technologies) ? array_values(array_filter($project->technologies)) : [];
    $gallery      = is_array($project->gallery) ? array_values(array_filter($project->gallery)) : [];
    $initials     = Str::upper(Str::substr(preg_replace('/[^A-Za-z0-9]/', '', (string) $project->title), 0, 2)) ?: 'LC';
@endphp

{{-- ============================================================
     CASE STUDY HEADER
     ============================================================ --}}
<article>
<header class="relative overflow-hidden pt-28 pb-12 md:pt-36 md:pb-16">

    <div aria-hidden="true" class="pointer-events-none absolute inset-0">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_65%_60%_at_25%_0%,rgba(23,107,255,0.22),transparent_66%)]"></div>
        <div class="absolute inset-0 lc-grid-fine lc-mask-soft opacity-70"></div>
        <div class="absolute inset-0 lc-circuit lc-mask-soft opacity-30"></div>
    </div>

    <div class="lc-shell relative">

        {{-- Back / breadcrumb --}}
        <nav aria-label="Breadcrumb" class="lc-enter mb-8">
            <ol class="lc-meta flex flex-wrap items-center gap-2">
                <li><a href="{{ route('home') }}" class="rounded-sm transition hover:text-accent-500">Home</a></li>
                <li aria-hidden="true" class="text-ink-subtle/50">/</li>
                <li><a href="{{ route('projects.index') }}" class="rounded-sm transition hover:text-accent-500">Projects</a></li>
                <li aria-hidden="true" class="text-ink-subtle/50">/</li>
                <li aria-current="page" class="max-w-[16rem] truncate text-ink-muted">{{ $project->title }}</li>
            </ol>
        </nav>

        <div class="grid items-end gap-10 lg:grid-cols-12">

            <div class="lc-enter lg:col-span-8" style="--lc-delay: 60ms">
                <div class="flex flex-wrap items-center gap-3">
                    @if($project->category)
                        <a href="{{ route('projects.index', ['category' => $project->category->id]) }}"
                           class="lc-tag lc-tag-accent transition hover:border-accent-500/60 hover:bg-accent-500/15">
                            {{ $project->category->name }}
                        </a>
                    @endif

                    @if($project->completed_at)
                        <span class="lc-meta flex items-center gap-2">
                            <i class="fas fa-circle-check text-[0.65rem] text-accent-500/70" aria-hidden="true"></i>
                            Completed
                            <time datetime="{{ $project->completed_at->toDateString() }}" class="text-ink-muted">
                                {{ $project->completed_at->format('F Y') }}
                            </time>
                        </span>
                    @endif
                </div>

                <h1 class="lc-h1 mt-6 text-[2.25rem] leading-[1.06] sm:text-[2.75rem] lg:text-[3.5rem]">
                    {{ $project->title }}
                </h1>

                @if($project->short_description)
                    <p class="lc-lead mt-6 max-w-2xl">{{ $project->short_description }}</p>
                @endif
            </div>

            {{-- Primary actions --}}
            @if($project->live_url || $project->github_url)
                <div class="lc-enter flex flex-wrap gap-3 lg:col-span-4 lg:justify-end" style="--lc-delay: 140ms">
                    @if($project->live_url)
                        <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer"
                           class="lc-btn lc-btn-primary">
                            <i class="fas fa-arrow-up-right-from-square text-[0.7rem]" aria-hidden="true"></i>
                            Live Demo
                            <span class="sr-only">(opens in a new tab)</span>
                        </a>
                    @endif

                    @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer"
                           class="lc-btn lc-btn-outline">
                            <i class="fab fa-github text-sm" aria-hidden="true"></i>
                            GitHub
                            <span class="sr-only">(opens in a new tab)</span>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</header>

{{-- ============================================================
     HERO IMAGE
     ============================================================ --}}
<div class="lc-shell">
    <figure class="lc-enter relative overflow-hidden rounded-lg border border-line bg-surface-base shadow-[0_40px_90px_-50px_rgba(0,0,0,0.95)]"
            style="--lc-delay: 220ms">
        <div class="relative aspect-[16/9] md:aspect-[21/9]">
            @if($project->cover_image)
                <img src="{{ asset('storage/' . $project->cover_image) }}"
                     alt="{{ $project->title }}"
                     class="h-full w-full object-cover"
                     fetchpriority="high"
                     decoding="async">
            @else
                <div class="lc-fallback" role="img" aria-label="{{ $project->title }} — no cover image available">
                    <span class="lc-fallback-inner">
                        <span class="lc-fallback-mark !h-16 !w-16 !text-2xl" aria-hidden="true">{{ $initials }}</span>
                        <span class="lc-fallback-label">{{ $project->category?->name ?? 'Logicore Build' }}</span>
                    </span>
                </div>
            @endif
        </div>
        <span aria-hidden="true" class="pointer-events-none absolute inset-0 rounded-lg ring-1 ring-inset ring-white/[0.06]"></span>
    </figure>
</div>

{{-- ============================================================
     BODY: OVERVIEW + SPEC SIDEBAR
     ============================================================ --}}
<section class="lc-section-tight" aria-labelledby="overview-heading">
    <div class="lc-shell">
        <div class="grid gap-12 lg:grid-cols-12 lg:gap-16">

            {{-- Overview --}}
            <div class="lc-rise lg:col-span-7 xl:col-span-8">
                <h2 id="overview-heading" class="lc-eyebrow">Overview</h2>
                <div class="lc-prose mt-6 max-w-2xl">
                    {!! nl2br(e($project->description)) !!}
                </div>
            </div>

            {{-- Spec sidebar --}}
            <aside class="lc-rise lg:col-span-5 xl:col-span-4" aria-labelledby="specs-heading">
                <div class="lc-panel lc-edge-lit sticky top-28 overflow-hidden">
                    <div class="border-b border-line-soft px-6 py-4">
                        <h2 id="specs-heading" class="lc-meta uppercase tracking-[0.18em]">Project Details</h2>
                    </div>

                    <dl class="divide-y divide-line-soft px-6">
                        @if($project->category)
                            <div class="lc-spec">
                                <dt class="lc-spec-key">Category</dt>
                                <dd class="lc-spec-val text-base">{{ $project->category->name }}</dd>
                            </div>
                        @endif

                        @if($project->completed_at)
                            <div class="lc-spec">
                                <dt class="lc-spec-key">Completed</dt>
                                <dd class="lc-spec-val text-base">
                                    <time datetime="{{ $project->completed_at->toDateString() }}">
                                        {{ $project->completed_at->format('F Y') }}
                                    </time>
                                </dd>
                            </div>
                        @endif

                        @if(count($technologies))
                            <div class="lc-spec">
                                <dt class="lc-spec-key">Stack</dt>
                                <dd class="mt-1">
                                    <ul class="flex flex-wrap gap-1.5">
                                        @foreach($technologies as $tech)
                                            <li class="lc-tag">{{ $tech }}</li>
                                        @endforeach
                                    </ul>
                                </dd>
                            </div>
                        @endif

                        @if(count($gallery))
                            <div class="lc-spec">
                                <dt class="lc-spec-key">Gallery</dt>
                                <dd class="lc-spec-val text-base">{{ count($gallery) }} {{ Str::plural('image', count($gallery)) }}</dd>
                            </div>
                        @endif
                    </dl>

                    @if($project->live_url || $project->github_url)
                        <div class="space-y-2.5 border-t border-line-soft p-6">
                            @if($project->live_url)
                                <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer"
                                   class="lc-btn lc-btn-primary lc-btn-block">
                                    <i class="fas fa-arrow-up-right-from-square text-[0.7rem]" aria-hidden="true"></i>
                                    Visit live site
                                    <span class="sr-only">(opens in a new tab)</span>
                                </a>
                            @endif
                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer"
                                   class="lc-btn lc-btn-outline lc-btn-block">
                                    <i class="fab fa-github text-sm" aria-hidden="true"></i>
                                    View source
                                    <span class="sr-only">(opens in a new tab)</span>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </aside>
        </div>
    </div>
</section>

{{-- ============================================================
     GALLERY
     ============================================================ --}}
@if(count($gallery))
<section class="lc-section-tight pt-0" aria-labelledby="gallery-heading"
         x-data="{
            open: false,
            active: 0,
            images: {{ Js::from(collect($gallery)->map(fn ($img) => asset('storage/' . $img))->all()) }},
            show(i) { this.active = i; this.open = true; document.body.style.overflow = 'hidden'; },
            close() { this.open = false; document.body.style.overflow = ''; },
            next() { this.active = (this.active + 1) % this.images.length; },
            prev() { this.active = (this.active - 1 + this.images.length) % this.images.length; },
         }"
         @keydown.escape.window="open && close()"
         @keydown.arrow-right.window="open && next()"
         @keydown.arrow-left.window="open && prev()">

    <div class="lc-shell">
        <div class="lc-rise flex items-end justify-between gap-6">
            <div>
                <p class="lc-eyebrow">Gallery</p>
                <h2 id="gallery-heading" class="lc-h2 mt-4 text-[1.75rem] md:text-[2rem]">Inside the build</h2>
            </div>
            <p class="lc-meta hidden shrink-0 sm:block">{{ str_pad((string) count($gallery), 2, '0', STR_PAD_LEFT) }} images</p>
        </div>

        <ul class="lc-rise mt-8 grid grid-cols-2 gap-3 sm:gap-4 lg:grid-cols-3">
            @foreach($gallery as $i => $img)
                <li>
                    <button type="button"
                            @click="show({{ $i }})"
                            class="lc-gallery-item group w-full">
                        <img src="{{ asset('storage/' . $img) }}"
                             alt="{{ $project->title }} — gallery image {{ $i + 1 }}"
                             loading="lazy"
                             decoding="async">
                        <span aria-hidden="true"
                              class="pointer-events-none absolute inset-0 flex items-center justify-center bg-surface-base/60 opacity-0 transition-opacity duration-200 group-hover:opacity-100 group-focus-visible:opacity-100">
                            <span class="flex h-9 w-9 items-center justify-center rounded-md border border-accent-500/40 bg-surface-1/80 text-accent-500">
                                <i class="fas fa-expand text-xs"></i>
                            </span>
                        </span>
                        <span class="sr-only">Enlarge image {{ $i + 1 }}</span>
                    </button>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- Lightbox --}}
    <div x-show="open" x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         role="dialog" aria-modal="true" aria-label="Project gallery"
         @click.self="close()"
         class="fixed inset-0 z-[95] flex items-center justify-center bg-surface-base/95 p-4 backdrop-blur-sm sm:p-8">

        <button type="button" @click="close()"
                class="absolute right-4 top-4 flex h-10 w-10 items-center justify-center rounded-md border border-line bg-surface-1 text-ink-muted transition hover:text-ink sm:right-6 sm:top-6"
                aria-label="Close gallery">
            <i class="fas fa-xmark" aria-hidden="true"></i>
        </button>

        <template x-if="images.length > 1">
            <button type="button" @click="prev()"
                    class="absolute left-3 flex h-11 w-11 items-center justify-center rounded-md border border-line bg-surface-1/85 text-ink-muted transition hover:text-ink sm:left-6"
                    aria-label="Previous image">
                <i class="fas fa-chevron-left" aria-hidden="true"></i>
            </button>
        </template>

        <figure class="max-h-full w-full max-w-5xl">
            <img :src="images[active]" :alt="'Gallery image ' + (active + 1)"
                 class="mx-auto max-h-[78vh] w-auto rounded-md border border-line object-contain shadow-2xl">
            <figcaption class="lc-meta mt-4 text-center">
                <span x-text="active + 1"></span> / <span x-text="images.length"></span>
            </figcaption>
        </figure>

        <template x-if="images.length > 1">
            <button type="button" @click="next()"
                    class="absolute right-3 flex h-11 w-11 items-center justify-center rounded-md border border-line bg-surface-1/85 text-ink-muted transition hover:text-ink sm:right-6"
                    aria-label="Next image">
                <i class="fas fa-chevron-right" aria-hidden="true"></i>
            </button>
        </template>
    </div>
</section>
@endif
</article>

{{-- ============================================================
     FOOTER NAV + CTA
     ============================================================ --}}
<section class="pb-24" aria-labelledby="project-cta-heading">
    <div class="lc-shell">
        <hr class="lc-rule-quiet mb-12">

        <div class="lc-rise flex flex-col items-start justify-between gap-8 md:flex-row md:items-center">
            <div>
                <a href="{{ route('projects.index') }}" class="lc-link">
                    <i class="fas fa-arrow-left text-[0.7rem]" aria-hidden="true"></i>
                    Back to all projects
                </a>
                <h2 id="project-cta-heading" class="lc-h3 mt-4 max-w-md">
                    Building something similar? Let's scope it together.
                </h2>
            </div>

            <a href="{{ route('home') }}#contact" class="lc-btn lc-btn-primary lc-btn-lg shrink-0">
                Start a project
                <i class="fas fa-arrow-right lc-arrow text-[0.7rem]" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

@endsection
