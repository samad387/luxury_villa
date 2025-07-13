@extends('layouts.app')

@section('title', 'Pack')

@section('content')

<!-- Image en haut avec texte centré -->
<section style="position: relative; width: 100%; height: 400px; overflow: hidden;">
    <img src="https://elitemarrakech.com/wp-content/uploads/2021/09/Marrakech_DarSayang_06.jpg" 
         alt="Pack de Luxe" 
         style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white;">
        <h2 style="font-size: 2.5rem; margin-bottom: 20px;">Nos Packs de Luxe à Marrakech</h2>
    </div>
</section>

<!-- Section des Packs -->
<section style="padding: 60px 20px; background-color: #f8f9fa;">
    <div class="pack-list" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; text-align: center;">

        <!-- Pack 1: Villa Luxe + Excursion Désert -->
        <div class="pack-item" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://elitemarrakech.com/wp-content/uploads/2021/09/Marrakech_DarSayang_06.jpg" alt="Pack 1" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Pack Séjour Luxe + Excursion Désert</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Séjour dans une villa de luxe avec excursion privée dans le désert d'Agafay.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- Pack 2: Villa de Luxe + Transfert Limousine -->
        <div class="pack-item" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://elitemarrakech.com/wp-content/uploads/2021/09/image_6483441-34.jpg" alt="Pack 2" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Pack Villa de Luxe + Transfert Limousine</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Séjour dans une villa haut de gamme avec transfert privé en limousine depuis l'aéroport.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- Pack 3: Golf + Détente -->
        <div class="pack-item" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://elitemarrakech.com/wp-content/uploads/2021/09/IMG-20170110-WA0092.jpg" alt="Pack 3" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Pack Golf + Détente</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Accès au parcours de golf de Marrakech et séjour relaxant dans une villa avec massage et soins.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- Pack 4: Villa + Moto Sport -->
        <div class="pack-item" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://elitemarrakech.com/wp-content/uploads/2021/09/IMG-20170110-WA0107.jpg" alt="Pack 4" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Pack Villa de Luxe + Moto Sport</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Séjour dans une villa exclusive avec location de motos sportives pour explorer Marrakech.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- Pack 5: Romance & Détente -->
        <div class="pack-item" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://elitemarrakech.com/wp-content/uploads/2021/09/Marrakech_DarSayang_06.jpg" alt="Pack 5" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Pack Romance & Détente</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Séjour romantique dans une villa luxueuse avec dîner aux chandelles et massage en couple.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- Pack 6: Séjour Culture + Visites Privées -->
        <div class="pack-item" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://elitemarrakech.com/wp-content/uploads/2021/09/Marrakech_DarSayang_06.jpg" alt="Pack 6" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Pack Culture & Visites Privées</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Explorez les sites emblématiques de Marrakech avec un guide privé et séjournez dans une villa de luxe.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- Pack 7: Villa + Hélicoptère -->
        <div class="pack-item" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://elitemarrakech.com/wp-content/uploads/2021/09/IMG-20170110-WA0092.jpg" alt="Pack 7" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Pack Villa + Hélicoptère</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Séjour dans une villa de luxe et excursion en hélicoptère pour découvrir Marrakech sous un autre angle.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- Pack 8: Villa de Luxe + Service VIP -->
        <div class="pack-item" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://elitemarrakech.com/wp-content/uploads/2021/09/Marrakech_DarSayang_06.jpg" alt="Pack 8" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Pack Villa de Luxe + Service VIP</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Service VIP complet avec concierge privé et hébergement dans une villa de luxe.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- Pack 9: Bien-être + Sérénité -->
        <div class="pack-item" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://elitemarrakech.com/wp-content/uploads/2021/09/IMG-20170110-WA0092.jpg" alt="Pack 9" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Pack Bien-être & Sérénité</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Séjour de bien-être avec spa privé, massages et soins du corps dans une villa de luxe.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

    </div>
</section>


@endsection
