@extends('layouts.admin')
@section('title', 'Services')
@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold">Services</h1>
    <a href="{{ route('admin.services.create') }}" class="px-5 py-2.5 gradient-primary text-white text-sm font-semibold rounded-xl hover:opacity-90 transition"><i class="fas fa-plus mr-2"></i>Add Service</a>
</div>
<div class="glass rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead><tr class="border-b border-white/5">
            <th class="text-left p-4 text-gray-400 font-medium">Service</th>
            <th class="text-left p-4 text-gray-400 font-medium">Icon</th>
            <th class="text-left p-4 text-gray-400 font-medium">Status</th>
            <th class="text-left p-4 text-gray-400 font-medium">Order</th>
            <th class="text-right p-4 text-gray-400 font-medium">Actions</th>
        </tr></thead>
        <tbody>
            @forelse($services as $service)
            <tr class="border-b border-white/5 hover:bg-white/5 transition">
                <td class="p-4"><div class="font-medium text-white">{{ $service->title }}</div><div class="text-xs text-gray-400 mt-0.5">{{ Str::limit($service->description, 50) }}</div></td>
                <td class="p-4"><i class="{{ $service->icon ?? 'fas fa-code' }}" style="color:{{ $service->icon_color }}"></i></td>
                <td class="p-4"><span class="px-2 py-1 rounded-full text-xs {{ $service->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">{{ $service->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td class="p-4 text-gray-400">{{ $service->sort_order }}</td>
                <td class="p-4 text-right">
                    <a href="{{ route('admin.services.edit', $service) }}" class="text-primary-400 hover:text-primary-300 mr-3"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline" onsubmit="return confirm('Delete this service?')">@csrf @method('DELETE')
                        <button class="text-red-400 hover:text-red-300"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="p-8 text-center text-gray-400">No services yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $services->links() }}</div>
@endsection
