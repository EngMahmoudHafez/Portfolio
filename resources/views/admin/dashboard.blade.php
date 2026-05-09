@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<h1 class="text-2xl font-bold mb-8">Dashboard Overview</h1>

{{-- Stats --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="glass rounded-2xl p-6 hover:bg-white/10 transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-primary-500/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition"><i class="fas fa-folder text-primary-400 text-xl"></i></div>
            <span class="text-xs text-gray-400">Projects</span>
        </div>
        <div class="text-3xl font-bold text-white">{{ $totalProjects }}</div>
        <div class="text-sm text-gray-400 mt-1">Total Projects</div>
    </div>
    <div class="glass rounded-2xl p-6 hover:bg-white/10 transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition"><i class="fas fa-users text-green-400 text-xl"></i></div>
            <span class="text-xs text-gray-400">Team</span>
        </div>
        <div class="text-3xl font-bold text-white">{{ $totalTeamMembers }}</div>
        <div class="text-sm text-gray-400 mt-1">Team Members</div>
    </div>
    <div class="glass rounded-2xl p-6 hover:bg-white/10 transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition"><i class="fas fa-envelope text-yellow-400 text-xl"></i></div>
            <span class="text-xs text-gray-400">Messages</span>
        </div>
        <div class="text-3xl font-bold text-white">{{ $totalContacts }}</div>
        <div class="text-sm text-gray-400 mt-1">{{ $unreadContacts }} unread</div>
    </div>
    <div class="glass rounded-2xl p-6 hover:bg-white/10 transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition"><i class="fas fa-blog text-purple-400 text-xl"></i></div>
            <span class="text-xs text-gray-400">Blog</span>
        </div>
        <div class="text-3xl font-bold text-white">{{ $totalPosts }}</div>
        <div class="text-sm text-gray-400 mt-1">{{ $publishedPosts }} published</div>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-6">
    {{-- Recent Messages --}}
    <div class="glass rounded-2xl p-6">
        <h3 class="text-lg font-semibold mb-4">Recent Messages</h3>
        <div class="space-y-3">
            @forelse($recentContacts as $contact)
            <a href="{{ route('admin.contacts.show', $contact) }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition">
                <div class="w-10 h-10 {{ $contact->is_read ? 'bg-gray-700' : 'gradient-primary' }} rounded-full flex items-center justify-center text-white text-sm font-bold shrink-0">{{ substr($contact->name,0,1) }}</div>
                <div class="min-w-0 flex-1">
                    <div class="flex items-center justify-between"><span class="text-white text-sm font-medium truncate">{{ $contact->name }}</span><span class="text-xs text-gray-500">{{ $contact->created_at->diffForHumans() }}</span></div>
                    <p class="text-gray-400 text-xs truncate">{{ $contact->subject }}</p>
                </div>
                @unless($contact->is_read)<span class="w-2 h-2 bg-primary-500 rounded-full shrink-0"></span>@endunless
            </a>
            @empty
            <p class="text-gray-400 text-sm text-center py-4">No messages yet.</p>
            @endforelse
        </div>
    </div>
    {{-- Recent Posts --}}
    <div class="glass rounded-2xl p-6">
        <h3 class="text-lg font-semibold mb-4">Recent Posts</h3>
        <div class="space-y-3">
            @forelse($recentPosts as $post)
            <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition">
                <div class="w-10 h-10 bg-purple-500/20 rounded-xl flex items-center justify-center shrink-0"><i class="fas fa-file-alt text-purple-400"></i></div>
                <div class="min-w-0 flex-1">
                    <div class="text-white text-sm font-medium truncate">{{ $post->title }}</div>
                    <div class="flex items-center gap-2 text-xs text-gray-400"><span class="px-2 py-0.5 rounded-full {{ $post->status == 'published' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">{{ ucfirst($post->status) }}</span><span>{{ $post->created_at->diffForHumans() }}</span></div>
                </div>
            </div>
            @empty
            <p class="text-gray-400 text-sm text-center py-4">No posts yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
