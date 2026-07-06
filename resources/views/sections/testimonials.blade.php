<section id="testimonials" class="py-24 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-primary-400 font-semibold text-sm uppercase tracking-normal">Testimonials</span>
            <h2 class="text-4xl md:text-5xl font-bold mt-3 mb-4">What Clients <span class="text-gradient">Say</span></h2>
        </div>
        <div x-data="{ active: 0, testimonials: {{ json_encode($testimonials->count() ? $testimonials->toArray() : [
            ['client_name'=>'Client Name','client_position'=>'Founder','client_company'=>'','content'=>'Logicore combines technical quality, speed, and clear communication to deliver solutions that feel reliable from day one.','rating'=>5],
        ]) }} }" x-init="setInterval(() => active = (active + 1) % testimonials.length, 5000)" class="relative max-w-3xl mx-auto">
            <template x-for="(t, index) in testimonials" :key="index">
                <div x-show="active === index"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="glass rounded-lg p-8 md:p-12 text-center">
                    <div class="flex justify-center mb-4">
                        <template x-for="i in (t.rating || 5)" :key="i">
                            <i class="fas fa-star text-yellow-400 text-lg mx-0.5"></i>
                        </template>
                    </div>
                    <p class="text-gray-300 text-lg leading-relaxed mb-6 italic" x-text="t.content"></p>
                    <div class="flex items-center justify-center gap-3">
                        <div class="w-12 h-12 gradient-primary rounded-full flex items-center justify-center text-white font-bold" x-text="t.client_name ? t.client_name.charAt(0) : 'C'"></div>
                        <div class="text-left">
                            <div class="text-white font-semibold" x-text="t.client_name"></div>
                            <div class="text-gray-400 text-sm" x-text="(t.client_position || '') + (t.client_company ? ' at ' + t.client_company : '')"></div>
                        </div>
                    </div>
                </div>
            </template>
            <div class="flex justify-center mt-6 gap-2">
                <template x-for="(t, index) in testimonials" :key="index">
                    <button @click="active = index" :class="active === index ? 'bg-primary-500 w-8' : 'bg-white/20 w-2'" class="h-2 rounded-full transition-all duration-300"></button>
                </template>
            </div>
        </div>
    </div>
</section>
