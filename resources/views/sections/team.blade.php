@php
    $teamMembers = ($team ?? collect());

    $teamFallback = collect([
        ['name' => 'Engineering', 'position' => 'Scalable Systems', 'bio' => 'Clean architecture, secure APIs, and reliable delivery.'],
        ['name' => 'Product Design', 'position' => 'UI/UX Strategy', 'bio' => 'Interfaces for websites, apps, dashboards, and tools.'],
        ['name' => 'Automation', 'position' => 'AI Workflows', 'bio' => 'Smart workflows that remove manual work.'],
        ['name' => 'Delivery', 'position' => 'Product Thinking', 'bio' => 'Scope, sequencing, and shipping on time.'],
    ]);
@endphp

<section id="team" class="lc-section relative overflow-hidden" aria-labelledby="team-heading">

    <div aria-hidden="true" class="pointer-events-none absolute inset-0">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_50%_50%_at_80%_100%,rgba(23,107,255,0.12),transparent_68%)]"></div>
        <div class="absolute inset-0 lc-grid-fine lc-mask-soft opacity-35"></div>
    </div>

    <div class="lc-shell relative">

        <x-section-heading
            id="team-heading"
            eyebrow="Our Team"
            lead="A focused team of engineers, designers, and product thinkers building reliable digital solutions."
            align="center"
            class="max-w-2xl">
            <x-slot:title-slot>
                Meet the <span class="text-gradient">experts</span>.
            </x-slot:title-slot>
        </x-section-heading>

        <ul class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-4 lg:gap-6">
            @forelse($teamMembers as $member)
                @php
                    $memberSkills = is_array($member->skills) ? array_slice(array_filter($member->skills), 0, 3) : [];
                    $memberSocials = is_array($member->social_links) ? array_filter($member->social_links) : [];
                @endphp
                <li class="lc-card lc-enter-soft group" style="--lc-delay: {{ min($loop->index, 6) * 70 }}ms">
                    <div class="flex flex-1 flex-col p-6">
                        <div class="flex items-center gap-4">
                            <span class="relative h-16 w-16 shrink-0 overflow-hidden rounded-md border border-line bg-surface-base">
                                @if($member->photo)
                                    <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}"
                                         loading="lazy" decoding="async"
                                         class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <span aria-hidden="true"
                                          class="flex h-full w-full items-center justify-center bg-[linear-gradient(140deg,#12203f,#0a0f23)] font-display text-xl font-semibold text-accent-500">
                                        {{ Str::upper(Str::substr($member->name, 0, 1)) }}
                                    </span>
                                @endif
                            </span>

                            <div class="min-w-0">
                                <h3 class="lc-h3 text-[1.0625rem]">{{ $member->name }}</h3>
                                <p class="lc-meta mt-1 text-primary-300">{{ $member->position }}</p>
                            </div>
                        </div>

                        @if($member->bio)
                            <p class="lc-body mt-5 line-clamp-3 text-[0.8125rem]">{{ $member->bio }}</p>
                        @endif

                        @if(count($memberSkills))
                            <ul class="mt-5 flex flex-wrap gap-1.5">
                                @foreach($memberSkills as $skill)
                                    <li class="lc-tag">{{ $skill }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @if(count($memberSocials))
                            <ul class="mt-auto flex gap-2 border-t border-line-soft pt-5">
                                @foreach($memberSocials as $link)
                                    <li>
                                        <a href="{{ $link['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"
                                           class="flex h-8 w-8 items-center justify-center rounded-sm border border-line-soft text-ink-subtle transition duration-200 hover:border-accent-500/40 hover:bg-accent-500/10 hover:text-accent-500"
                                           aria-label="{{ $member->name }} on {{ Str::title($link['platform'] ?? 'the web') }}">
                                            <i class="fab fa-{{ $link['platform'] ?? 'link' }} text-xs" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </li>
            @empty
                @foreach($teamFallback as $member)
                    <li class="lc-card lc-enter-soft" style="--lc-delay: {{ $loop->index * 70 }}ms">
                        <div class="flex flex-1 flex-col p-6">
                            <div class="flex items-center gap-4">
                                <span aria-hidden="true"
                                      class="flex h-16 w-16 shrink-0 items-center justify-center rounded-md border border-line bg-[linear-gradient(140deg,#12203f,#0a0f23)] font-display text-xl font-semibold text-accent-500">
                                    {{ Str::substr($member['name'], 0, 1) }}
                                </span>
                                <div class="min-w-0">
                                    <h3 class="lc-h3 text-[1.0625rem]">{{ $member['name'] }}</h3>
                                    <p class="lc-meta mt-1 text-primary-300">{{ $member['position'] }}</p>
                                </div>
                            </div>
                            <p class="lc-body mt-5 text-[0.8125rem]">{{ $member['bio'] }}</p>
                        </div>
                    </li>
                @endforeach
            @endforelse
        </ul>
    </div>
</section>
