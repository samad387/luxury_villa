@extends('layouts.admin')

@section('title')
    Transport Details: {{ $transport->nom }}
@endsection

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">
        @if($transport->type === 'moto')
            Moto:
        @elseif($transport->type === 'voiture')
            Voiture:
        @elseif($transport->type === 'vip')
            VIP:
        @else
            Transport:
        @endif
        <span class="text-indigo-700">{{ $transport->nom }}</span>
    </h1>
    <div class="flex gap-2">
        <a href="{{ route('admin.transports.edit', $transport) }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition flex items-center gap-2"><i class="fas fa-edit"></i> Edit</a>
        <form action="{{ route('admin.transports.destroy', $transport) }}" method="POST" onsubmit="return confirm('Supprimer ce transport ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition flex items-center gap-2"><i class="fas fa-trash"></i> Delete</button>
        </form>
        <a href="{{ route('admin.transports.index', ['type' => $transport->type]) }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition flex items-center gap-2"><i class="fas fa-arrow-left"></i> Back to List</a>
    </div>
</div>
<div class="bg-white rounded shadow p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
            <h2 class="text-xl font-semibold mb-4">Details</h2>
            <div class="mb-2"><strong>Price:</strong> {{ $transport->prix ? number_format($transport->prix,2).' MAD' : '-' }}</div>
            <div class="mb-2"><strong>Capacity:</strong> {{ $transport->capacity ?? '-' }} people</div>
            <div class="mb-2"><strong>Description:</strong> {{ $transport->description ?? '-' }}</div>
            <div class="mb-2"><strong>Type:</strong> {{ ucfirst($transport->type) }}</div>
            <div class="mb-2"><strong>Geo-Emplacement:</strong> {{ $transport->geo_emplacement ?? 'N/A' }}</div>
            <div class="mb-2"><strong>Created At:</strong> {{ $transport->created_at->format('M d, Y H:i') }}</div>
            <div class="mb-2"><strong>Last Updated:</strong> {{ $transport->updated_at->format('M d, Y H:i') }}</div>
        </div>
        <div>
            <h2 class="text-xl font-semibold mb-4">Images</h2>
            <div class="flex flex-wrap gap-3">
                @if(method_exists($transport, 'images') && $transport->images && $transport->images->isNotEmpty())
                    @foreach($transport->images as $img)
                        <img src="{{ asset('storage/'.$img->path) }}" alt="Image" class="w-32 h-20 object-cover rounded">
                    @endforeach
                @elseif($transport->image)
                    <img src="{{ asset('storage/'.$transport->image) }}" alt="Image" class="w-32 h-20 object-cover rounded">
                @else
                    <span class="text-gray-400">Aucune image</span>
                @endif
            </div>
        </div>
    </div>
    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-2">Location on Map</h2>
        @if($transport->geo_emplacement && $transport->coordinates)
            <div id="mapid" style="width:100%; height:300px; border-radius:12px;"></div>
        @else
            <div class="text-gray-500">No geographical location provided for this transport to display on a map.</div>
        @endif
    </div>
</div>
@endsection 