<section id="team" class="py-24 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-primary-400 font-semibold text-sm tracking-wider uppercase">Our Team</span>
            <h2 class="text-4xl md:text-5xl font-bold mt-3 mb-4">Meet The <span class="text-gradient">Experts</span></h2>
            <p class="text-gray-400 max-w-2xl mx-auto">Our talented team of professionals who make the magic happen.</p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($team as $member)
            <div class="group glass rounded-2xl p-6 text-center hover:bg-white/10 transition-all duration-500 hover:-translate-y-2">
                <div class="w-24 h-24 mx-auto mb-4 rounded-full overflow-hidden ring-2 ring-primary-500/30 group-hover:ring-primary-400 transition-all">
                    @if($member->photo)
                    <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full gradient-primary flex items-center justify-center text-2xl font-bold text-white">{{ substr($member->name,0,1) }}</div>
                    @endif
                </div>
                <h3 class="text-lg font-bold text-white mb-1">{{ $member->name }}</h3>
                <p class="text-primary-400 text-sm mb-3">{{ $member->position }}</p>
                @if($member->bio)<p class="text-gray-400 text-xs mb-4 line-clamp-2">{{ $member->bio }}</p>@endif
                @if($member->skills)
                <div class="flex flex-wrap justify-center gap-1 mb-4">
                    @foreach(array_slice($member->skills,0,3) as $skill)
                    <span class="px-2 py-0.5 text-xs glass rounded-full text-gray-300">{{ $skill }}</span>
                    @endforeach
                </div>
                @endif
                @if($member->social_links)
                <div class="flex justify-center gap-2">
                    @foreach($member->social_links as $link)
                    <a href="{{ $link['url'] ?? '#' }}" target="_blank" class="w-8 h-8 glass rounded-lg flex items-center justify-center text-gray-400 hover:text-primary-400 hover:bg-primary-500/10 transition-all text-xs">
                        <i class="fab fa-{{ $link['platform'] ?? 'link' }}"></i>
                    </a>
                    @endforeach
                </div>
                @endif
            </div>
            @empty
            @foreach([['name'=>'Ahmed Hassan','pos'=>'Full Stack Developer'],['name'=>'Sara Ali','pos'=>'UI/UX Designer'],['name'=>'Omar Khaled','pos'=>'Mobile Developer'],['name'=>'Nour Mohamed','pos'=>'Project Manager']] as $m)
            <div class="group glass rounded-2xl p-6 text-center hover:bg-white/10 transition-all duration-500 hover:-translate-y-2">
                <div class="w-24 h-24 mx-auto mb-4 rounded-full overflow-hidden ring-2 ring-primary-500/30">
                    <div class="w-full h-full gradient-primary flex items-center justify-center text-2xl font-bold text-white">{{ substr($m['name'],0,1) }}</div>
                </div>
                <h3 class="text-lg font-bold text-white mb-1">{{ $m['name'] }}</h3>
                <p class="text-primary-400 text-sm mb-3">{{ $m['pos'] }}</p>
                <div class="flex justify-center gap-2">
                    <a href="#" class="w-8 h-8 glass rounded-lg flex items-center justify-center text-gray-400 hover:text-primary-400 transition-all text-xs"><i class="fab fa-github"></i></a>
                    <a href="#" class="w-8 h-8 glass rounded-lg flex items-center justify-center text-gray-400 hover:text-primary-400 transition-all text-xs"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</section>
