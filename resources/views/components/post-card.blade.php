@props([
    'post',
    'index' => 0,
    'showTags' => false,
])

@php
    $publishedAt = $post->published_at ?? $post->created_at;
    $excerpt = $post->excerpt ?: Str::limit(strip_tags((string) $post->body), 130);
    $initials = Str::upper(Str::substr(preg_replace('/[^A-Za-z0-9]/', '', (string) $post->title), 0, 2)) ?: 'LC';
@endphp

<article class="lc-card lc-enter-soft group h-full"
         style="--lc-delay: {{ min((int) $index, 8) * 60 }}ms">

    <div class="lc-card-media">
        @if($post->cover_image)
            <img src="{{ asset('storage/' . $post->cover_image) }}"
                 alt="{{ $post->title }}"
                 loading="lazy"
                 decoding="async">
        @else
            <div class="lc-fallback" role="img" aria-label="{{ $post->title }} — no cover image available">
                <span class="lc-fallback-inner">
                    <span class="lc-fallback-mark" aria-hidden="true">{{ $initials }}</span>
                    <span class="lc-fallback-label">{{ $post->category?->name ?? 'Article' }}</span>
                </span>
            </div>
        @endif

        <span aria-hidden="true" class="lc-card-scrim"></span>

        <div class="absolute inset-x-0 bottom-0 flex items-end justify-between gap-3 p-3.5">
            @if($post->category)
                <span class="lc-tag lc-tag-accent backdrop-blur-sm">{{ $post->category->name }}</span>
            @else
                <span></span>
            @endif

            @if($publishedAt)
                <time datetime="{{ $publishedAt->toDateString() }}" class="lc-meta shrink-0 text-ink-muted">
                    {{ $publishedAt->format('M d, Y') }}
                </time>
            @endif
        </div>
    </div>

    <div class="lc-card-body">
        <h3 class="lc-h3 line-clamp-2">
            <a href="{{ route('blog.show', $post->slug) }}"
               class="lc-card-target rounded-sm outline-none transition-colors duration-200 group-hover:text-accent-500">
                {{ $post->title }}
            </a>
        </h3>

        @if($excerpt)
            <p class="lc-body line-clamp-2 text-[0.875rem]">{{ $excerpt }}</p>
        @endif

        <div class="mt-auto space-y-4 pt-1">
            @if($showTags && $post->tags && $post->tags->count())
                <ul class="flex flex-wrap gap-1.5">
                    @foreach($post->tags->take(3) as $tag)
                        <li class="lc-tag">#{{ $tag->name }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="flex items-center justify-between border-t border-line-soft pt-3.5">
                <span class="lc-meta uppercase tracking-[0.16em] text-ink-subtle transition-colors duration-200 group-hover:text-accent-500">
                    Read article
                </span>
                <span aria-hidden="true"
                      class="flex h-7 w-7 items-center justify-center rounded-sm border border-line-soft text-[0.65rem] text-ink-subtle transition duration-200 group-hover:border-accent-500/40 group-hover:bg-accent-500/10 group-hover:text-accent-500">
                    <i class="fas fa-arrow-right lc-arrow"></i>
                </span>
            </div>
        </div>
    </div>
</article>
