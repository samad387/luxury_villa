@extends('layouts.app')

@section('title', 'Location Voiture de Prestige à Marrakech')

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
@forelse($voitures as $voiture)
    <div class="etablissement" onclick="window.location.href='{{ route('public.transport.show', $voiture) }}'">
        <div class="etablissement-image">
            @if($voiture->images && $voiture->images->isNotEmpty())
                <img src="{{ asset('storage/' . $voiture->images->first()->path) }}" alt="{{ $voiture->name }}">
            @elseif($voiture->image)
                <img src="{{ asset('storage/' . $voiture->image) }}" alt="{{ $voiture->name }}">
            @else
                <img src="https://via.placeholder.com/400x200?text=Voiture" alt="{{ $voiture->name }}">
            @endif
        </div>
        <div class="etablissement-content">
            <h3>{{ $voiture->name }}</h3>
            <p><strong>Prix :</strong> {{ $voiture->prix ? number_format($voiture->prix,2).' MAD' : '-' }}</p>
            <p><strong>Capacité :</strong> {{ $voiture->capacity ?? '-' }} personnes</p>
            <span class="btn">Voir Détails</span>
        </div>
    </div>
@empty
    <p>Aucune voiture disponible pour le moment.</p>
@endforelse
</div>
@endsection 