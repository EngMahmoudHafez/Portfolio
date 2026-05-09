@extends('layouts.app')
@section('title', $post->title . ' - Portfolio Agency')
@section('meta_description', $post->excerpt ?? Str::limit(strip_tags($post->body), 160))
@section('content')
<div class="pt-28 pb-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition mb-8"><i class="fas fa-arrow-left"></i> Back to Blog</a>
        @if($post->cover_image)<img src="{{ asset('storage/'.$post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-80 object-cover rounded-2xl mb-8">@endif
        <div class="flex items-center gap-3 mb-4 text-sm text-gray-400">
            @if($post->category)<span class="px-3 py-1 gradient-primary text-white text-xs rounded-full">{{ $post->category->name }}</span>@endif
            <span>{{ $post->published_at?->format('M d, Y') }}</span>
            <span>•</span>
            <span>{{ $post->views_count }} views</span>
        </div>
        <h1 class="text-4xl font-bold text-white mb-6">{{ $post->title }}</h1>
        @if($post->user)
        <div class="flex items-center gap-3 mb-8"><div class="w-10 h-10 gradient-primary rounded-full flex items-center justify-center text-white font-bold">{{ substr($post->user->name,0,1) }}</div><div><div class="text-white font-medium">{{ $post->user->name }}</div></div></div>
        @endif
        <div class="prose prose-invert prose-lg max-w-none mb-8">{!! $post->body !!}</div>
        @if($post->tags && $post->tags->count())
        <div class="flex flex-wrap gap-2 mb-8">@foreach($post->tags as $tag)<a href="{{ route('blog.index', ['tag' => $tag->id]) }}" class="px-3 py-1 glass rounded-full text-sm text-gray-300 hover:text-primary-400 transition">#{{ $tag->name }}</a>@endforeach</div>
        @endif
        {{-- Share Buttons --}}
        <div class="flex items-center gap-3 mb-12"><span class="text-gray-400 text-sm">Share:</span>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" target="_blank" class="w-10 h-10 glass rounded-xl flex items-center justify-center text-gray-400 hover:text-primary-400 transition"><i class="fab fa-twitter"></i></a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-10 h-10 glass rounded-xl flex items-center justify-center text-gray-400 hover:text-primary-400 transition"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}" target="_blank" class="w-10 h-10 glass rounded-xl flex items-center justify-center text-gray-400 hover:text-primary-400 transition"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>
</div>
@endsection
