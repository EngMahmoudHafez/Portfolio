@extends('layouts.admin')
@section('title', isset($post) ? 'Edit Post' : 'Add Post')
@section('content')
<div class="max-w-3xl">
    <h1 class="text-2xl font-bold mb-8">{{ isset($post) ? 'Edit Post' : 'Add Post' }}</h1>
    <form action="{{ isset($post) ? route('admin.posts.update', $post) : route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="glass rounded-2xl p-8 space-y-6">
        @csrf @if(isset($post)) @method('PUT') @endif
        <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-sm text-gray-400 mb-2">Title *</label><input type="text" name="title" value="{{ old('title', $post->title ?? '') }}" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
            <div><label class="block text-sm text-gray-400 mb-2">Slug *</label><input type="text" name="slug" value="{{ old('slug', $post->slug ?? '') }}" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
        </div>
        <div><label class="block text-sm text-gray-400 mb-2">Excerpt</label><textarea name="excerpt" rows="2" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none">{{ old('excerpt', $post->excerpt ?? '') }}</textarea></div>
        <div><label class="block text-sm text-gray-400 mb-2">Body *</label><textarea name="body" rows="12" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none">{{ old('body', $post->body ?? '') }}</textarea></div>
        <div><label class="block text-sm text-gray-400 mb-2">Cover Image</label><input type="file" name="cover_image" accept="image/*" class="w-full text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-500/20 file:text-primary-400">@if(isset($post) && $post->cover_image)<img src="{{ asset('storage/'.$post->cover_image) }}" class="w-24 h-16 rounded-lg mt-2 object-cover">@endif</div>
        <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-sm text-gray-400 mb-2">Category</label><select name="category_id" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"><option value="">None</option>@foreach($categories as $c)<option value="{{ $c->id }}" {{ old('category_id', $post->category_id ?? '') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>@endforeach</select></div>
            <div><label class="block text-sm text-gray-400 mb-2">Status *</label><select name="status" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"><option value="draft" {{ old('status', $post->status ?? 'draft') == 'draft' ? 'selected' : '' }}>Draft</option><option value="published" {{ old('status', $post->status ?? '') == 'published' ? 'selected' : '' }}>Published</option></select></div>
        </div>
        <div>
            <label class="block text-sm text-gray-400 mb-2">Publish Date</label>
            <input type="datetime-local" name="published_at" value="{{ old('published_at', isset($post) && $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            <p class="text-xs text-gray-500 mt-2">Leave empty and publishing stamps the current time. A future date keeps the post hidden until then.</p>
        </div>
        @if(isset($tags) && $tags->count())
        <div><label class="block text-sm text-gray-400 mb-2">Tags</label><div class="flex flex-wrap gap-2">@foreach($tags as $tag)<label class="flex items-center gap-2 px-3 py-1.5 glass rounded-lg cursor-pointer hover:bg-white/10 transition"><input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ isset($post) && $post->tags->contains($tag->id) ? 'checked' : '' }} class="w-4 h-4 rounded bg-white/5 border-white/10 text-primary-500"><span class="text-sm text-gray-300">{{ $tag->name }}</span></label>@endforeach</div></div>
        @endif
        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:opacity-90 transition">{{ isset($post) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.posts.index') }}" class="px-6 py-3 glass text-gray-300 rounded-xl hover:bg-white/10 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
