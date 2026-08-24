@extends('layouts.admin')
@section('title', 'Settings')
@section('content')
@php
    use App\Models\Setting;

    $field = 'w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent';
    $labelClass = 'block text-sm text-gray-400 mb-2';

    $socials = [
        'social_facebook'  => 'Facebook',
        'social_twitter'   => 'Twitter',
        'social_linkedin'  => 'LinkedIn',
        'social_github'    => 'GitHub',
        'social_instagram' => 'Instagram',
    ];
@endphp

<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold">Website Settings</h1>
    <a href="{{ route('home') }}" target="_blank" class="px-4 py-2 glass rounded-xl text-sm text-gray-300 hover:bg-white/10 transition">
        <i class="fas fa-arrow-up-right-from-square mr-2 text-xs"></i>Preview site
    </a>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="max-w-3xl space-y-6">
    @csrf @method('PUT')

    {{-- General --}}
    <section class="glass rounded-2xl p-8 space-y-6">
        <h2 class="text-lg font-semibold">General</h2>
        <div>
            <label for="site_name" class="{{ $labelClass }}">Site Name</label>
            <input id="site_name" type="text" name="site_name" value="{{ Setting::get('site_name', 'Logicore') }}" class="{{ $field }}">
        </div>
        <div>
            <label for="site_description" class="{{ $labelClass }}">Site Description</label>
            <textarea id="site_description" name="site_description" rows="2" class="{{ $field }} resize-none">{{ Setting::get('site_description', '') }}</textarea>
        </div>
        <div>
            <label for="seo_keywords" class="{{ $labelClass }}">SEO Keywords</label>
            <input id="seo_keywords" type="text" name="seo_keywords" value="{{ Setting::get('seo_keywords', '') }}" class="{{ $field }}" placeholder="web dev, agency, design">
        </div>
    </section>

    {{-- Homepage stats --}}
    <section class="glass rounded-2xl p-8 space-y-6">
        <div>
            <h2 class="text-lg font-semibold">Homepage Stats</h2>
            <p class="text-xs text-gray-500 mt-1">
                Shown under the hero on the homepage. Leave all three empty and the whole stat row is hidden —
                nothing placeholder is displayed.
            </p>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label for="stat_projects" class="{{ $labelClass }}">Projects Delivered</label>
                <input id="stat_projects" type="text" name="stat_projects" value="{{ Setting::get('stat_projects', '') }}" class="{{ $field }}" placeholder="40+">
            </div>
            <div>
                <label for="stat_clients" class="{{ $labelClass }}">Happy Clients</label>
                <input id="stat_clients" type="text" name="stat_clients" value="{{ Setting::get('stat_clients', '') }}" class="{{ $field }}" placeholder="25+">
            </div>
            <div>
                <label for="stat_years" class="{{ $labelClass }}">Years Experience</label>
                <input id="stat_years" type="text" name="stat_years" value="{{ Setting::get('stat_years', '') }}" class="{{ $field }}" placeholder="6+">
            </div>
        </div>
    </section>

    {{-- Contact --}}
    <section class="glass rounded-2xl p-8 space-y-6">
        <div>
            <h2 class="text-lg font-semibold">Contact</h2>
            <p class="text-xs text-gray-500 mt-1">Used by the contact section on the homepage. Empty rows are hidden.</p>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="contact_email" class="{{ $labelClass }}">Email</label>
                <input id="contact_email" type="email" name="contact_email" value="{{ Setting::get('contact_email', '') }}" class="{{ $field }}">
            </div>
            <div>
                <label for="contact_phone" class="{{ $labelClass }}">Phone</label>
                <input id="contact_phone" type="text" name="contact_phone" value="{{ Setting::get('contact_phone', '') }}" class="{{ $field }}">
            </div>
        </div>
        <div>
            <label for="contact_address" class="{{ $labelClass }}">Address</label>
            <input id="contact_address" type="text" name="contact_address" value="{{ Setting::get('contact_address', '') }}" class="{{ $field }}">
        </div>
        <div>
            <label for="whatsapp_number" class="{{ $labelClass }}">WhatsApp Number</label>
            <input id="whatsapp_number" type="text" name="whatsapp_number" value="{{ Setting::get('whatsapp_number', '') }}" class="{{ $field }}" placeholder="201234567890">
            <p class="text-xs text-gray-500 mt-2">
                Country code and number, digits only. Powers the floating WhatsApp button — leave empty to hide the button.
            </p>
        </div>
    </section>

    {{-- Social --}}
    <section class="glass rounded-2xl p-8 space-y-6">
        <div>
            <h2 class="text-lg font-semibold">Social Links</h2>
            <p class="text-xs text-gray-500 mt-1">Only channels with a URL appear in the footer and contact section.</p>
        </div>
        <div class="grid grid-cols-2 gap-4">
            @foreach($socials as $key => $label)
                <div>
                    <label for="{{ $key }}" class="{{ $labelClass }}">{{ $label }}</label>
                    <input id="{{ $key }}" type="url" name="{{ $key }}" value="{{ Setting::get($key, '') }}" class="{{ $field }}">
                </div>
            @endforeach
        </div>
    </section>

    <button type="submit" class="px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:opacity-90 transition">Save Settings</button>
</form>
@endsection
