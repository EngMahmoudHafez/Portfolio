@extends('layouts.admin')
@section('title', isset($skill) ? 'Edit Skill' : 'Add Skill')
@section('content')
<div class="max-w-2xl">
    <h1 class="text-2xl font-bold mb-8">{{ isset($skill) ? 'Edit Skill' : 'Add Skill' }}</h1>
    <form action="{{ isset($skill) ? route('admin.skills.update', $skill) : route('admin.skills.store') }}" method="POST" class="glass rounded-2xl p-8 space-y-6">
        @csrf @if(isset($skill)) @method('PUT') @endif

        <div>
            <label for="name" class="block text-sm text-gray-400 mb-2">Name *</label>
            <input id="name" type="text" name="name" value="{{ old('name', $skill->name ?? '') }}" required placeholder="Laravel" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            <p class="text-xs text-gray-500 mt-2">This is the only field shown on the public site.</p>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="icon" class="block text-sm text-gray-400 mb-2">Icon Class (FontAwesome)</label>
                <input id="icon" type="text" name="icon" value="{{ old('icon', $skill->icon ?? '') }}" placeholder="fab fa-laravel" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
            <div>
                <label for="color" class="block text-sm text-gray-400 mb-2">Colour</label>
                <input id="color" type="color" name="color" value="{{ old('color', $skill->color ?? '#176BFF') }}" class="w-full h-12 bg-white/5 border border-white/10 rounded-xl cursor-pointer">
            </div>
        </div>
        <p class="text-xs text-gray-500 -mt-3">Icon and colour are used in this admin list only — the public section renders names as a plain technical index.</p>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="sort_order" class="block text-sm text-gray-400 mb-2">Sort Order</label>
                <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $skill->sort_order ?? 0) }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
            <div class="flex items-end">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $skill->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 rounded bg-white/5 border-white/10 text-primary-500 focus:ring-primary-500">
                    <span class="text-sm text-gray-300">Active</span>
                </label>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:opacity-90 transition">{{ isset($skill) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.skills.index') }}" class="px-6 py-3 glass text-gray-300 rounded-xl hover:bg-white/10 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
