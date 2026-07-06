<section id="services" class="py-24 relative">
    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-transparent via-primary-500/5 to-transparent pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-16">
            <span class="text-primary-400 font-semibold text-sm uppercase tracking-normal">What We Do</span>
            <h2 class="text-4xl md:text-5xl font-bold mt-3 mb-4">Our <span class="text-gradient">Services</span></h2>
            <p class="text-gray-400 max-w-2xl mx-auto">We provide end-to-end technology services to help businesses build, automate, and scale.</p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($services as $service)
            @php($logicoreServiceColor = ['#176BFF', '#00C1FF', '#6EA8FF', '#1673FF'][$loop->index % 4])
            <div class="group glass rounded-lg p-8 hover:bg-white/10 transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-primary-500/10">
                <div class="w-14 h-14 rounded-lg flex items-center justify-center mb-6 transition-all duration-300 group-hover:scale-110" style="background: {{ $logicoreServiceColor }}1A;">
                    <i class="{{ $service->icon ?? 'fas fa-code' }} text-2xl" style="color: {{ $logicoreServiceColor }};"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-gradient transition-all">{{ $service->title }}</h3>
                <p class="text-gray-400 text-sm leading-relaxed">{{ $service->description }}</p>
            </div>
            @empty
            @foreach([
                ['icon'=>'fas fa-code','title'=>'Web Development','desc'=>'Custom websites, dashboards, and web applications built with modern technologies and clean architecture.','color'=>'#176BFF'],
                ['icon'=>'fas fa-mobile-alt','title'=>'Mobile Apps','desc'=>'Cross-platform mobile applications for Android and iOS with smooth user experiences.','color'=>'#00C1FF'],
                ['icon'=>'fas fa-palette','title'=>'UI/UX Design','desc'=>'Modern, intuitive interfaces that improve usability and make products easier to use.','color'=>'#6EA8FF'],
                ['icon'=>'fas fa-paint-brush','title'=>'Branding','desc'=>'Consistent digital brand identity assets for websites, apps, social media, and business presentations.','color'=>'#1673FF'],
                ['icon'=>'fas fa-robot','title'=>'AI Solutions','desc'=>'Smart automation, AI-powered workflows, and intelligent tools that reduce manual work and improve decisions.','color'=>'#00C1FF'],
                ['icon'=>'fas fa-server','title'=>'Backend & Scalable Systems','desc'=>'Secure APIs, databases, integrations, queues, and backend systems built to scale.','color'=>'#176BFF'],
            ] as $s)
            <div class="group glass rounded-lg p-8 hover:bg-white/10 transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-primary-500/10">
                <div class="w-14 h-14 rounded-lg flex items-center justify-center mb-6 transition-all duration-300 group-hover:scale-110" style="background: {{ $s['color'] }}1A;">
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
