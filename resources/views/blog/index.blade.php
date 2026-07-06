@extends('layouts.app')
@section('title', 'Blog - Logicore')
@section('content')
<div class="pt-28 pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Our <span class="text-gradient">Blog</span></h1>
            <p class="text-gray-400 max-w-2xl mx-auto">Updates and insights on intelligent products, automation, and scalable systems.</p>
        </div>
        <div class="flex flex-col md:flex-row gap-4 mb-10 justify-center">
            <form action="{{ route('blog.index') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search articles..." class="px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-primary-500 w-64">
                <button type="submit" class="px-4 py-2.5 gradient-primary rounded-lg text-white"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="flex flex-wrap justify-center gap-2 mb-10">
            <a href="{{ route('blog.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all {{ !($currentCategory ?? null) && !($currentTag ?? null) ? 'gradient-primary text-white' : 'glass text-gray-300 hover:text-white' }}">All</a>
            @foreach($categories as $cat)
            <a href="{{ route('blog.index', ['category' => $cat->id]) }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all {{ ($currentCategory ?? null) == $cat->id ? 'gradient-primary text-white' : 'glass text-gray-300 hover:text-white' }}">{{ $cat->name }}</a>
            @endforeach
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($posts as $post)
            <a href="{{ route('blog.show', $post->slug) }}" class="group glass rounded-lg overflow-hidden hover:-translate-y-2 transition-all duration-500">
                <div class="h-48 overflow-hidden">
                    @if($post->cover_image)<img src="{{ asset('storage/'.$post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else<div class="w-full h-full gradient-primary flex items-center justify-center"><i class="fas fa-newspaper text-4xl text-white/50"></i></div>@endif
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-3 text-xs text-gray-400">
                        @if($post->category)<span class="text-primary-400">{{ $post->category->name }}</span><span>•</span>@endif
                        <span>{{ $post->published_at?->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2 group-hover:text-primary-400 transition-colors line-clamp-2">{{ $post->title }}</h3>
                    <p class="text-gray-400 text-sm line-clamp-2">{{ $post->excerpt ?? Str::limit(strip_tags($post->body), 120) }}</p>
                    @if($post->tags && $post->tags->count())
                    <div class="flex flex-wrap gap-1 mt-3">@foreach($post->tags->take(3) as $tag)<span class="px-2 py-0.5 text-xs glass rounded-full text-gray-300">#{{ $tag->name }}</span>@endforeach</div>
                    @endif
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-16"><i class="fas fa-newspaper text-5xl text-gray-600 mb-4"></i><p class="text-gray-400 text-lg">No posts found.</p></div>
            @endforelse
        </div>
        <div class="mt-10">{{ $posts->links() }}</div>
    </div>
</div>
@endsection
