@extends('layouts.app')

@section('title', $activity->nom)

@section('content')
<div class="container mx-auto px-4 py-6">
    <a href="{{ route('admin.activities.index') }}" class="text-blue-600">← Retour</a>
    <h1 class="text-3xl font-bold mb-4">{{ $activity->nom }}</h1>
    <p class="mb-2"><strong>Catégorie:</strong> {{ $activity->category ?? '-' }}</p>
    <p class="mb-2"><strong>Prix:</strong> {{ $activity->prix ? number_format($activity->prix,2).' MAD' : '-' }}</p>
    <p class="mb-4">{{ $activity->description }}</p>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        @foreach(($activity->images ?? []) as $img)
            <img src="{{ asset('storage/'.$img->path) }}" class="w-full h-40 object-cover rounded" alt="{{ $activity->nom }}">
        @endforeach
    </div>
</div>
@endsection











