@extends('layouts.admin')
@section('title', isset($member) ? 'Edit Member' : 'Add Member')
@section('content')
<div class="max-w-2xl">
    <h1 class="text-2xl font-bold mb-8">{{ isset($member) ? 'Edit Member' : 'Add Member' }}</h1>
    <form action="{{ isset($member) ? route('admin.team.update', $member) : route('admin.team.store') }}" method="POST" enctype="multipart/form-data" class="glass rounded-2xl p-8 space-y-6">
        @csrf
        @if(isset($member)) @method('PUT') @endif
        <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-sm text-gray-400 mb-2">Name *</label><input type="text" name="name" value="{{ old('name', $member->name ?? '') }}" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
            <div><label class="block text-sm text-gray-400 mb-2">Slug *</label><input type="text" name="slug" value="{{ old('slug', $member->slug ?? '') }}" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
        </div>
        <div><label class="block text-sm text-gray-400 mb-2">Position *</label><input type="text" name="position" value="{{ old('position', $member->position ?? '') }}" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
        <div><label class="block text-sm text-gray-400 mb-2">Bio</label><textarea name="bio" rows="4" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none">{{ old('bio', $member->bio ?? '') }}</textarea></div>
        <div><label class="block text-sm text-gray-400 mb-2">Photo</label><input type="file" name="photo" accept="image/*" class="w-full text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-500/20 file:text-primary-400 hover:file:bg-primary-500/30">
            @if(isset($member) && $member->photo)<img src="{{ asset('storage/'.$member->photo) }}" class="w-16 h-16 rounded-full mt-2 object-cover">@endif
        </div>
        {{-- Skills: rendered as tags on the public team card --}}
        <x-admin.list-field
            name="skills"
            label="Skills"
            :values="old('skills', $member->skills ?? [])"
            placeholder="Laravel"
            hint="Up to three are shown on the public team card."
            add-label="Add skill" />

        <x-admin.social-links-field :values="old('social_links', $member->social_links ?? [])" />

        <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-sm text-gray-400 mb-2">Sort Order</label><input type="number" name="sort_order" value="{{ old('sort_order', $member->sort_order ?? 0) }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
            <div class="flex items-end"><label class="flex items-center gap-3 cursor-pointer"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $member->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 rounded bg-white/5 border-white/10 text-primary-500 focus:ring-primary-500"><span class="text-sm text-gray-300">Active</span></label></div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:opacity-90 transition">{{ isset($member) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.team.index') }}" class="px-6 py-3 glass text-gray-300 rounded-xl hover:bg-white/10 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
