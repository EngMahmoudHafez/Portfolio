@extends('layouts.app')
@section('title', 'Projects - Portfolio Agency')
@section('content')
<div class="pt-28 pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Our <span class="text-gradient">Projects</span></h1>
            <p class="text-gray-400 max-w-2xl mx-auto">Explore our complete portfolio of digital solutions.</p>
        </div>
        {{-- Search & Filter --}}
        <div class="flex flex-col md:flex-row gap-4 mb-10 justify-center">
            <form action="{{ route('projects.index') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search projects..." class="px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-primary-500 focus:border-transparent w-64">
                <button type="submit" class="px-4 py-2.5 gradient-primary rounded-xl text-white"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="flex flex-wrap justify-center gap-2 mb-10">
            <a href="{{ route('projects.index') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all {{ !($currentCategory ?? null) ? 'gradient-primary text-white' : 'glass text-gray-300 hover:text-white' }}">All</a>
            @foreach($categories as $cat)
            <a href="{{ route('projects.index', ['category' => $cat->id]) }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all {{ ($currentCategory ?? null) == $cat->id ? 'gradient-primary text-white' : 'glass text-gray-300 hover:text-white' }}">{{ $cat->name }}</a>
            @endforeach
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($projects as $project)
            <a href="{{ route('projects.show', $project->slug) }}" class="group glass rounded-2xl overflow-hidden hover:-translate-y-2 transition-all duration-500">
                <div class="h-48 overflow-hidden">
                    @if($project->cover_image)<img src="{{ asset('storage/'.$project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else<div class="w-full h-full gradient-primary flex items-center justify-center"><i class="fas fa-project-diagram text-4xl text-white/50"></i></div>@endif
                </div>
                <div class="p-6">
                    @if($project->category)<span class="text-xs text-primary-400 font-medium">{{ $project->category->name }}</span>@endif
                    <h3 class="text-lg font-bold text-white mt-1 mb-2 group-hover:text-primary-400 transition-colors">{{ $project->title }}</h3>
                    <p class="text-gray-400 text-sm line-clamp-2">{{ $project->short_description ?? Str::limit($project->description, 100) }}</p>
                    @if($project->technologies)
                    <div class="flex flex-wrap gap-1 mt-3">@foreach(array_slice($project->technologies,0,3) as $tech)<span class="px-2 py-0.5 text-xs glass rounded-full text-gray-300">{{ $tech }}</span>@endforeach</div>
                    @endif
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-16"><i class="fas fa-folder-open text-5xl text-gray-600 mb-4"></i><p class="text-gray-400 text-lg">No projects found.</p></div>
            @endforelse
        </div>
        <div class="mt-10">{{ $projects->links() }}</div>
    </div>
</div>
@endsection
