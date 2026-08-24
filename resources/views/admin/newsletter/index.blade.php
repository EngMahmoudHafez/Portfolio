@extends('layouts.admin')
@section('title', 'Newsletter')
@section('content')
<div class="flex items-center justify-between mb-2">
    <h1 class="text-2xl font-bold">Newsletter</h1>
    <a href="{{ route('admin.newsletter.export') }}" class="px-5 py-2.5 glass text-gray-200 text-sm font-semibold rounded-xl hover:bg-white/10 transition"><i class="fas fa-download mr-2"></i>Export CSV</a>
</div>
<p class="text-sm text-gray-500 mb-8">
    {{ $activeCount }} active of {{ $totalCount }} total. Subscribers come from the form in the site footer.
</p>

<form action="{{ route('admin.newsletter.index') }}" method="GET" class="flex gap-2 mb-6 max-w-md">
    <label for="newsletter-search" class="sr-only">Search subscribers</label>
    <input id="newsletter-search" type="search" name="search" value="{{ $search ?? '' }}" placeholder="Search by email…" class="flex-1 px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent">
    <button type="submit" class="px-4 py-2.5 gradient-primary rounded-xl text-white text-sm"><i class="fas fa-search"></i></button>
    @if($search ?? null)
        <a href="{{ route('admin.newsletter.index') }}" class="px-4 py-2.5 glass rounded-xl text-gray-300 text-sm hover:bg-white/10 transition">Clear</a>
    @endif
</form>

<div class="glass rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead><tr class="border-b border-white/5">
            <th class="text-left p-4 text-gray-400 font-medium">Email</th>
            <th class="text-left p-4 text-gray-400 font-medium">Subscribed</th>
            <th class="text-left p-4 text-gray-400 font-medium">Status</th>
            <th class="text-right p-4 text-gray-400 font-medium">Actions</th>
        </tr></thead>
        <tbody>
            @forelse($subscribers as $subscriber)
            <tr class="border-b border-white/5 hover:bg-white/5 transition">
                <td class="p-4 text-white">{{ $subscriber->email }}</td>
                <td class="p-4 text-gray-400 text-xs">{{ $subscriber->created_at->format('M d, Y') }}</td>
                <td class="p-4">
                    <form action="{{ route('admin.newsletter.toggle', $subscriber) }}" method="POST" class="inline">@csrf @method('PATCH')
                        <button class="px-2 py-1 rounded-full text-xs {{ $subscriber->is_active ? 'bg-green-500/20 text-green-400' : 'bg-gray-500/20 text-gray-400' }}">
                            {{ $subscriber->is_active ? 'Active' : 'Unsubscribed' }}
                        </button>
                    </form>
                </td>
                <td class="p-4 text-right">
                    <form action="{{ route('admin.newsletter.destroy', $subscriber) }}" method="POST" class="inline" onsubmit="return confirm('Remove this subscriber permanently?')">@csrf @method('DELETE')<button class="text-red-400 hover:text-red-300"><i class="fas fa-trash"></i></button></form>
                </td>
            </tr>
            @empty<tr><td colspan="4" class="p-8 text-center text-gray-400">{{ ($search ?? null) ? 'No subscriber matches that search.' : 'No subscribers yet.' }}</td></tr>@endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $subscribers->links() }}</div>
@endsection
