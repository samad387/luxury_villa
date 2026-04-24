@extends('layouts.app')

@section('title', 'Yachts - Keys Royal Marrakech')

@section('content')
<!-- Hero Section -->
<section style="position: relative; width: 100%; height: 400px; overflow: hidden; margin-bottom: 60px;">
    <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=1920" 
         alt="Yacht" 
         style="width: 100%; height: 100%; object-fit: cover; filter: brightness(60%);">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: #fff;">
        <h1 style="font-size: 3rem; font-weight: bold; text-shadow: 0 0 10px rgba(0,0,0,0.7); margin-bottom: 20px;">
            ⛵ Yachts
        </h1>
        <p style="font-size: 1.2rem; text-shadow: 0 0 10px rgba(0,0,0,0.7);">
            Naviguez dans le luxe et l'élégance
        </p>
    </div>
</section>

<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
    @if($yachts->isEmpty())
        <div class="text-center py-12" style="background: #f9f9f9; border-radius: 12px; padding: 60px 20px;">
            <h2 style="font-size: 1.8rem; color: #333; margin-bottom: 20px;">Aucun yacht disponible pour le moment</h2>
            <p style="color: #666; font-size: 1.1rem;">Nous mettons à jour notre flotte. Revenez bientôt !</p>
        </div>
    @else
        <div class="row" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px; margin-bottom: 60px;">
            @foreach($yachts as $yacht)
                <div class="yacht-card" onclick="window.location.href='{{ route('yacht.show', $yacht) }}'" style="cursor: pointer; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                    @if($yacht->images->isNotEmpty())
                        <div style="width: 100%; height: 250px; overflow: hidden;">
                            <img src="{{ asset('storage/'.$yacht->images->first()->path) }}" 
                                 alt="{{ $yacht->name }}"
                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
                        </div>
                    @elseif($yacht->image)
                        <div style="width: 100%; height: 250px; overflow: hidden;">
                            <img src="{{ asset('storage/'.$yacht->image) }}" 
                                 alt="{{ $yacht->name }}"
                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
                        </div>
                    @else
                        <div style="width: 100%; height: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-ship" style="font-size: 4rem; color: white; opacity: 0.5;"></i>
                        </div>
                    @endif

                    <div style="padding: 25px;">
                        <h3 style="font-size: 1.4rem; font-weight: 600; color: #2c2c2c; margin-bottom: 15px;">
                            {{ $yacht->name }}
                        </h3>
                        
                        <div style="margin-bottom: 12px;">
                            <span style="color: #666; font-size: 0.95rem;">👥 Capacité :</span>
                            <span style="font-weight: 600; color: #333;">{{ $yacht->capacity }} passagers</span>
                        </div>
                        
                        @if($yacht->length_meters)
                        <div style="margin-bottom: 12px;">
                            <span style="color: #666; font-size: 0.95rem;">📏 Longueur :</span>
                            <span style="font-weight: 600; color: #333;">{{ number_format($yacht->length_meters, 1) }} m</span>
                        </div>
                        @endif
                        
                        <div style="margin-bottom: 20px;">
                            <span style="color: #666; font-size: 0.95rem;">💰 Prix :</span>
                            <span style="font-size: 1.3rem; font-weight: 700; color: #A67C52;">
                                {{ number_format($yacht->price_per_day, 0, ',', ' ') }} MAD/jour
                            </span>
                        </div>

                        <a href="{{ route('yacht.show', $yacht) }}" 
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
    .yacht-card:hover {
        transform: translateY(-8px);
    }
    
    .yacht-card:hover img {
        transform: scale(1.1);
    }
    
    .yacht-card a:hover {
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

