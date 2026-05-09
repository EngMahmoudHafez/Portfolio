<section id="services" class="py-24 relative">
    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-transparent via-primary-900/5 to-transparent pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-16">
            <span class="text-primary-400 font-semibold text-sm tracking-wider uppercase">What We Do</span>
            <h2 class="text-4xl md:text-5xl font-bold mt-3 mb-4">Our <span class="text-gradient">Services</span></h2>
            <p class="text-gray-400 max-w-2xl mx-auto">We offer a comprehensive range of digital services to help your business thrive.</p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($services as $service)
            <div class="group glass rounded-2xl p-8 hover:bg-white/10 transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-primary-500/10">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6 transition-all duration-300 group-hover:scale-110" style="background: {{ $service->icon_color }}20;">
                    <i class="{{ $service->icon ?? 'fas fa-code' }} text-2xl" style="color: {{ $service->icon_color }};"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-gradient transition-all">{{ $service->title }}</h3>
                <p class="text-gray-400 text-sm leading-relaxed">{{ $service->description }}</p>
            </div>
            @empty
            @foreach([
                ['icon'=>'fas fa-code','title'=>'Web Development','desc'=>'Custom web applications built with modern frameworks and best practices.','color'=>'#6366f1'],
                ['icon'=>'fas fa-mobile-alt','title'=>'Mobile Apps','desc'=>'Native and cross-platform mobile applications for iOS and Android.','color'=>'#ec4899'],
                ['icon'=>'fas fa-palette','title'=>'UI/UX Design','desc'=>'Beautiful, intuitive interfaces that delight users and drive engagement.','color'=>'#f59e0b'],
                ['icon'=>'fas fa-paint-brush','title'=>'Branding','desc'=>'Complete brand identity packages that make your business stand out.','color'=>'#10b981'],
                ['icon'=>'fas fa-chart-line','title'=>'Marketing','desc'=>'Data-driven digital marketing strategies that deliver real results.','color'=>'#ef4444'],
                ['icon'=>'fas fa-robot','title'=>'AI Solutions','desc'=>'Intelligent automation and AI-powered tools for your business.','color'=>'#8b5cf6'],
            ] as $s)
            <div class="group glass rounded-2xl p-8 hover:bg-white/10 transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-primary-500/10">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6 transition-all duration-300 group-hover:scale-110" style="background: {{ $s['color'] }}20;">
                    <i class="{{ $s['icon'] }} text-2xl" style="color: {{ $s['color'] }};"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-3">{{ $s['title'] }}</h3>
                <p class="text-gray-400 text-sm leading-relaxed">{{ $s['desc'] }}</p>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</section>
