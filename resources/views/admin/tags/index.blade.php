@extends('layouts.admin')
@section('title', 'Tags')
@section('content')
<div class="flex items-center justify-between mb-2">
    <h1 class="text-2xl font-bold">Tags</h1>
    <a href="{{ route('admin.tags.create') }}" class="px-5 py-2.5 gradient-primary text-white text-sm font-semibold rounded-xl hover:opacity-90 transition"><i class="fas fa-plus mr-2"></i>Add Tag</a>
</div>
<p class="text-sm text-gray-500 mb-8">Tags appear on blog cards and as a filter row on the public Blog page. Assign them to a post from the post editor.</p>

<div class="glass rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead><tr class="border-b border-white/5">
            <th class="text-left p-4 text-gray-400 font-medium">Tag</th>
            <th class="text-left p-4 text-gray-400 font-medium">Slug</th>
            <th class="text-left p-4 text-gray-400 font-medium">Posts</th>
            <th class="text-right p-4 text-gray-400 font-medium">Actions</th>
        </tr></thead>
        <tbody>
            @forelse($tags as $tag)
            <tr class="border-b border-white/5 hover:bg-white/5 transition">
                <td class="p-4"><span class="font-medium text-white">#{{ $tag->name }}</span></td>
                <td class="p-4 text-gray-500 text-xs">{{ $tag->slug }}</td>
                <td class="p-4 text-gray-400">{{ $tag->posts_count }}</td>
                <td class="p-4 text-right">
                    <a href="{{ route('admin.tags.edit', $tag) }}" class="text-primary-400 hover:text-primary-300 mr-3"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="inline"
                          onsubmit="return confirm('{{ $tag->posts_count > 0 ? 'This tag is on ' . $tag->posts_count . ' post(s) and will be removed from them. Continue?' : 'Delete this tag?' }}')">
                        @csrf @method('DELETE')<button class="text-red-400 hover:text-red-300"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty<tr><td colspan="4" class="p-8 text-center text-gray-400">No tags yet.</td></tr>@endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $tags->links() }}</div>
@endsection
