@props([
    'project',
    'index' => 0,
    'eager' => false,
])

@php
    $technologies = is_array($project->technologies) ? array_values(array_filter($project->technologies)) : [];
    $visibleTech  = array_slice($technologies, 0, 3);
    $extraTech    = max(count($technologies) - count($visibleTech), 0);

    $summary = $project->short_description ?: Str::limit(strip_tags((string) $project->description), 130);

    // Two-letter mark used by the branded fallback when no cover image exists.
    $initials = Str::upper(Str::substr(preg_replace('/[^A-Za-z0-9]/', '', (string) $project->title), 0, 2)) ?: 'LC';
@endphp

<article class="lc-card lc-enter-soft group h-full"
         style="--lc-delay: {{ min((int) $index, 8) * 60 }}ms">
    {{-- Media --}}
    <div class="lc-card-media">
        @if($project->cover_image)
            <img src="{{ asset('storage/' . $project->cover_image) }}"
                 alt="{{ $project->title }}"
                 loading="{{ $eager ? 'eager' : 'lazy' }}"
                 decoding="async">
        @else
            <div class="lc-fallback" role="img" aria-label="{{ $project->title }} — no cover image available">
                <span class="lc-fallback-inner">
                    <span class="lc-fallback-mark" aria-hidden="true">{{ $initials }}</span>
                    <span class="lc-fallback-label">{{ $project->category?->name ?? 'Logicore Build' }}</span>
                </span>
            </div>
        @endif

        <span aria-hidden="true" class="lc-card-scrim"></span>

        {{-- Overlaid metadata --}}
        <div class="absolute inset-x-0 bottom-0 flex items-end justify-between gap-3 p-3.5">
            @if($project->category)
                <span class="lc-tag lc-tag-accent backdrop-blur-sm">{{ $project->category->name }}</span>
            @else
                <span></span>
            @endif

            @if($project->completed_at)
                <span class="lc-meta shrink-0 text-ink-muted">{{ $project->completed_at->format('M Y') }}</span>
            @endif
        </div>
    </div>

    {{-- Body --}}
    <div class="lc-card-body">
        <h3 class="lc-h3 text-balance">
            <a href="{{ route('projects.show', $project->slug) }}"
               class="lc-card-target rounded-sm outline-none transition-colors duration-200 group-hover:text-accent-500">
                {{ $project->title }}
            </a>
        </h3>

        @if($summary)
            <p class="lc-body line-clamp-2 text-[0.875rem]">{{ $summary }}</p>
        @endif

        <div class="mt-auto space-y-4 pt-1">
            @if(count($visibleTech))
                <ul class="flex flex-wrap gap-1.5">
                    @foreach($visibleTech as $tech)
                        <li class="lc-tag">{{ $tech }}</li>
                    @endforeach
                    @if($extraTech)
                        <li class="lc-tag lc-tag-ghost">+{{ $extraTech }}</li>
                    @endif
                </ul>
            @endif

            <div class="flex items-center justify-between border-t border-line-soft pt-3.5">
                <span class="lc-meta uppercase tracking-[0.16em] text-ink-subtle transition-colors duration-200 group-hover:text-accent-500">
                    View case study
                </span>
                <span aria-hidden="true"
                      class="flex h-7 w-7 items-center justify-center rounded-sm border border-line-soft text-[0.65rem] text-ink-subtle transition duration-200 group-hover:border-accent-500/40 group-hover:bg-accent-500/10 group-hover:text-accent-500">
                    <i class="fas fa-arrow-right lc-arrow"></i>
                </span>
            </div>
        </div>
    </div>
</article>
