@extends('layouts.admin')

@section('title')
    @if($type == 'moto')
        Manage Moto
    @elseif($type == 'voiture')
        Manage Voiture
    @elseif($type == 'vip')
        Manage VIP
    @else
        Manage Transports
    @endif
@endsection

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">
        @if($type == 'moto')
            Moto
        @elseif($type == 'voiture')
            Voiture
        @elseif($type == 'vip')
            VIP
        @else
            Transports
        @endif
    </h1>
    <a href="{{ route('admin.transports.create', ['type' => $type ?? 'voiture']) }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i>
        @if($type == 'moto')
            Add New Moto
        @elseif($type == 'voiture')
            Add New Voiture
        @elseif($type == 'vip')
            Add New VIP
        @else
            Add New Transport
        @endif
    </a>
</div>

@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
@endif

<div class="overflow-x-auto bg-white rounded shadow">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Image</th>
                <th class="px-4 py-2">Type</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Price</th>
                <th class="px-4 py-2">Capacity</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transports as $transport)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $transport->id }}</td>
                    <td class="px-4 py-2">
                        @if(method_exists($transport, 'images') && $transport->images && $transport->images->isNotEmpty())
                            <img src="{{ asset('storage/'.$transport->images->first()->path) }}" alt="{{ $transport->nom }}" class="w-16 h-12 object-cover rounded">
                        @elseif($transport->image)
                            <img src="{{ asset('storage/'.$transport->image) }}" alt="{{ $transport->nom }}" class="w-16 h-12 object-cover rounded">
                        @else
                            <span class="text-gray-400">Aucune</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 text-center">
                        @if($transport->type === 'moto')
                            <i class="fas fa-motorcycle text-xl text-orange-500" title="Moto"></i>
                        @elseif($transport->type === 'voiture')
                            <i class="fas fa-car-side text-xl text-blue-500" title="Voiture"></i>
                        @elseif($transport->type === 'vip')
                            <i class="fas fa-crown text-xl text-yellow-500" title="VIP"></i>
                        @else
                            <i class="fas fa-question text-xl text-gray-400" title="Type inconnu"></i>
                        @endif
                    </td>
                    <td class="px-4 py-2 font-semibold">{{ $transport->nom }}</td>
                    <td class="px-4 py-2">{{ $transport->prix ? number_format($transport->prix,2).' MAD' : '-' }}</td>
                    <td class="px-4 py-2">{{ $transport->capacity ?? '-' }}</td>
                    <td class="px-4 py-2 max-w-xs truncate">{{ Str::limit($transport->description, 60) }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('admin.transports.show', $transport) }}" title="Voir"><i class="fas fa-eye text-blue-600 hover:text-blue-800 text-lg"></i></a>
                        <a href="{{ route('admin.transports.edit', $transport) }}" title="Modifier"><i class="fas fa-edit text-purple-600 hover:text-purple-800 text-lg"></i></a>
                        <form action="{{ route('admin.transports.destroy', $transport) }}" method="POST" onsubmit="return confirm('Supprimer ce transport ?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; padding:0;" title="Supprimer"><i class="fas fa-trash text-red-600 hover:text-red-800 text-lg"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-6 text-gray-500">
                        @if($type == 'moto')
                            No moto found.
                        @elseif($type == 'voiture')
                            No voiture found.
                        @elseif($type == 'vip')
                            No VIP found.
                        @else
                            No transport found.
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $transports->withQueryString()->links() }}</div>
@endsection 