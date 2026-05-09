@extends('layouts.admin')
@section('title', isset($service) ? 'Edit Service' : 'Add Service')
@section('content')
<div class="max-w-2xl">
    <h1 class="text-2xl font-bold mb-8">{{ isset($service) ? 'Edit Service' : 'Add Service' }}</h1>
    <form action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" method="POST" class="glass rounded-2xl p-8 space-y-6">
        @csrf
        @if(isset($service)) @method('PUT') @endif
        <div>
            <label class="block text-sm text-gray-400 mb-2">Title *</label>
            <input type="text" name="title" value="{{ old('title', $service->title ?? '') }}" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
        </div>
        <div>
            <label class="block text-sm text-gray-400 mb-2">Slug *</label>
            <input type="text" name="slug" value="{{ old('slug', $service->slug ?? '') }}" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
        </div>
        <div>
            <label class="block text-sm text-gray-400 mb-2">Description *</label>
            <textarea name="description" rows="4" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none">{{ old('description', $service->description ?? '') }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-400 mb-2">Icon Class (FontAwesome)</label>
                <input type="text" name="icon" value="{{ old('icon', $service->icon ?? 'fas fa-code') }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent" placeholder="fas fa-code">
            </div>
            <div>
                <label class="block text-sm text-gray-400 mb-2">Icon Color</label>
                <input type="color" name="icon_color" value="{{ old('icon_color', $service->icon_color ?? '#6366f1') }}" class="w-full h-12 bg-white/5 border border-white/10 rounded-xl cursor-pointer">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-400 mb-2">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
            <div class="flex items-end">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 rounded bg-white/5 border-white/10 text-primary-500 focus:ring-primary-500">
                    <span class="text-sm text-gray-300">Active</span>
                </label>
            </div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:opacity-90 transition">{{ isset($service) ? 'Update' : 'Create' }} Service</button>
            <a href="{{ route('admin.services.index') }}" class="px-6 py-3 glass text-gray-300 rounded-xl hover:bg-white/10 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
