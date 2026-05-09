@extends('layouts.admin')
@section('title', 'Blog Posts')
@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold">Blog Posts</h1>
    <a href="{{ route('admin.posts.create') }}" class="px-5 py-2.5 gradient-primary text-white text-sm font-semibold rounded-xl hover:opacity-90 transition"><i class="fas fa-plus mr-2"></i>Add Post</a>
</div>
<div class="glass rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead><tr class="border-b border-white/5">
            <th class="text-left p-4 text-gray-400 font-medium">Post</th>
            <th class="text-left p-4 text-gray-400 font-medium">Category</th>
            <th class="text-left p-4 text-gray-400 font-medium">Status</th>
            <th class="text-left p-4 text-gray-400 font-medium">Views</th>
            <th class="text-right p-4 text-gray-400 font-medium">Actions</th>
        </tr></thead>
        <tbody>
            @forelse($posts as $p)
            <tr class="border-b border-white/5 hover:bg-white/5 transition">
                <td class="p-4"><div class="font-medium text-white">{{ $p->title }}</div><div class="text-xs text-gray-400">{{ $p->published_at?->format('M d, Y') ?? 'Draft' }}</div></td>
                <td class="p-4 text-gray-400">{{ $p->category?->name ?? '-' }}</td>
                <td class="p-4"><span class="px-2 py-1 rounded-full text-xs {{ $p->status == 'published' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">{{ ucfirst($p->status) }}</span></td>
                <td class="p-4 text-gray-400">{{ $p->views_count }}</td>
                <td class="p-4 text-right">
                    <a href="{{ route('admin.posts.edit', $p) }}" class="text-primary-400 hover:text-primary-300 mr-3"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.posts.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="text-red-400 hover:text-red-300"><i class="fas fa-trash"></i></button></form>
                </td>
            </tr>
            @empty<tr><td colspan="5" class="p-8 text-center text-gray-400">No posts yet.</td></tr>@endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $posts->links() }}</div>
@endsection
