@extends('layouts.admin')
@section('title', isset($tag) ? 'Edit Tag' : 'Add Tag')
@section('content')
<div class="max-w-xl">
    <h1 class="text-2xl font-bold mb-8">{{ isset($tag) ? 'Edit Tag' : 'Add Tag' }}</h1>
    <form action="{{ isset($tag) ? route('admin.tags.update', $tag) : route('admin.tags.store') }}" method="POST" class="glass rounded-2xl p-8 space-y-6">
        @csrf @if(isset($tag)) @method('PUT') @endif

        <div>
            <label for="name" class="block text-sm text-gray-400 mb-2">Name *</label>
            <input id="name" type="text" name="name" value="{{ old('name', $tag->name ?? '') }}" required placeholder="Laravel" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            <p class="text-xs text-gray-500 mt-2">Displayed with a leading # on the public site.</p>
        </div>

        <div>
            <label for="slug" class="block text-sm text-gray-400 mb-2">Slug</label>
            <input id="slug" type="text" name="slug" value="{{ old('slug', $tag->slug ?? '') }}" placeholder="auto from name" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:opacity-90 transition">{{ isset($tag) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.tags.index') }}" class="px-6 py-3 glass text-gray-300 rounded-xl hover:bg-white/10 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
