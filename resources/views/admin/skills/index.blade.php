@extends('layouts.admin')
@section('title', 'Skills')
@section('content')
<div class="flex items-center justify-between mb-2">
    <h1 class="text-2xl font-bold">Skills</h1>
    <a href="{{ route('admin.skills.create') }}" class="px-5 py-2.5 gradient-primary text-white text-sm font-semibold rounded-xl hover:opacity-90 transition"><i class="fas fa-plus mr-2"></i>Add Skill</a>
</div>
<p class="text-sm text-gray-500 mb-8">Active skills fill the "The stack we work in" section on the homepage. With none active, the section falls back to a built-in list.</p>

<div class="glass rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead><tr class="border-b border-white/5">
            <th class="text-left p-4 text-gray-400 font-medium">Skill</th>
            <th class="text-left p-4 text-gray-400 font-medium">Status</th>
            <th class="text-left p-4 text-gray-400 font-medium">Order</th>
            <th class="text-right p-4 text-gray-400 font-medium">Actions</th>
        </tr></thead>
        <tbody>
            @forelse($skills as $skill)
            <tr class="border-b border-white/5 hover:bg-white/5 transition">
                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" style="background: {{ $skill->color }}1A; color: {{ $skill->color }};">
                            <i class="{{ $skill->icon ?: 'fas fa-cube' }} text-xs"></i>
                        </span>
                        <span class="font-medium text-white">{{ $skill->name }}</span>
                    </div>
                </td>
                <td class="p-4"><span class="px-2 py-1 rounded-full text-xs {{ $skill->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">{{ $skill->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td class="p-4 text-gray-400">{{ $skill->sort_order }}</td>
                <td class="p-4 text-right">
                    <a href="{{ route('admin.skills.edit', $skill) }}" class="text-primary-400 hover:text-primary-300 mr-3"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="inline" onsubmit="return confirm('Delete this skill?')">@csrf @method('DELETE')<button class="text-red-400 hover:text-red-300"><i class="fas fa-trash"></i></button></form>
                </td>
            </tr>
            @empty<tr><td colspan="4" class="p-8 text-center text-gray-400">No skills yet.</td></tr>@endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $skills->links() }}</div>
@endsection
