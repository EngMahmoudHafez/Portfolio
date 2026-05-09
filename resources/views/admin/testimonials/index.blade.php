@extends('layouts.admin')
@section('title', 'Testimonials')
@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold">Testimonials</h1>
    <a href="{{ route('admin.testimonials.create') }}" class="px-5 py-2.5 gradient-primary text-white text-sm font-semibold rounded-xl hover:opacity-90 transition"><i class="fas fa-plus mr-2"></i>Add Testimonial</a>
</div>
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($testimonials as $t)
    <div class="glass rounded-2xl p-6">
        <div class="flex mb-2">@for($i=1;$i<=5;$i++)<i class="{{ $i <= $t->rating ? 'fas' : 'far' }} fa-star text-yellow-400 text-sm"></i>@endfor</div>
        <p class="text-gray-300 text-sm mb-4 line-clamp-3">{{ $t->content }}</p>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 gradient-primary rounded-full flex items-center justify-center text-white text-sm font-bold">{{ substr($t->client_name,0,1) }}</div>
            <div><div class="text-white text-sm font-medium">{{ $t->client_name }}</div><div class="text-gray-400 text-xs">{{ $t->client_position }}{{ $t->client_company ? ' at '.$t->client_company : '' }}</div></div>
        </div>
        <div class="flex gap-2 mt-4">
            <a href="{{ route('admin.testimonials.edit', $t) }}" class="px-3 py-1.5 glass rounded-lg text-primary-400 text-xs hover:bg-white/10 transition"><i class="fas fa-edit mr-1"></i>Edit</a>
            <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="px-3 py-1.5 glass rounded-lg text-red-400 text-xs hover:bg-red-500/10 transition"><i class="fas fa-trash mr-1"></i>Delete</button></form>
        </div>
    </div>
    @empty<div class="col-span-full text-center py-12 text-gray-400">No testimonials yet.</div>@endforelse
</div>
<div class="mt-6">{{ $testimonials->links() }}</div>
@endsection
