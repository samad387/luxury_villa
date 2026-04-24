@extends('layouts.app')

@section('title', 'Jets Privés - Keys Royal Marrakech')

@section('content')
<!-- Hero Section -->
<section style="position: relative; width: 100%; height: 400px; overflow: hidden; margin-bottom: 60px;">
    <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1920" 
         alt="Jet Privé" 
         style="width: 100%; height: 100%; object-fit: cover; filter: brightness(60%);">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: #fff;">
        <h1 style="font-size: 3rem; font-weight: bold; text-shadow: 0 0 10px rgba(0,0,0,0.7); margin-bottom: 20px;">
            ✈️ Jets Privés
        </h1>
        <p style="font-size: 1.2rem; text-shadow: 0 0 10px rgba(0,0,0,0.7);">
            Voyagez dans le luxe et le confort absolu
        </p>
    </div>
</section>

<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
    @if($jets->isEmpty())
        <div class="text-center py-12" style="background: #f9f9f9; border-radius: 12px; padding: 60px 20px;">
            <h2 style="font-size: 1.8rem; color: #333; margin-bottom: 20px;">Aucun jet disponible pour le moment</h2>
            <p style="color: #666; font-size: 1.1rem;">Nous mettons à jour notre flotte. Revenez bientôt !</p>
        </div>
    @else
        <div class="row" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px; margin-bottom: 60px;">
            @foreach($jets as $jet)
                <div class="jet-card" onclick="window.location.href='{{ route('jet.show', $jet) }}'" style="cursor: pointer; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                    @if($jet->images->isNotEmpty())
                        <div style="width: 100%; height: 250px; overflow: hidden;">
                            <img src="{{ asset('storage/'.$jet->images->first()->path) }}" 
                                 alt="{{ $jet->name }}"
                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
                        </div>
                    @elseif($jet->image)
                        <div style="width: 100%; height: 250px; overflow: hidden;">
                            <img src="{{ asset('storage/'.$jet->image) }}" 
                                 alt="{{ $jet->name }}"
                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
                        </div>
                    @else
                        <div style="width: 100%; height: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-plane" style="font-size: 4rem; color: white; opacity: 0.5;"></i>
                        </div>
                    @endif

                    <div style="padding: 25px;">
                        <h3 style="font-size: 1.4rem; font-weight: 600; color: #2c2c2c; margin-bottom: 15px;">
                            {{ $jet->name }}
                        </h3>
                        
                        <div style="margin-bottom: 12px;">
                            <span style="color: #666; font-size: 0.95rem;">👥 Capacité :</span>
                            <span style="font-weight: 600; color: #333;">{{ $jet->capacity }} passagers</span>
                        </div>
                        
                        @if($jet->range_km)
                        <div style="margin-bottom: 12px;">
                            <span style="color: #666; font-size: 0.95rem;">✈️ Autonomie :</span>
                            <span style="font-weight: 600; color: #333;">{{ number_format($jet->range_km, 0, ',', ' ') }} km</span>
                        </div>
                        @endif
                        
                        <div style="margin-bottom: 20px;">
                            <span style="color: #666; font-size: 0.95rem;">💰 Prix :</span>
                            <span style="font-size: 1.3rem; font-weight: 700; color: #A67C52;">
                                {{ number_format($jet->price_per_hour, 0, ',', ' ') }} €/heure
                            </span>
                        </div>

                        <a href="{{ route('jet.show', $jet) }}" 
                           style="display: block; text-align: center; background: linear-gradient(135deg, #A67C52 0%, #8B643E 100%); color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: transform 0.2s ease;">
                            Voir détails
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .jet-card:hover {
        transform: translateY(-8px);
    }
    
    .jet-card:hover img {
        transform: scale(1.1);
    }
    
    .jet-card a:hover {
        transform: scale(1.02);
    }
    
    @media (max-width: 768px) {
        .row {
            grid-template-columns: 1fr !important;
            gap: 20px !important;
        }
    }
</style>
@endsection
