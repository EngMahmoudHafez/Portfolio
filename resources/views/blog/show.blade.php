@extends('layouts.app')

@section('title', $post->title . ' - Logicore')
@section('meta_description', $post->excerpt ?? Str::limit(strip_tags((string) $post->body), 160))

@section('content')

@php
    $publishedAt = $post->published_at ?? $post->created_at;
    $shareUrl = urlencode(url()->current());
    $shareText = urlencode($post->title);

    $shareTargets = [
        ['label' => 'Share on Twitter',  'icon' => 'fab fa-twitter',     'href' => "https://twitter.com/intent/tweet?url={$shareUrl}&text={$shareText}"],
        ['label' => 'Share on Facebook', 'icon' => 'fab fa-facebook-f',  'href' => "https://www.facebook.com/sharer/sharer.php?u={$shareUrl}"],
        ['label' => 'Share on LinkedIn', 'icon' => 'fab fa-linkedin-in', 'href' => "https://www.linkedin.com/shareArticle?mini=true&url={$shareUrl}"],
    ];
@endphp

<article>

{{-- ============================================================
     HEADER
     ============================================================ --}}
<header class="relative overflow-hidden pt-28 pb-12 md:pt-36 md:pb-16">

    <div aria-hidden="true" class="pointer-events-none absolute inset-0">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_65%_60%_at_25%_0%,rgba(23,107,255,0.20),transparent_66%)]"></div>
        <div class="absolute inset-0 lc-grid-fine lc-mask-soft opacity-60"></div>
    </div>

    <div class="lc-shell-narrow relative">

        <nav aria-label="Breadcrumb" class="lc-enter mb-8">
            <ol class="lc-meta flex flex-wrap items-center gap-2">
                <li><a href="{{ route('home') }}" class="rounded-sm transition hover:text-accent-500">Home</a></li>
                <li aria-hidden="true" class="text-ink-subtle/50">/</li>
                <li><a href="{{ route('blog.index') }}" class="rounded-sm transition hover:text-accent-500">Blog</a></li>
                <li aria-hidden="true" class="text-ink-subtle/50">/</li>
                <li aria-current="page" class="max-w-[16rem] truncate text-ink-muted">{{ $post->title }}</li>
            </ol>
        </nav>

        <div class="lc-enter" style="--lc-delay: 60ms">
            <div class="flex flex-wrap items-center gap-3">
                @if($post->category)
                    <a href="{{ route('blog.index', ['category' => $post->category->id]) }}"
                       class="lc-tag lc-tag-accent transition hover:border-accent-500/60 hover:bg-accent-500/15">
                        {{ $post->category->name }}
                    </a>
                @endif

                @if($publishedAt)
                    <time datetime="{{ $publishedAt->toDateString() }}" class="lc-meta">{{ $publishedAt->format('M d, Y') }}</time>
                @endif

                <span aria-hidden="true" class="lc-meta text-ink-subtle/50">/</span>
                <span class="lc-meta">{{ $post->views_count }} views</span>
            </div>

            <h1 class="lc-h1 mt-6 text-[2.125rem] leading-[1.08] sm:text-[2.625rem] lg:text-[3.25rem]">
                {{ $post->title }}
            </h1>

            @if($post->excerpt)
                <p class="lc-lead mt-6">{{ $post->excerpt }}</p>
            @endif

            @if($post->user)
                <div class="mt-8 flex items-center gap-3 border-t border-line-soft pt-6">
                    <span aria-hidden="true"
                          class="flex h-10 w-10 items-center justify-center rounded-md border border-line bg-[linear-gradient(140deg,#12203f,#0a0f23)] font-display font-semibold text-accent-500">
                        {{ Str::upper(Str::substr($post->user->name, 0, 1)) }}
                    </span>
                    <div>
                        <p class="lc-spec-key">Written by</p>
                        <p class="mt-0.5 font-display text-[0.9375rem] font-semibold text-ink">{{ $post->user->name }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</header>

{{-- ============================================================
     COVER
     ============================================================ --}}
@if($post->cover_image)
<div class="lc-shell-narrow">
    <figure class="lc-enter relative overflow-hidden rounded-lg border border-line bg-surface-base shadow-[0_40px_90px_-50px_rgba(0,0,0,0.95)]"
            style="--lc-delay: 200ms">
        <div class="relative aspect-[16/9]">
            <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}"
                 class="h-full w-full object-cover" fetchpriority="high" decoding="async">
        </div>
        <span aria-hidden="true" class="pointer-events-none absolute inset-0 rounded-lg ring-1 ring-inset ring-white/[0.06]"></span>
    </figure>
</div>
@endif

{{-- ============================================================
     BODY
     ============================================================ --}}
<section class="lc-section-tight">
    <div class="lc-shell-narrow">
        <div class="lc-prose lc-rise prose prose-invert max-w-none prose-headings:font-display prose-a:text-primary-300 hover:prose-a:text-accent-500 prose-img:rounded-md prose-img:border prose-img:border-line-soft">
            {!! $post->body !!}
        </div>

        @if($post->tags && $post->tags->count())
            <div class="mt-12 border-t border-line-soft pt-8">
                <p class="lc-spec-key">Tagged</p>
                <ul class="mt-4 flex flex-wrap gap-2">
                    @foreach($post->tags as $tag)
                        <li>
                            <a href="{{ route('blog.index', ['tag' => $tag->id]) }}"
                               class="lc-tag transition hover:border-accent-500/40 hover:text-accent-500">
                                #{{ $tag->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Share --}}
        <div class="mt-10 flex flex-wrap items-center gap-4 border-t border-line-soft pt-8">
            <p class="lc-spec-key">Share</p>
            <ul class="flex gap-2.5">
                @foreach($shareTargets as $target)
                    <li>
                        <a href="{{ $target['href'] }}" target="_blank" rel="noopener noreferrer"
                           class="flex h-10 w-10 items-center justify-center rounded-md border border-line-soft bg-surface-2 text-ink-subtle transition duration-200 hover:-translate-y-0.5 hover:border-accent-500/40 hover:text-accent-500"
                           aria-label="{{ $target['label'] }}">
                            <i class="{{ $target['icon'] }} text-sm" aria-hidden="true"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
</article>

{{-- ============================================================
     RELATED
     ============================================================ --}}
@php
    $related = ($relatedPosts ?? collect())->reject(fn ($related) => $related->id === $post->id)->take(3);
@endphp

@if($related->count())
<section class="lc-section-tight pt-0" aria-labelledby="related-heading">
    <div class="lc-shell">
        <hr class="lc-rule-quiet mb-12">

        <div class="lc-rise flex items-end justify-between gap-6">
            <div>
                <p class="lc-eyebrow">Keep Reading</p>
                <h2 id="related-heading" class="lc-h2 mt-4 text-[1.75rem] md:text-[2rem]">Related articles</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="lc-link hidden shrink-0 text-sm sm:inline-flex">
                All articles
                <i class="fas fa-arrow-right lc-arrow text-[0.65rem]" aria-hidden="true"></i>
            </a>
        </div>

        <ul class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3 lg:gap-6">
            @foreach($related as $relatedPost)
                <li class="flex">
                    <x-post-card :post="$relatedPost" :index="$loop->index" />
                </li>
            @endforeach
        </ul>
    </div>
</section>
@endif

{{-- ============================================================
     BACK + CTA
     ============================================================ --}}
<section class="pb-24">
    <div class="lc-shell">
        <div class="lc-rise flex flex-col items-start justify-between gap-8 md:flex-row md:items-center">
            <div>
                <a href="{{ route('blog.index') }}" class="lc-link">
                    <i class="fas fa-arrow-left text-[0.7rem]" aria-hidden="true"></i>
                    Back to all articles
                </a>
                <h2 class="lc-h3 mt-4 max-w-md">Working on something we should write about?</h2>
            </div>

            <a href="{{ route('home') }}#contact" class="lc-btn lc-btn-primary lc-btn-lg shrink-0">
                Start a project
                <i class="fas fa-arrow-right lc-arrow text-[0.7rem]" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

@endsection
