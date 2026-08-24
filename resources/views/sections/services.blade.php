@php
    $servicePalette = ['#176BFF', '#00C1FF', '#6EA8FF', '#1673FF'];

    $serviceItems = ($services ?? collect())->map(fn ($service, $i) => [
        'icon'  => $service->icon ?: 'fas fa-code',
        'title' => $service->title,
        'desc'  => $service->description,
        'color' => $service->icon_color ?: $servicePalette[$i % count($servicePalette)],
    ]);

    if ($serviceItems->isEmpty()) {
        $serviceItems = collect([
            ['icon' => 'fas fa-code', 'title' => 'Web Development', 'desc' => 'Custom websites, dashboards, and web applications built with modern technologies and clean architecture.', 'color' => '#176BFF'],
            ['icon' => 'fas fa-mobile-alt', 'title' => 'Mobile Apps', 'desc' => 'Cross-platform mobile applications for Android and iOS with smooth user experiences.', 'color' => '#00C1FF'],
            ['icon' => 'fas fa-palette', 'title' => 'UI/UX Design', 'desc' => 'Modern, intuitive interfaces that improve usability and make products easier to use.', 'color' => '#6EA8FF'],
            ['icon' => 'fas fa-paint-brush', 'title' => 'Branding', 'desc' => 'Consistent digital brand identity assets for websites, apps, social media, and business presentations.', 'color' => '#1673FF'],
            ['icon' => 'fas fa-robot', 'title' => 'AI Solutions', 'desc' => 'Smart automation, AI-powered workflows, and intelligent tools that reduce manual work and improve decisions.', 'color' => '#00C1FF'],
            ['icon' => 'fas fa-server', 'title' => 'Backend & Scalable Systems', 'desc' => 'Secure APIs, databases, integrations, queues, and backend systems built to scale.', 'color' => '#176BFF'],
        ]);
    }
@endphp

<section id="services" class="lc-section relative overflow-hidden bg-surface-1" aria-labelledby="services-heading">

    <div aria-hidden="true" class="pointer-events-none absolute inset-0">
        <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-primary-500/25 to-transparent"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_60%_45%_at_50%_0%,rgba(23,107,255,0.12),transparent_70%)]"></div>
    </div>

    <div class="lc-shell relative">

        <div class="flex flex-col gap-8 md:flex-row md:items-end md:justify-between">
            <x-section-heading
                id="services-heading"
                eyebrow="What We Do"
                lead="We provide end-to-end technology services to help businesses build, automate, and scale."
                class="max-w-xl">
                <x-slot:title-slot>
                    Services built around <span class="text-gradient">how software actually ships</span>.
                </x-slot:title-slot>
            </x-section-heading>

            <a href="#contact" class="lc-btn lc-btn-outline lc-rise shrink-0 self-start md:self-auto">
                Discuss your scope
                <i class="fas fa-arrow-right lc-arrow text-[0.7rem]" aria-hidden="true"></i>
            </a>
        </div>

        {{-- Technical matrix: hairline-separated cells, not floating cards --}}
        <ul class="lc-rise mt-14 grid gap-px overflow-hidden rounded-lg border border-line-soft bg-line-soft sm:grid-cols-2 lg:grid-cols-3">
            @foreach($serviceItems as $i => $service)
                <li class="group relative bg-surface-2 p-7 transition-colors duration-300 hover:bg-surface-3 lg:p-8">
                    <span aria-hidden="true"
                          class="pointer-events-none absolute inset-x-0 top-0 h-px scale-x-0 bg-gradient-to-r from-transparent via-accent-500/60 to-transparent transition-transform duration-300 group-hover:scale-x-100"></span>

                    <div class="flex items-start justify-between gap-4">
                        <span aria-hidden="true"
                              class="flex h-12 w-12 items-center justify-center rounded-md border transition-transform duration-300 group-hover:-translate-y-0.5"
                              style="background: {{ $service['color'] }}14; border-color: {{ $service['color'] }}33; color: {{ $service['color'] }};">
                            <i class="{{ $service['icon'] }} text-lg"></i>
                        </span>
                        <span class="lc-meta text-ink-subtle/70">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    <h3 class="lc-h3 mt-6">{{ $service['title'] }}</h3>
                    <p class="lc-body mt-2.5 text-[0.875rem]">{{ $service['desc'] }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</section>
