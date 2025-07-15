@extends('layouts.admin')

@section('title', 'Modifier un Transport')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded shadow p-6">
    <h1 class="text-xl font-bold mb-4">Modifier un Transport</h1>
    <form action="{{ route('admin.transports.update', $transport) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block mb-1 font-semibold">Catégorie</label>
            <select name="type" class="w-full border rounded px-3 py-2" required>
                <option value="voiture" @if(old('type', $transport->type)=='voiture') selected @endif>Location Voiture</option>
                <option value="moto" @if(old('type', $transport->type)=='moto') selected @endif>Location Moto</option>
                <option value="vip" @if(old('type', $transport->type)=='vip') selected @endif>VIP Transport</option>
            </select>
            @error('type')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block mb-1 font-semibold">Nom</label>
            <input type="text" name="nom" class="w-full border rounded px-3 py-2" value="{{ old('nom', $transport->nom) }}" required>
            @error('nom')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block mb-1 font-semibold">Capacity:</label>
            <input type="number" name="capacity" class="w-full border rounded px-3 py-2" value="{{ old('capacity', $transport->capacity) }}" min="1">
            @error('capacity')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block mb-1 font-semibold">Description</label>
            <textarea name="description" class="w-full border rounded px-3 py-2" rows="3">{{ old('description', $transport->description) }}</textarea>
            @error('description')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block mb-1 font-semibold">Prix (MAD)</label>
            <input type="number" step="0.01" name="prix" class="w-full border rounded px-3 py-2" value="{{ old('prix', $transport->prix) }}">
            @error('prix')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block mb-1 font-semibold">Images actuelles</label>
            <div class="flex gap-2 mb-2 flex-wrap">
                @if(method_exists($transport, 'images') && $transport->images && $transport->images->isNotEmpty())
                    @foreach($transport->images as $img)
                        <img src="{{ asset('storage/'.$img->path) }}" alt="Image" class="w-24 h-16 object-cover rounded">
                    @endforeach
                @elseif($transport->image)
                    <img src="{{ asset('storage/'.$transport->image) }}" alt="Image actuelle" class="w-24 h-16 object-cover rounded">
                @else
                    <span class="text-gray-400">Aucune image</span>
                @endif
            </div>
            <label class="block mb-1 font-semibold">Ajouter de nouvelles images</label>
            <input type="file" name="images[]" class="w-full border rounded px-3 py-2" multiple>
            @error('images')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
            @error('images.*')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="flex justify-end mt-6">
            <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-lg font-semibold rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                <i class="fas fa-save mr-2"></i> Mettre à jour le transport
            </button>
        </div>
    </form>
</div>
@endsection 