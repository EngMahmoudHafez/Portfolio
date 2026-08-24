@extends('layouts.admin')
@section('title', 'Categories')
@section('content')
<div class="flex items-center justify-between mb-2">
    <h1 class="text-2xl font-bold">Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="px-5 py-2.5 gradient-primary text-white text-sm font-semibold rounded-xl hover:opacity-90 transition"><i class="fas fa-plus mr-2"></i>Add Category</a>
</div>
<p class="text-sm text-gray-500 mb-8">Active categories become the filter buttons on the public Projects and Blog pages. The type decides which page a category appears on.</p>

<div class="glass rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead><tr class="border-b border-white/5">
            <th class="text-left p-4 text-gray-400 font-medium">Category</th>
            <th class="text-left p-4 text-gray-400 font-medium">Type</th>
            <th class="text-left p-4 text-gray-400 font-medium">In use</th>
            <th class="text-left p-4 text-gray-400 font-medium">Status</th>
            <th class="text-right p-4 text-gray-400 font-medium">Actions</th>
        </tr></thead>
        <tbody>
            @forelse($categories as $category)
            @php($usage = $category->type === 'blog' ? $category->posts_count : $category->projects_count)
            <tr class="border-b border-white/5 hover:bg-white/5 transition">
                <td class="p-4">
                    <div class="font-medium text-white">{{ $category->name }}</div>
                    <div class="text-xs text-gray-500 mt-0.5">{{ $category->slug }}</div>
                </td>
                <td class="p-4">
                    <span class="px-2 py-1 rounded-full text-xs {{ $category->type === 'blog' ? 'bg-accent-500/20 text-accent-400' : 'bg-primary-500/20 text-primary-400' }}">
                        {{ $category->type === 'blog' ? 'Blog' : 'Project' }}
                    </span>
                </td>
                <td class="p-4 text-gray-400">{{ $usage }} {{ Str::plural($category->type === 'blog' ? 'post' : 'project', $usage) }}</td>
                <td class="p-4"><span class="px-2 py-1 rounded-full text-xs {{ $category->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">{{ $category->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td class="p-4 text-right">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-primary-400 hover:text-primary-300 mr-3"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline"
                          onsubmit="return confirm('{{ $usage > 0 ? $usage . ' item(s) use this category and will become uncategorised. Continue?' : 'Delete this category?' }}')">
                        @csrf @method('DELETE')<button class="text-red-400 hover:text-red-300"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty<tr><td colspan="5" class="p-8 text-center text-gray-400">No categories yet.</td></tr>@endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $categories->links() }}</div>
@endsection
