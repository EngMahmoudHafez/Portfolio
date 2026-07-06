<section id="portfolio" class="py-24 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-primary-400 font-semibold text-sm uppercase tracking-normal">Our Work</span>
            <h2 class="text-4xl md:text-5xl font-bold mt-3 mb-4">Featured <span class="text-gradient">Projects</span></h2>
            <p class="text-gray-400 max-w-2xl mx-auto">Explore how Logicore turns ideas into practical digital products.</p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($projects as $project)
            <a href="{{ route('projects.show', $project->slug) }}" class="group glass rounded-lg overflow-hidden hover:-translate-y-2 transition-all duration-500">
                <div class="h-48 overflow-hidden">
                    @if($project->cover_image)
                    <img src="{{ asset('storage/'.$project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                    <div class="w-full h-full gradient-primary flex items-center justify-center"><i class="fas fa-project-diagram text-4xl text-white/50"></i></div>
                    @endif
                </div>
                <div class="p-6">
                    @if($project->category)<span class="text-xs text-primary-400 font-medium">{{ $project->category->name }}</span>@endif
                    <h3 class="text-lg font-bold text-white mt-1 mb-2 group-hover:text-primary-400 transition-colors">{{ $project->title }}</h3>
                    <p class="text-gray-400 text-sm line-clamp-2">{{ $project->short_description ?? Str::limit($project->description, 100) }}</p>
                    @if($project->technologies)
                    <div class="flex flex-wrap gap-1 mt-3">
                        @foreach(array_slice($project->technologies,0,3) as $tech)
                        <span class="px-2 py-0.5 text-xs glass rounded-full text-gray-300">{{ $tech }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-12">
                <i class="fas fa-folder-open text-4xl text-gray-600 mb-4"></i>
                <p class="text-gray-400">Projects coming soon. Stay tuned!</p>
            </div>
            @endforelse
        </div>
        @if(count($projects ?? []) > 0)
        <div class="text-center mt-12">
            <a href="{{ route('projects.index') }}" class="px-8 py-3 glass text-white font-semibold rounded-lg hover:bg-white/15 transition-all inline-flex items-center gap-2">
                View All Projects <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        @endif
    </div>
</section>
