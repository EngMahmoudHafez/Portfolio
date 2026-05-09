@extends('layouts.admin')
@section('title', 'Settings')
@section('content')
<h1 class="text-2xl font-bold mb-8">Website Settings</h1>
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl glass rounded-2xl p-8 space-y-6">
    @csrf @method('PUT')
    <div><label class="block text-sm text-gray-400 mb-2">Site Name</label><input type="text" name="site_name" value="{{ App\Models\Setting::get('site_name', 'Portfolio Agency') }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
    <div><label class="block text-sm text-gray-400 mb-2">Site Description</label><textarea name="site_description" rows="2" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none">{{ App\Models\Setting::get('site_description', '') }}</textarea></div>
    <div><label class="block text-sm text-gray-400 mb-2">SEO Keywords</label><input type="text" name="seo_keywords" value="{{ App\Models\Setting::get('seo_keywords', '') }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent" placeholder="web dev, agency, design"></div>
    <div class="grid grid-cols-2 gap-4">
        <div><label class="block text-sm text-gray-400 mb-2">Email</label><input type="email" name="contact_email" value="{{ App\Models\Setting::get('contact_email', '') }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
        <div><label class="block text-sm text-gray-400 mb-2">Phone</label><input type="text" name="contact_phone" value="{{ App\Models\Setting::get('contact_phone', '') }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
    </div>
    <div><label class="block text-sm text-gray-400 mb-2">Address</label><input type="text" name="contact_address" value="{{ App\Models\Setting::get('contact_address', '') }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
    <h3 class="text-lg font-semibold pt-4 border-t border-white/10">Social Links</h3>
    <div class="grid grid-cols-2 gap-4">
        <div><label class="block text-sm text-gray-400 mb-2">Facebook</label><input type="url" name="social_facebook" value="{{ App\Models\Setting::get('social_facebook', '') }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
        <div><label class="block text-sm text-gray-400 mb-2">Twitter</label><input type="url" name="social_twitter" value="{{ App\Models\Setting::get('social_twitter', '') }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
        <div><label class="block text-sm text-gray-400 mb-2">LinkedIn</label><input type="url" name="social_linkedin" value="{{ App\Models\Setting::get('social_linkedin', '') }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
        <div><label class="block text-sm text-gray-400 mb-2">GitHub</label><input type="url" name="social_github" value="{{ App\Models\Setting::get('social_github', '') }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"></div>
    </div>
    <button type="submit" class="px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:opacity-90 transition">Save Settings</button>
</form>
@endsection
