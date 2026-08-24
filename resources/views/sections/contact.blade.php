@php
    use App\Models\Setting;

    $contactEmail   = Setting::get('contact_email', 'hello@logicore.tech');
    $contactPhone   = Setting::get('contact_phone', '+20 000 000 0000');
    $contactAddress = Setting::get('contact_address', 'Cairo, Egypt');

    $contactChannels = collect([
        ['icon' => 'fas fa-envelope',       'label' => 'Email',    'value' => $contactEmail,   'href' => $contactEmail ? 'mailto:' . $contactEmail : null],
        ['icon' => 'fas fa-phone',          'label' => 'Phone',    'value' => $contactPhone,   'href' => $contactPhone ? 'tel:' . preg_replace('/[^\d+]/', '', $contactPhone) : null],
        ['icon' => 'fas fa-location-dot',   'label' => 'Location', 'value' => $contactAddress, 'href' => null],
    ])->filter(fn ($channel) => filled($channel['value']))->values();

    $contactSocials = collect([
        ['platform' => 'facebook',   'icon' => 'fab fa-facebook-f',  'label' => 'Facebook'],
        ['platform' => 'instagram',  'icon' => 'fab fa-instagram',   'label' => 'Instagram'],
        ['platform' => 'twitter',    'icon' => 'fab fa-twitter',     'label' => 'Twitter'],
        ['platform' => 'linkedin',   'icon' => 'fab fa-linkedin-in', 'label' => 'LinkedIn'],
        ['platform' => 'github',     'icon' => 'fab fa-github',      'label' => 'GitHub'],
    ])->map(fn ($social) => $social + ['url' => Setting::get('social_' . $social['platform'])])
      ->filter(fn ($social) => filled($social['url']))
      ->values();
@endphp

<section id="contact" class="lc-section relative overflow-hidden" aria-labelledby="contact-heading">

    <div aria-hidden="true" class="pointer-events-none absolute inset-0">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_60%_55%_at_20%_20%,rgba(23,107,255,0.16),transparent_66%)]"></div>
        <div class="absolute inset-0 lc-grid-fine lc-mask-soft opacity-50"></div>
    </div>

    <div class="lc-shell relative">
        <div class="grid gap-12 lg:grid-cols-12 lg:gap-16">

            {{-- ---------- Narrative + channels ---------- --}}
            <div class="lc-rise lg:col-span-5">
                <p class="lc-eyebrow">Get In Touch</p>

                <h2 id="contact-heading" class="lc-h2 mt-5 text-[1.875rem] md:text-[2.5rem]">
                    Let's build something <span class="text-gradient">scalable</span>.
                </h2>

                <p class="lc-lead mt-5">
                    Have a project, product idea, or system that needs improvement? Send us a message and we'll get back to you.
                </p>

                <ul class="mt-10 divide-y divide-line-soft border-y border-line-soft">
                    @foreach($contactChannels as $channel)
                        <li class="flex items-center gap-4 py-4">
                            <span aria-hidden="true"
                                  class="flex h-10 w-10 shrink-0 items-center justify-center rounded-md border border-line-soft bg-surface-2 text-accent-500">
                                <i class="{{ $channel['icon'] }} text-sm"></i>
                            </span>
                            <div class="min-w-0">
                                <p class="lc-spec-key">{{ $channel['label'] }}</p>
                                @if($channel['href'])
                                    <a href="{{ $channel['href'] }}"
                                       class="mt-1 block truncate rounded-sm font-display text-[0.9375rem] font-medium text-ink transition hover:text-accent-500">
                                        {{ $channel['value'] }}
                                    </a>
                                @else
                                    <p class="mt-1 font-display text-[0.9375rem] font-medium text-ink">{{ $channel['value'] }}</p>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>

                @if($contactSocials->isNotEmpty())
                    <ul class="mt-8 flex flex-wrap gap-2.5">
                        @foreach($contactSocials as $social)
                            <li>
                                <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                                   class="flex h-10 w-10 items-center justify-center rounded-md border border-line-soft bg-surface-2 text-ink-subtle transition duration-200 hover:-translate-y-0.5 hover:border-accent-500/40 hover:text-accent-500"
                                   aria-label="Logicore on {{ $social['label'] }}">
                                    <i class="{{ $social['icon'] }} text-sm" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- ---------- Form ---------- --}}
            <div class="lc-rise lg:col-span-7">
                <div class="lc-panel lc-edge-lit relative overflow-hidden">
                    <div class="flex items-center justify-between gap-4 border-b border-line-soft bg-surface-base/70 px-6 py-4">
                        <p class="lc-meta uppercase tracking-[0.18em]">Project Brief</p>
                        <p class="lc-meta text-ink-subtle/70">
                            <span class="lc-required">*</span> required
                        </p>
                    </div>

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5 p-6 sm:p-8">
                        @csrf

                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label for="contact-name" class="lc-label">Name <span class="lc-required" aria-hidden="true">*</span></label>
                                <input type="text" id="contact-name" name="name" value="{{ old('name') }}" required
                                       autocomplete="name" placeholder="Your name"
                                       @error('name') aria-invalid="true" aria-describedby="contact-name-error" @enderror
                                       class="lc-field">
                                @error('name')
                                    <p id="contact-name-error" class="mt-2 text-xs text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="contact-email" class="lc-label">Email <span class="lc-required" aria-hidden="true">*</span></label>
                                <input type="email" id="contact-email" name="email" value="{{ old('email') }}" required
                                       autocomplete="email" placeholder="you@company.com"
                                       @error('email') aria-invalid="true" aria-describedby="contact-email-error" @enderror
                                       class="lc-field">
                                @error('email')
                                    <p id="contact-email-error" class="mt-2 text-xs text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label for="contact-phone" class="lc-label">Phone</label>
                                <input type="tel" id="contact-phone" name="phone" value="{{ old('phone') }}"
                                       autocomplete="tel" placeholder="Optional"
                                       class="lc-field">
                                @error('phone')
                                    <p class="mt-2 text-xs text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="contact-subject" class="lc-label">Subject <span class="lc-required" aria-hidden="true">*</span></label>
                                <input type="text" id="contact-subject" name="subject" value="{{ old('subject') }}" required
                                       placeholder="Project inquiry"
                                       @error('subject') aria-invalid="true" aria-describedby="contact-subject-error" @enderror
                                       class="lc-field">
                                @error('subject')
                                    <p id="contact-subject-error" class="mt-2 text-xs text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="contact-message" class="lc-label">Message <span class="lc-required" aria-hidden="true">*</span></label>
                            <textarea id="contact-message" name="message" rows="6" required
                                      placeholder="Tell us about your project — goals, constraints, timeline."
                                      @error('message') aria-invalid="true" aria-describedby="contact-message-error" @enderror
                                      class="lc-field resize-y">{{ old('message') }}</textarea>
                            @error('message')
                                <p id="contact-message-error" class="mt-2 text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col items-start gap-4 border-t border-line-soft pt-6 sm:flex-row sm:items-center sm:justify-between">
                            <p class="lc-meta max-w-xs">We reply to every brief, usually within two business days.</p>
                            <button type="submit" class="lc-btn lc-btn-primary lc-btn-lg w-full sm:w-auto">
                                Send Message
                                <i class="fas fa-paper-plane text-[0.7rem]" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
