<section id="blog" class="py-24 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-primary-400 font-semibold text-sm uppercase tracking-normal">Blog</span>
            <h2 class="text-4xl md:text-5xl font-bold mt-3 mb-4">Latest <span class="text-gradient">Articles</span></h2>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($posts as $post)
            <a href="{{ route('blog.show', $post->slug) }}" class="group glass rounded-lg overflow-hidden hover:-translate-y-2 transition-all duration-500">
                <div class="h-48 overflow-hidden">
                    @if($post->cover_image)
                    <img src="{{ asset('storage/'.$post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                    <div class="w-full h-full gradient-primary flex items-center justify-center"><i class="fas fa-newspaper text-4xl text-white/50"></i></div>
                    @endif
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-3 text-xs text-gray-400">
                        @if($post->category)<span class="text-primary-400">{{ $post->category->name }}</span><span>•</span>@endif
                        <span>{{ $post->published_at?->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2 group-hover:text-primary-400 transition-colors line-clamp-2">{{ $post->title }}</h3>
                    <p class="text-gray-400 text-sm line-clamp-2">{{ $post->excerpt ?? Str::limit(strip_tags($post->body), 120) }}</p>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-12">
                <i class="fas fa-newspaper text-4xl text-gray-600 mb-4"></i>
                <p class="text-gray-400">Blog posts coming soon!</p>
            </div>
            @endforelse
        </div>
        @if(count($posts ?? []) > 0)
        <div class="text-center mt-12">
            <a href="{{ route('blog.index') }}" class="px-8 py-3 glass text-white font-semibold rounded-lg hover:bg-white/15 transition-all inline-flex items-center gap-2">View All Posts <i class="fas fa-arrow-right"></i></a>
        </div>
        @endif
    </div>
</section>
