@extends('layouts.app')

@section('title', 'Blog - Logicore')
@section('meta_description', 'Field notes from Logicore on intelligent products, automation, and scalable systems.')

@section('content')

@php
    $activeCategory = $categories->firstWhere('id', $currentCategory ?? null);
    $activeTag      = $tags->firstWhere('id', $currentTag ?? null);
    $hasFilter      = ($search ?? null) || ($currentCategory ?? null) || ($currentTag ?? null);
@endphp

{{-- ============================================================
     PAGE HEADER
     ============================================================ --}}
<section class="relative overflow-hidden pt-28 pb-14 md:pt-36 md:pb-20" aria-labelledby="blog-heading">

    <div aria-hidden="true" class="pointer-events-none absolute inset-0">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_70%_60%_at_20%_0%,rgba(23,107,255,0.22),transparent_65%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_45%_50%_at_95%_10%,rgba(0,193,255,0.12),transparent_70%)]"></div>
        <div class="absolute inset-0 lc-grid-fine lc-mask-soft opacity-70"></div>
        <div class="absolute inset-0 lc-circuit lc-mask-soft opacity-30"></div>
    </div>

    <div class="lc-shell relative">
        <div class="grid items-end gap-10 lg:grid-cols-12 lg:gap-12">

            <div class="lc-enter lg:col-span-7" style="--lc-delay: 40ms">
                <nav aria-label="Breadcrumb" class="mb-6">
                    <ol class="lc-meta flex items-center gap-2">
                        <li><a href="{{ route('home') }}" class="rounded-sm transition hover:text-accent-500">Home</a></li>
                        <li aria-hidden="true" class="text-ink-subtle/50">/</li>
                        <li aria-current="page" class="text-ink-muted">Blog</li>
                    </ol>
                </nav>

                <p class="lc-eyebrow">Field Notes</p>

                <h1 id="blog-heading" class="lc-h1 mt-5">
                    Notes on building<br class="hidden sm:block">
                    <span class="text-gradient">systems that last</span>.
                </h1>

                <p class="lc-lead mt-6 max-w-xl">
                    Updates and insights on intelligent products, automation, and scalable systems —
                    written by the people doing the work.
                </p>
            </div>

            <div class="lc-enter lg:col-span-5 lg:justify-self-end" style="--lc-delay: 160ms">
                <dl class="lc-panel lc-edge-lit grid w-full grid-cols-2 divide-x divide-line-soft sm:max-w-sm lg:w-72">
                    <div class="px-5 py-4">
                        <dt class="lc-spec-key">Articles</dt>
                        <dd class="lc-spec-val mt-1.5">{{ str_pad((string) $posts->total(), 2, '0', STR_PAD_LEFT) }}</dd>
                    </div>
                    <div class="px-5 py-4">
                        <dt class="lc-spec-key">Topics</dt>
                        <dd class="lc-spec-val mt-1.5">{{ str_pad((string) $categories->count(), 2, '0', STR_PAD_LEFT) }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <div aria-hidden="true" class="lc-rule absolute inset-x-0 bottom-0"></div>
</section>

{{-- ============================================================
     NAVIGATOR + GRID
     ============================================================ --}}
<section class="lc-section-tight" aria-labelledby="blog-navigator-heading">
    <div class="lc-shell">

        <h2 id="blog-navigator-heading" class="sr-only">Browse articles</h2>

        <div class="lc-navigator lc-edge-lit lc-enter overflow-hidden" style="--lc-delay: 240ms">

            {{-- Search --}}
            <div class="p-4 sm:p-5">
                <form action="{{ route('blog.index') }}" method="GET" role="search"
                      class="flex flex-col gap-3 sm:flex-row sm:items-center">

                    <div class="lc-search flex-1">
                        <label for="blog-search" class="sr-only">Search articles</label>
                        <i class="fas fa-magnifying-glass lc-search-icon" aria-hidden="true"></i>

                        <input type="search"
                               id="blog-search"
                               name="search"
                               value="{{ $search ?? '' }}"
                               placeholder="Search articles by title or content…"
                               autocomplete="off"
                               class="lc-field h-12 {{ ($search ?? null) ? 'pr-11' : '' }}">

                        @if($search ?? null)
                            <a href="{{ route('blog.index') }}" class="lc-search-clear" aria-label="Clear search">
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

            {{-- Categories --}}
            <div class="border-t border-line-soft bg-surface-base/60 px-4 py-3.5 sm:px-5">
                <div class="flex flex-col gap-3 md:flex-row md:items-center md:gap-5">
                    <p id="blog-filter-label" class="lc-meta shrink-0 uppercase tracking-[0.18em]">Topics</p>

                    <div class="lc-rail" role="group" aria-labelledby="blog-filter-label">
                        <a href="{{ route('blog.index') }}"
                           class="lc-filter"
                           @if(!($currentCategory ?? null) && !($currentTag ?? null)) aria-current="true" @endif>
                            All articles
                        </a>

                        @foreach($categories as $cat)
                            <a href="{{ route('blog.index', ['category' => $cat->id]) }}"
                               class="lc-filter"
                               @if(($currentCategory ?? null) == $cat->id) aria-current="true" @endif>
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Tags --}}
            @if($tags->count())
                <div class="border-t border-line-soft bg-surface-base/60 px-4 py-3.5 sm:px-5">
                    <div class="flex flex-col gap-3 md:flex-row md:items-center md:gap-5">
                        <p id="blog-tag-label" class="lc-meta shrink-0 uppercase tracking-[0.18em]">Tags</p>

                        <div class="lc-rail" role="group" aria-labelledby="blog-tag-label">
                            @foreach($tags as $tag)
                                <a href="{{ route('blog.index', ['tag' => $tag->id]) }}"
                                   class="lc-filter"
                                   @if(($currentTag ?? null) == $tag->id) aria-current="true" @endif>
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Result summary --}}
        <div class="lc-enter mt-8 flex flex-wrap items-center justify-between gap-x-6 gap-y-3" style="--lc-delay: 300ms" role="status" aria-live="polite">
            <p class="lc-meta">
                <span class="text-ink-muted">{{ $posts->total() }}</span>
                {{ Str::plural('article', $posts->total()) }}
                @if($search ?? null)
                    matching <span class="text-accent-500">“{{ $search }}”</span>
                @elseif($activeCategory)
                    in <span class="text-accent-500">{{ $activeCategory->name }}</span>
                @elseif($activeTag)
                    tagged <span class="text-accent-500">#{{ $activeTag->name }}</span>
                @endif
            </p>

            @if($hasFilter)
                <a href="{{ route('blog.index') }}" class="lc-link text-sm">
                    <i class="fas fa-rotate-left text-[0.7rem]" aria-hidden="true"></i>
                    Reset filters
                </a>
            @endif
        </div>

        {{-- Grid --}}
        @if($posts->count())
            <ul class="mt-6 grid gap-5 sm:grid-cols-2 lg:gap-6 xl:grid-cols-3">
                @foreach($posts as $post)
                    <li class="flex">
                        <x-post-card :post="$post" :index="$loop->index" :show-tags="true" />
                    </li>
                @endforeach
            </ul>

            <div class="mt-14">
                {{ $posts->appends(request()->except('page'))->links('vendor.pagination.logicore') }}
            </div>
        @else
            <div class="lc-panel lc-edge-lit lc-enter relative mt-6 overflow-hidden px-6 py-16 text-center sm:py-20" style="--lc-delay: 340ms">
                <div aria-hidden="true" class="pointer-events-none absolute inset-0 lc-grid-micro lc-mask-soft opacity-40"></div>

                <div class="relative mx-auto max-w-md">
                    <span aria-hidden="true"
                          class="mx-auto flex h-14 w-14 items-center justify-center rounded-md border border-line bg-surface-base text-accent-500 shadow-[0_0_0_8px_rgba(10,15,35,0.6)]">
                        <i class="fas fa-newspaper text-lg"></i>
                    </span>

                    <h3 class="lc-h3 mt-6">No articles found</h3>

                    <p class="lc-body mt-3">
                        @if($search ?? null)
                            Nothing matched “{{ $search }}”. Try a different term, or browse everything.
                        @elseif($activeCategory)
                            There is nothing published under {{ $activeCategory->name }} yet.
                        @elseif($activeTag)
                            Nothing is tagged #{{ $activeTag->name }} yet.
                        @else
                            The first articles are on their way.
                        @endif
                    </p>

                    @if($hasFilter)
                        <a href="{{ route('blog.index') }}" class="lc-btn lc-btn-primary mt-7">
                            View all articles
                            <i class="fas fa-arrow-right lc-arrow text-[0.7rem]" aria-hidden="true"></i>
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</section>

@endsection
