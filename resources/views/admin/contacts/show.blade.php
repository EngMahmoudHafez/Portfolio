@extends('layouts.admin')
@section('title', 'Message from ' . $contact->name)
@section('content')
<a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition mb-8"><i class="fas fa-arrow-left"></i> Back</a>
<div class="max-w-2xl glass rounded-2xl p-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">{{ $contact->subject }}</h1>
        <span class="px-3 py-1 rounded-full text-xs {{ $contact->is_read ? 'bg-gray-500/20 text-gray-400' : 'bg-primary-500/20 text-primary-400' }}">{{ $contact->is_read ? 'Read' : 'Unread' }}</span>
    </div>
    <div class="space-y-4 mb-6">
        <div class="flex gap-3"><span class="text-gray-400 w-20">From:</span><span class="text-white">{{ $contact->name }}</span></div>
        <div class="flex gap-3"><span class="text-gray-400 w-20">Email:</span><a href="mailto:{{ $contact->email }}" class="text-primary-400">{{ $contact->email }}</a></div>
        @if($contact->phone)<div class="flex gap-3"><span class="text-gray-400 w-20">Phone:</span><span class="text-white">{{ $contact->phone }}</span></div>@endif
        <div class="flex gap-3"><span class="text-gray-400 w-20">Date:</span><span class="text-white">{{ $contact->created_at->format('M d, Y H:i') }}</span></div>
    </div>
    <div class="border-t border-white/10 pt-6"><p class="text-gray-300 leading-relaxed">{{ $contact->message }}</p></div>
    <div class="flex gap-3 mt-6">
        <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="px-5 py-2.5 gradient-primary text-white text-sm font-semibold rounded-xl hover:opacity-90 transition"><i class="fas fa-reply mr-2"></i>Reply</a>
        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="px-5 py-2.5 glass text-red-400 text-sm rounded-xl hover:bg-red-500/10 transition"><i class="fas fa-trash mr-2"></i>Delete</button></form>
    </div>
</div>
@endsection
