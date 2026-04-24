@extends('layouts.app')

@section('title', 'Activités de Prestige à Marrakech')

@section('content')
<style>
    .etablissement-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
        padding: 60px 20px;
        background-color: #f4f3f2;
    }
    .etablissement {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        transition: transform 0.3s;
        cursor: pointer;
    }
    .etablissement:hover {
        transform: translateY(-5px);
    }
    .etablissement-image {
        overflow: hidden;
    }
    .etablissement-image img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .etablissement:hover .etablissement-image img {
        transform: scale(1.1);
    }
    .etablissement-content {
        padding: 20px;
        text-align: left;
    }
    .etablissement h3 {
        font-size: 1.2rem;
        color: #2c2c2c;
        margin-bottom: 10px;
    }
    .etablissement p {
        font-size: 0.95rem;
        color: #555;
    }
    .btn {
        display: inline-block;
        margin-top: 15px;
        background-color: #3b82f6;
        color: #fff;
        padding: 10px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
    }
    .btn:hover {
        background-color: #2563eb;
    }
</style>
<div class="etablissement-grid">
@forelse($activities as $activity)
    <div class="etablissement" onclick="window.location.href='{{ route('public.activities.show', $activity) }}'">
        <div class="etablissement-image">
            @if($activity->images && $activity->images->isNotEmpty())
                <img src="{{ asset('storage/' . $activity->images->first()->path) }}" alt="{{ $activity->nom }}">
            @elseif($activity->image)
                <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->nom }}">
            @else
                <img src="https://via.placeholder.com/400x200?text=Activit%C3%A9" alt="{{ $activity->nom }}">
            @endif
</div>
        <div class="etablissement-content">
                <h3>{{ $activity->nom }}</h3>
            <p><strong>Prix :</strong> {{ $activity->prix ? number_format($activity->prix,2).' MAD' : '-' }}</p>
            <p><strong>Catégorie :</strong> {{ $activity->category ?? '-' }}</p>
            <span class="btn">Voir Détails</span>
        </div>
            </div>
        @empty
    <p>Aucune activité disponible pour le moment.</p>
        @endforelse
    </div>
@endsection
