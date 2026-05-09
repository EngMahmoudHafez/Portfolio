@extends('layouts.admin')
@section('title', isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial')
@section('content')
<div class="max-w-2xl">
    <h1 class="text-2xl font-bold mb-8">{{ isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial' }}</h1>
    <form action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="glass rounded-2xl p-8 space-y-6">
        @csrf @if(isset($testimonial)) @method('PUT') @endif
        <div class="grid grid-cols-3 gap-4">
            <div><label class="block text-sm text-gray-400 mb-2">Client Name *</label><input type="text" name="client_name" value="{{ old('client_name', $testimonial->client_name ?? '') }}" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
            <div><label class="block text-sm text-gray-400 mb-2">Position</label><input type="text" name="client_position" value="{{ old('client_position', $testimonial->client_position ?? '') }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
            <div><label class="block text-sm text-gray-400 mb-2">Company</label><input type="text" name="client_company" value="{{ old('client_company', $testimonial->client_company ?? '') }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
        </div>
        <div><label class="block text-sm text-gray-400 mb-2">Content *</label><textarea name="content" rows="4" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none">{{ old('content', $testimonial->content ?? '') }}</textarea></div>
        <div><label class="block text-sm text-gray-400 mb-2">Client Photo</label><input type="file" name="client_image" accept="image/*" class="w-full text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-500/20 file:text-primary-400"></div>
        <div class="grid grid-cols-3 gap-4">
            <div><label class="block text-sm text-gray-400 mb-2">Rating *</label><select name="rating" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">@for($i=5;$i>=1;$i--)<option value="{{ $i }}" {{ old('rating', $testimonial->rating ?? 5) == $i ? 'selected' : '' }}>{{ $i }} Stars</option>@endfor</select></div>
            <div><label class="block text-sm text-gray-400 mb-2">Order</label><input type="number" name="sort_order" value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
            <div class="flex items-end"><label class="flex items-center gap-3 cursor-pointer"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 rounded bg-white/5 border-white/10 text-primary-500"><span class="text-sm text-gray-300">Active</span></label></div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:opacity-90 transition">{{ isset($testimonial) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.testimonials.index') }}" class="px-6 py-3 glass text-gray-300 rounded-xl hover:bg-white/10 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
