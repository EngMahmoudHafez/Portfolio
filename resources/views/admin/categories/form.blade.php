@extends('layouts.admin')
@section('title', isset($category) ? 'Edit Category' : 'Add Category')
@section('content')
<div class="max-w-2xl">
    <h1 class="text-2xl font-bold mb-8">{{ isset($category) ? 'Edit Category' : 'Add Category' }}</h1>
    <form action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST" class="glass rounded-2xl p-8 space-y-6">
        @csrf @if(isset($category)) @method('PUT') @endif

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm text-gray-400 mb-2">Name *</label>
                <input id="name" type="text" name="name" value="{{ old('name', $category->name ?? '') }}" required placeholder="Web Apps" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
            <div>
                <label for="slug" class="block text-sm text-gray-400 mb-2">Slug</label>
                <input id="slug" type="text" name="slug" value="{{ old('slug', $category->slug ?? '') }}" placeholder="auto from name" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
        </div>

        <div>
            <label for="type" class="block text-sm text-gray-400 mb-2">Type *</label>
            <select id="type" name="type" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                <option value="project" {{ old('type', $category->type ?? 'project') === 'project' ? 'selected' : '' }}>Project — filters the Projects page</option>
                <option value="blog" {{ old('type', $category->type ?? '') === 'blog' ? 'selected' : '' }}>Blog — filters the Blog page</option>
            </select>
            @if(isset($category))
                <p class="text-xs text-yellow-400/80 mt-2"><i class="fas fa-triangle-exclamation mr-1"></i>Changing the type moves this category to the other page and unlinks it from the filters it currently appears in.</p>
            @endif
        </div>

        <div>
            <label for="description" class="block text-sm text-gray-400 mb-2">Description</label>
            <textarea id="description" name="description" rows="3" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none">{{ old('description', $category->description ?? '') }}</textarea>
            <p class="text-xs text-gray-500 mt-2">Internal note — not displayed on the public site.</p>
        </div>

        <label class="flex items-center gap-3 cursor-pointer">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 rounded bg-white/5 border-white/10 text-primary-500 focus:ring-primary-500">
            <span class="text-sm text-gray-300">Active — show as a filter on the public site</span>
        </label>

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:opacity-90 transition">{{ isset($category) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 glass text-gray-300 rounded-xl hover:bg-white/10 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
