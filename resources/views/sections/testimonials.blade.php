@php
    $testimonialItems = ($testimonials ?? collect())->map(fn ($t) => [
        'content'   => (string) $t->content,
        'name'      => (string) $t->client_name,
        'role'      => trim(collect([$t->client_position, $t->client_company])->filter()->implode(' · ')),
        'rating'    => (int) ($t->rating ?: 5),
        'image'     => $t->client_image ? asset('storage/' . $t->client_image) : null,
        'initial'   => Str::upper(Str::substr((string) $t->client_name, 0, 1)) ?: 'C',
    ])->values();
@endphp

@if($testimonialItems->isNotEmpty())
<section id="testimonials" class="lc-section relative overflow-hidden" aria-labelledby="testimonials-heading">

    <div aria-hidden="true" class="pointer-events-none absolute inset-0">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_55%_55%_at_50%_50%,rgba(23,107,255,0.13),transparent_68%)]"></div>
        <div class="absolute inset-0 lc-circuit lc-mask-soft opacity-25"></div>
    </div>

    <div class="lc-shell relative">

        <x-section-heading
            id="testimonials-heading"
            eyebrow="Testimonials"
            align="center"
            class="max-w-xl">
            <x-slot:title-slot>
                What clients <span class="text-gradient">say</span>.
            </x-slot:title-slot>
        </x-section-heading>

        <div class="lc-rise mx-auto mt-12 max-w-3xl"
             x-data="{
                active: 0,
                items: {{ Js::from($testimonialItems) }},
                timer: null,
                start() {
                    if (this.items.length < 2) return;
                    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
                    this.timer = setInterval(() => this.go(this.active + 1), 6500);
                },
                stop() { clearInterval(this.timer); this.timer = null; },
                go(i) { this.active = (i + this.items.length) % this.items.length; },
             }"
             x-init="start()"
             @mouseenter="stop()" @mouseleave="start()"
             @focusin="stop()" @focusout="start()">

            <div class="lc-panel lc-edge-lit relative overflow-hidden">
                <span aria-hidden="true"
                      class="pointer-events-none absolute -top-6 left-6 font-display text-[7rem] leading-none text-primary-500/10">&ldquo;</span>

                <div class="relative px-6 py-10 sm:px-10 sm:py-12" aria-live="polite">
                    <template x-for="(t, index) in items" :key="index">
                        <blockquote x-show="active === index"
                                    x-transition:enter="transition ease-out duration-400"
                                    x-transition:enter-start="opacity-0 translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0">

                            <div class="flex gap-1" :aria-label="t.rating + ' out of 5'">
                                <template x-for="i in t.rating" :key="i">
                                    <i class="fas fa-star text-[0.7rem] text-accent-500" aria-hidden="true"></i>
                                </template>
                            </div>

                            <p class="mt-6 font-display text-lg leading-relaxed text-ink sm:text-xl" x-text="t.content"></p>

                            <footer class="mt-8 flex items-center gap-3.5 border-t border-line-soft pt-6">
                                <span class="flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-md border border-line bg-surface-base">
                                    <template x-if="t.image">
                                        <img :src="t.image" :alt="t.name" class="h-full w-full object-cover">
                                    </template>
                                    <template x-if="!t.image">
                                        <span class="font-display font-semibold text-accent-500" x-text="t.initial" aria-hidden="true"></span>
                                    </template>
                                </span>
                                <div class="min-w-0">
                                    <cite class="block not-italic font-display text-[0.9375rem] font-semibold text-ink" x-text="t.name"></cite>
                                    <span class="lc-meta mt-0.5 block" x-text="t.role" x-show="t.role"></span>
                                </div>
                            </footer>
                        </blockquote>
                    </template>
                </div>
            </div>

            {{-- Controls --}}
            <div class="mt-6 flex items-center justify-center gap-4" x-show="items.length > 1">
                <button type="button" @click="go(active - 1)"
                        class="flex h-9 w-9 items-center justify-center rounded-sm border border-line-soft text-ink-subtle transition duration-200 hover:border-line hover:text-ink"
                        aria-label="Previous testimonial">
                    <i class="fas fa-chevron-left text-[0.65rem]" aria-hidden="true"></i>
                </button>

                <div class="flex items-center gap-2" role="tablist" aria-label="Choose testimonial">
                    <template x-for="(t, index) in items" :key="index">
                        <button type="button" role="tab"
                                @click="go(index)"
                                :aria-selected="active === index ? 'true' : 'false'"
                                :aria-label="'Testimonial ' + (index + 1)"
                                :class="active === index ? 'w-7 bg-accent-500' : 'w-2 bg-line-strong hover:bg-primary-300/60'"
                                class="h-1.5 rounded-full transition-all duration-300"></button>
                    </template>
                </div>

                <button type="button" @click="go(active + 1)"
                        class="flex h-9 w-9 items-center justify-center rounded-sm border border-line-soft text-ink-subtle transition duration-200 hover:border-line hover:text-ink"
                        aria-label="Next testimonial">
                    <i class="fas fa-chevron-right text-[0.65rem]" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
</section>
@endif
