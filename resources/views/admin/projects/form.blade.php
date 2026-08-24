@extends('layouts.admin')
@section('title', isset($project) ? 'Edit Project' : 'Add Project')
@section('content')
<div class="max-w-2xl">
    <h1 class="text-2xl font-bold mb-8">{{ isset($project) ? 'Edit Project' : 'Add Project' }}</h1>
    <form action="{{ isset($project) ? route('admin.projects.update', $project) : route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="glass rounded-2xl p-8 space-y-6">
        @csrf @if(isset($project)) @method('PUT') @endif
        <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-sm text-gray-400 mb-2">Title *</label><input type="text" name="title" value="{{ old('title', $project->title ?? '') }}" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
            <div><label class="block text-sm text-gray-400 mb-2">Slug *</label><input type="text" name="slug" value="{{ old('slug', $project->slug ?? '') }}" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
        </div>
        <div><label class="block text-sm text-gray-400 mb-2">Short Description</label><input type="text" name="short_description" value="{{ old('short_description', $project->short_description ?? '') }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
        <div><label class="block text-sm text-gray-400 mb-2">Description *</label><textarea name="description" rows="5" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none">{{ old('description', $project->description ?? '') }}</textarea></div>
        <div><label class="block text-sm text-gray-400 mb-2">Category</label><select name="category_id" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"><option value="">None</option>@foreach($categories as $c)<option value="{{ $c->id }}" {{ old('category_id', $project->category_id ?? '') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>@endforeach</select></div>
        <div><label class="block text-sm text-gray-400 mb-2">Cover Image</label><input type="file" name="cover_image" accept="image/*" class="w-full text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-500/20 file:text-primary-400">@if(isset($project) && $project->cover_image)<img src="{{ asset('storage/'.$project->cover_image) }}" class="w-24 h-16 rounded-lg mt-2 object-cover">@endif</div>
        <div x-data="{ removing: [] }">
            <label class="block text-sm text-gray-400 mb-2">Gallery Images</label>

            @if(isset($project) && $project->gallery)
                <p class="text-xs text-gray-500 mb-3">
                    {{ count($project->gallery) }} {{ Str::plural('image', count($project->gallery)) }} in the gallery.
                    New uploads are <span class="text-gray-300">added</span> to these. Click an image to mark it for deletion.
                </p>

                <div class="grid grid-cols-4 sm:grid-cols-6 gap-3 mb-3">
                    @foreach($project->gallery as $galleryImage)
                        <label class="relative block cursor-pointer">
                            <input type="checkbox" name="remove_gallery[]" value="{{ $galleryImage }}" x-model="removing" class="peer sr-only">
                            <img src="{{ asset('storage/'.$galleryImage) }}" alt=""
                                 class="w-full h-16 rounded-lg object-cover border-2 border-white/10 transition peer-checked:border-red-500 peer-checked:opacity-35 peer-focus-visible:ring-2 peer-focus-visible:ring-primary-500">
                            <span aria-hidden="true"
                                  class="absolute top-1 right-1 w-6 h-6 rounded-md bg-black/60 flex items-center justify-center text-[10px] text-gray-300 transition peer-checked:bg-red-500 peer-checked:text-white">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="sr-only">Mark this image for deletion</span>
                        </label>
                    @endforeach
                </div>

                <p x-show="removing.length" x-cloak class="text-xs text-red-400 mb-3">
                    <i class="fas fa-triangle-exclamation mr-1"></i>
                    <span x-text="removing.length"></span> <span x-text="removing.length === 1 ? 'image' : 'images'"></span> will be deleted permanently when you save.
                </p>
            @endif

            <input type="file" name="gallery[]" multiple accept="image/*" class="w-full text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-500/20 file:text-primary-400">
            <p class="text-xs text-gray-500 mt-2">Selected files are appended to the gallery — nothing existing is overwritten.</p>
        </div>

        {{-- Technologies: rendered as the tech stack on the public card and case study --}}
        <x-admin.list-field
            name="technologies"
            label="Technologies"
            :values="old('technologies', $project->technologies ?? [])"
            placeholder="Laravel"
            hint="Shown as tags on the project card and in the case-study sidebar."
            add-label="Add technology" />
        <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-sm text-gray-400 mb-2">Live URL</label><input type="url" name="live_url" value="{{ old('live_url', $project->live_url ?? '') }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
            <div><label class="block text-sm text-gray-400 mb-2">GitHub URL</label><input type="url" name="github_url" value="{{ old('github_url', $project->github_url ?? '') }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
        </div>
        <div class="grid grid-cols-4 gap-4">
            <div><label class="block text-sm text-gray-400 mb-2">Sort Order</label><input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order ?? 0) }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
            <div><label class="block text-sm text-gray-400 mb-2">Completed At</label><input type="date" name="completed_at" value="{{ old('completed_at', isset($project) && $project->completed_at ? $project->completed_at->format('Y-m-d') : '') }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
            <div class="flex items-end"><label class="flex items-center gap-3 cursor-pointer"><input type="hidden" name="is_featured" value="0"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }} class="w-5 h-5 rounded bg-white/5 border-white/10 text-primary-500"><span class="text-sm text-gray-300">Featured</span></label></div>
            <div class="flex items-end"><label class="flex items-center gap-3 cursor-pointer"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $project->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 rounded bg-white/5 border-white/10 text-primary-500"><span class="text-sm text-gray-300">Active</span></label></div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:opacity-90 transition">{{ isset($project) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.projects.index') }}" class="px-6 py-3 glass text-gray-300 rounded-xl hover:bg-white/10 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
