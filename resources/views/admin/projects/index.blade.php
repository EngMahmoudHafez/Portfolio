@extends('layouts.admin')
@section('title', 'Projects')
@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold">Projects</h1>
    <a href="{{ route('admin.projects.create') }}" class="px-5 py-2.5 gradient-primary text-white text-sm font-semibold rounded-xl hover:opacity-90 transition"><i class="fas fa-plus mr-2"></i>Add Project</a>
</div>
<div class="glass rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead><tr class="border-b border-white/5">
            <th class="text-left p-4 text-gray-400 font-medium">Project</th>
            <th class="text-left p-4 text-gray-400 font-medium">Category</th>
            <th class="text-left p-4 text-gray-400 font-medium">Status</th>
            <th class="text-left p-4 text-gray-400 font-medium">Featured</th>
            <th class="text-right p-4 text-gray-400 font-medium">Actions</th>
        </tr></thead>
        <tbody>
            @forelse($projects as $p)
            <tr class="border-b border-white/5 hover:bg-white/5 transition">
                <td class="p-4"><div class="flex items-center gap-3">
                    @if($p->cover_image)<img src="{{ asset('storage/'.$p->cover_image) }}" class="w-10 h-10 rounded-lg object-cover">@else<div class="w-10 h-10 gradient-primary rounded-lg flex items-center justify-center"><i class="fas fa-image text-white/50 text-xs"></i></div>@endif
                    <div><div class="font-medium text-white">{{ $p->title }}</div><div class="text-xs text-gray-400">{{ Str::limit($p->short_description ?? $p->description, 40) }}</div></div></div></td>
                <td class="p-4 text-gray-400">{{ $p->category?->name ?? '-' }}</td>
                <td class="p-4"><span class="px-2 py-1 rounded-full text-xs {{ $p->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">{{ $p->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td class="p-4">@if($p->is_featured)<i class="fas fa-star text-yellow-400"></i>@else<i class="far fa-star text-gray-600"></i>@endif</td>
                <td class="p-4 text-right">
                    <a href="{{ route('admin.projects.edit', $p) }}" class="text-primary-400 hover:text-primary-300 mr-3"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.projects.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="text-red-400 hover:text-red-300"><i class="fas fa-trash"></i></button></form>
                </td>
            </tr>
            @empty<tr><td colspan="5" class="p-8 text-center text-gray-400">No projects yet.</td></tr>@endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $projects->links() }}</div>
@endsection
