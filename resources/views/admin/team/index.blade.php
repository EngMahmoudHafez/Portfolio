@extends('layouts.admin')
@section('title', 'Team Members')
@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold">Team Members</h1>
    <a href="{{ route('admin.team.create') }}" class="px-5 py-2.5 gradient-primary text-white text-sm font-semibold rounded-xl hover:opacity-90 transition"><i class="fas fa-plus mr-2"></i>Add Member</a>
</div>
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($members as $m)
    <div class="glass rounded-2xl p-6 text-center">
        <div class="w-20 h-20 mx-auto mb-4 rounded-full overflow-hidden ring-2 ring-primary-500/30">
            @if($m->photo)<img src="{{ asset('storage/'.$m->photo) }}" alt="{{ $m->name }}" class="w-full h-full object-cover">
            @else<div class="w-full h-full gradient-primary flex items-center justify-center text-xl font-bold text-white">{{ substr($m->name,0,1) }}</div>@endif
        </div>
        <h3 class="text-white font-semibold">{{ $m->name }}</h3>
        <p class="text-primary-400 text-sm mb-3">{{ $m->position }}</p>
        <span class="px-2 py-1 rounded-full text-xs {{ $m->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">{{ $m->is_active ? 'Active' : 'Inactive' }}</span>
        <div class="flex justify-center gap-2 mt-4">
            <a href="{{ route('admin.team.edit', $m) }}" class="px-3 py-1.5 glass rounded-lg text-primary-400 text-xs hover:bg-white/10 transition"><i class="fas fa-edit mr-1"></i>Edit</a>
            <form action="{{ route('admin.team.destroy', $m) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
                <button class="px-3 py-1.5 glass rounded-lg text-red-400 text-xs hover:bg-red-500/10 transition"><i class="fas fa-trash mr-1"></i>Delete</button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12 text-gray-400">No team members yet.</div>
    @endforelse
</div>
<div class="mt-6">{{ $members->links() }}</div>
@endsection
