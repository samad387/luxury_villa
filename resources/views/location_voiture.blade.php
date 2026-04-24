@extends('layouts.app')

@section('title', 'Location Voiture de Prestige à Marrakech')

@section('content')
<!-- Hero Section -->
<section style="position: relative; width: 100%; height: 450px; overflow: hidden;">
    <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=1200&q=80"
         alt="Voiture de Prestige"
         style="width: 100%; height: 100%; object-fit: cover; filter: brightness(70%);">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: #fff;">
        <h1 style="font-size: 3rem; font-weight: bold; text-shadow: 0 0 10px rgba(0,0,0,0.7);">
            Location Voiture de Prestige
        </h1>
        <p style="font-size: 1.2rem; margin-top: 1rem; text-shadow: 0 0 10px rgba(0,0,0,0.7);">
            Découvrez notre flotte de véhicules haut de gamme
        </p>
    </div>
</section>

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
        width: 100%;
        text-align: center;
        box-sizing: border-box;
    }
    .btn:hover {
        background-color: #2563eb;
    }

    @media (max-width: 768px) {
        .etablissement-grid {
            grid-template-columns: 1fr !important;
            gap: 20px !important;
            padding: 30px 15px !important;
        }
        .etablissement {
            border-radius: 12px !important;
            box-shadow: 0 6px 16px rgba(0,0,0,0.1) !important;
        }
        .etablissement-image img {
            height: 220px !important;
            border-radius: 12px 12px 0 0 !important;
        }
        .etablissement-content {
            padding: 16px !important;
        }
        .etablissement h3 {
            font-size: 1.15rem !important;
            margin-bottom: 8px !important;
            font-weight: 600 !important;
        }
        .etablissement p {
            font-size: 0.95rem !important;
            margin-bottom: 6px !important;
            line-height: 1.5 !important;
        }
        .btn {
            padding: 12px 0 !important;
            font-size: 1rem !important;
            margin-top: 12px !important;
            border-radius: 8px !important;
        }
        section[style*='height: 450px'] {
            height: 200px !important;
        }
        section[style*='height: 450px'] h1 {
            font-size: 1.4rem !important;
            padding: 0 15px !important;
            line-height: 1.3 !important;
        }
        section[style*='height: 450px'] p {
            font-size: 1rem !important;
            margin-top: 0.5rem !important;
        }
    }

    @media (max-width: 480px) {
        .etablissement-grid {
            gap: 16px !important;
            padding: 20px 12px !important;
        }
        .etablissement {
            border-radius: 10px !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
        }
        .etablissement-image img {
            height: 200px !important;
            border-radius: 10px 10px 0 0 !important;
        }
        .etablissement-content {
            padding: 14px !important;
        }
        .etablissement h3 {
            font-size: 1.1rem !important;
            margin-bottom: 6px !important;
        }
        .etablissement p {
            font-size: 0.9rem !important;
            margin-bottom: 5px !important;
        }
        .btn {
            padding: 11px 0 !important;
            font-size: 0.95rem !important;
            margin-top: 10px !important;
        }
        section[style*='height: 450px'] {
            height: 180px !important;
        }
        section[style*='height: 450px'] h1 {
            font-size: 1.2rem !important;
            padding: 0 12px !important;
        }
        section[style*='height: 450px'] p {
            font-size: 0.9rem !important;
            display: none !important;
        }
    }

    @media (max-width: 360px) {
        .etablissement-grid {
            gap: 14px !important;
            padding: 16px 10px !important;
        }
        .etablissement-image img {
            height: 180px !important;
        }
        .etablissement-content {
            padding: 12px !important;
        }
        .etablissement h3 {
            font-size: 1.05rem !important;
        }
        .etablissement p {
            font-size: 0.88rem !important;
        }
        section[style*='height: 450px'] {
            height: 160px !important;
        }
        section[style*='height: 450px'] h1 {
            font-size: 1.1rem !important;
        }
    }
</style>
<div class="etablissement-grid">
@forelse($voitures as $voiture)
    <div class="etablissement" onclick="window.location.href='{{ route('public.transport.show', $voiture) }}'">
        <div class="etablissement-image">
            @if($voiture->images && $voiture->images->isNotEmpty())
                <img src="{{ asset('storage/' . $voiture->images->first()->path) }}" alt="{{ $voiture->nom }}">
            @elseif($voiture->image)
                <img src="{{ asset('storage/' . $voiture->image) }}" alt="{{ $voiture->nom }}">
            @else
                <img src="https://via.placeholder.com/400x200?text=Voiture" alt="{{ $voiture->nom }}">
            @endif
        </div>
        <div class="etablissement-content">
            <h3>{{ $voiture->nom }}</h3>
            <p><strong>Prix :</strong> {{ $voiture->prix ? number_format($voiture->prix,2).' MAD' : '-' }}</p>
            <p><strong>Capacité :</strong> {{ $voiture->capacity ?? '-' }} personnes</p>
            <span class="btn">Voir Détails</span>
        </div>
    </div>
@empty
    <p style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #666;">Aucune voiture disponible pour le moment.</p>
@endforelse
</div>
@endsection
