@props([
    'name',
    'label',
    'values' => [],
    'placeholder' => '',
    'hint' => null,
    'addLabel' => 'Add item',
])

@php
    $listValues = array_values(array_filter((array) $values, fn ($value) => filled($value)));
@endphp

<div x-data="{
        items: {{ Js::from(array_map(fn ($value, $i) => ['id' => $i, 'value' => $value], $listValues, array_keys($listValues))) }},
        nextId: {{ count($listValues) }},
        add() { this.items.push({ id: this.nextId++, value: '' }); },
        remove(index) { this.items.splice(index, 1); },
     }">
    <label class="block text-sm text-gray-400 mb-2">{{ $label }}</label>

    @if($hint)
        <p class="text-xs text-gray-500 mb-3">{{ $hint }}</p>
    @endif

    <div class="space-y-2">
        <template x-for="(item, index) in items" :key="item.id">
            <div class="flex items-center gap-2">
                <input type="text"
                       x-model="item.value"
                       placeholder="{{ $placeholder }}"
                       class="flex-1 px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent">

                {{-- Only non-empty rows are submitted --}}
                <input type="hidden" name="{{ $name }}[]" :value="item.value.trim()" :disabled="!item.value.trim()">

                <button type="button"
                        @click="remove(index)"
                        class="w-10 h-10 shrink-0 flex items-center justify-center rounded-xl text-gray-400 hover:text-red-400 hover:bg-red-500/10 transition"
                        aria-label="Remove item">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>
        </template>

        <p x-show="items.length === 0" class="text-sm text-gray-500 py-2">Nothing added yet.</p>
    </div>

    <button type="button"
            @click="add()"
            class="mt-3 inline-flex items-center gap-2 px-4 py-2 glass rounded-xl text-sm text-primary-400 hover:bg-white/10 transition">
        <i class="fas fa-plus text-xs"></i> {{ $addLabel }}
    </button>
</div>
