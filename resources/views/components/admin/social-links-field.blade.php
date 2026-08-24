@props([
    'name' => 'social_links',
    'label' => 'Social Links',
    'values' => [],
])

@php
    // Platforms map to Font Awesome brand slugs used by the public team cards.
    $platforms = ['github', 'linkedin', 'twitter', 'facebook', 'instagram', 'dribbble', 'behance', 'youtube'];

    $linkValues = collect((array) $values)
        ->filter(fn ($link) => is_array($link) && filled($link['url'] ?? null))
        ->values()
        ->map(fn ($link, $i) => [
            'id' => $i,
            'platform' => $link['platform'] ?? 'linkedin',
            'url' => $link['url'],
        ])
        ->all();
@endphp

<div x-data="{
        links: {{ Js::from($linkValues) }},
        nextId: {{ count($linkValues) }},
        add() { this.links.push({ id: this.nextId++, platform: 'linkedin', url: '' }); },
        remove(index) { this.links.splice(index, 1); },
     }">
    <label class="block text-sm text-gray-400 mb-2">{{ $label }}</label>
    <p class="text-xs text-gray-500 mb-3">Shown as icons on the public team card. Rows without a URL are ignored.</p>

    <div class="space-y-2">
        <template x-for="(link, index) in links" :key="link.id">
            <div class="flex items-center gap-2">
                <select x-model="link.platform"
                        class="w-40 shrink-0 px-3 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    @foreach($platforms as $platform)
                        <option value="{{ $platform }}">{{ ucfirst($platform) }}</option>
                    @endforeach
                </select>

                <input type="url"
                       x-model="link.url"
                       placeholder="https://…"
                       class="flex-1 px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent">

                {{-- Only rows with a URL are submitted --}}
                <input type="hidden" :name="'{{ $name }}[' + index + '][platform]'" :value="link.platform" :disabled="!link.url.trim()">
                <input type="hidden" :name="'{{ $name }}[' + index + '][url]'" :value="link.url.trim()" :disabled="!link.url.trim()">

                <button type="button"
                        @click="remove(index)"
                        class="w-10 h-10 shrink-0 flex items-center justify-center rounded-xl text-gray-400 hover:text-red-400 hover:bg-red-500/10 transition"
                        aria-label="Remove link">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>
        </template>

        <p x-show="links.length === 0" class="text-sm text-gray-500 py-2">No social links yet.</p>
    </div>

    <button type="button"
            @click="add()"
            class="mt-3 inline-flex items-center gap-2 px-4 py-2 glass rounded-xl text-sm text-primary-400 hover:bg-white/10 transition">
        <i class="fas fa-plus text-xs"></i> Add link
    </button>
</div>
