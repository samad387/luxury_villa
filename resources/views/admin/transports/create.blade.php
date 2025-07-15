@extends('layouts.admin')

@section('title')
    @if($type == 'moto')
        Add New Moto
    @elseif($type == 'voiture')
        Add New Voiture
    @elseif($type == 'vip')
        Add New VIP
    @else
        Add New Transport
    @endif
@endsection

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded shadow p-8 mt-6">
    <h2 class="text-2xl font-bold mb-6">
        @if($type == 'moto')
            Add New Moto
        @elseif($type == 'voiture')
            Add New Voiture
        @elseif($type == 'vip')
            Add New VIP
        @else
            Add New Transport
        @endif
    </h2>
    <form action="{{ route('admin.transports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        <input type="hidden" name="type" value="{{ $type ?? 'voiture' }}">
        <div>
            <label class="block mb-1 font-semibold">Name:</label>
            <input type="text" name="nom" class="w-full border rounded px-3 py-2" value="{{ old('nom') }}" required>
            @error('nom')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block mb-1 font-semibold">Price (MAD):</label>
            <input type="number" step="0.01" name="prix" class="w-full border rounded px-3 py-2" value="{{ old('prix') }}">
            @error('prix')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block mb-1 font-semibold">Capacity:</label>
            <input type="number" name="capacity" class="w-full border rounded px-3 py-2" value="{{ old('capacity') }}" min="1">
            @error('capacity')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block mb-1 font-semibold">Description:</label>
            <textarea name="description" class="w-full border rounded px-3 py-2" rows="4">{{ old('description') }}</textarea>
            @error('description')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block mb-1 font-semibold">Upload Images (Max 2MB chacune):</label>
            <input type="file" name="images[]" class="w-full border rounded px-3 py-2" multiple>
            @error('images')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
            @error('images.*')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="flex justify-end gap-3 mt-6">
            <a href="{{ route('admin.transports.index', ['type' => $type ?? 'voiture']) }}" class="px-5 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">Cancel</a>
            <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                @if($type == 'moto')
                    Create moto
                @elseif($type == 'voiture')
                    Create voiture
                @elseif($type == 'vip')
                    Create VIP
                @else
                    Create transport
                @endif
            </button>
        </div>
    </form>
</div>
@endsection 