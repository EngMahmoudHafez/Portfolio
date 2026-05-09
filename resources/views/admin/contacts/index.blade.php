@extends('layouts.admin')
@section('title', 'Messages')
@section('content')
<h1 class="text-2xl font-bold mb-8">Messages</h1>
<div class="glass rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead><tr class="border-b border-white/5">
            <th class="text-left p-4 text-gray-400 font-medium">From</th>
            <th class="text-left p-4 text-gray-400 font-medium">Subject</th>
            <th class="text-left p-4 text-gray-400 font-medium">Date</th>
            <th class="text-left p-4 text-gray-400 font-medium">Status</th>
            <th class="text-right p-4 text-gray-400 font-medium">Actions</th>
        </tr></thead>
        <tbody>
            @forelse($contacts as $c)
            <tr class="border-b border-white/5 hover:bg-white/5 transition {{ !$c->is_read ? 'bg-primary-500/5' : '' }}">
                <td class="p-4"><div class="font-medium text-white">{{ $c->name }}</div><div class="text-xs text-gray-400">{{ $c->email }}</div></td>
                <td class="p-4 text-gray-300">{{ $c->subject }}</td>
                <td class="p-4 text-gray-400 text-xs">{{ $c->created_at->diffForHumans() }}</td>
                <td class="p-4">
                    <form action="{{ route('admin.contacts.toggle-read', $c) }}" method="POST" class="inline">@csrf @method('PATCH')
                        <button class="px-2 py-1 rounded-full text-xs {{ $c->is_read ? 'bg-gray-500/20 text-gray-400' : 'bg-primary-500/20 text-primary-400' }}">{{ $c->is_read ? 'Read' : 'Unread' }}</button>
                    </form>
                </td>
                <td class="p-4 text-right">
                    <a href="{{ route('admin.contacts.show', $c) }}" class="text-primary-400 hover:text-primary-300 mr-3"><i class="fas fa-eye"></i></a>
                    <form action="{{ route('admin.contacts.destroy', $c) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="text-red-400 hover:text-red-300"><i class="fas fa-trash"></i></button></form>
                </td>
            </tr>
            @empty<tr><td colspan="5" class="p-8 text-center text-gray-400">No messages yet.</td></tr>@endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $contacts->links() }}</div>
@endsection
