@extends('layouts.app')
@section('title', $project->title . ' - Logicore')
@section('content')
<div class="pt-28 pb-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition mb-8"><i class="fas fa-arrow-left"></i> Back to Projects</a>
        @if($project->cover_image)<img src="{{ asset('storage/'.$project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-80 object-cover rounded-lg mb-8">@endif
        <div class="flex items-center gap-3 mb-4">
            @if($project->category)<span class="px-3 py-1 gradient-primary text-white text-xs rounded-full">{{ $project->category->name }}</span>@endif
            @if($project->completed_at)<span class="text-gray-400 text-sm">{{ $project->completed_at->format('M Y') }}</span>@endif
        </div>
        <h1 class="text-4xl font-bold text-white mb-4">{{ $project->title }}</h1>
        <div class="prose prose-invert max-w-none mb-8 text-gray-300">{!! nl2br(e($project->description)) !!}</div>
        @if($project->technologies)<div class="mb-8"><h3 class="text-white font-semibold mb-3">Technologies</h3><div class="flex flex-wrap gap-2">@foreach($project->technologies as $tech)<span class="px-3 py-1 glass rounded-full text-sm text-gray-300">{{ $tech }}</span>@endforeach</div></div>@endif
        @if($project->gallery)<div class="mb-8"><h3 class="text-white font-semibold mb-3">Gallery</h3><div class="grid grid-cols-2 md:grid-cols-3 gap-4">@foreach($project->gallery as $img)<img src="{{ asset('storage/'.$img) }}" alt="Gallery" class="rounded-lg w-full h-40 object-cover hover:scale-105 transition-transform cursor-pointer">@endforeach</div></div>@endif
        <div class="flex gap-4">
            @if($project->live_url)<a href="{{ $project->live_url }}" target="_blank" class="px-6 py-3 gradient-primary text-white rounded-lg hover:opacity-90 transition"><i class="fas fa-external-link-alt mr-2"></i>Live Demo</a>@endif
            @if($project->github_url)<a href="{{ $project->github_url }}" target="_blank" class="px-6 py-3 glass text-white rounded-lg hover:bg-white/15 transition"><i class="fab fa-github mr-2"></i>GitHub</a>@endif
        </div>
    </div>
</div>
@endsection
