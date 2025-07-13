@extends('layouts.app')

@section('title', 'Activités')

@section('content')

<!-- Image en haut avec texte centré -->
<section style="position: relative; width: 100%; height: 400px; overflow: hidden;">
    <img src="https://www.tarik-excursions.com/wp-content/uploads/2018/07/excursion-marrakech.jpg" 
         alt="Activités à Marrakech" 
         style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white;">
        <h2 style="font-size: 2.5rem; margin-bottom: 20px;">Découvrez Nos Activités à Marrakech</h2>
    </div>
</section>

<!-- Section des Activités -->
<section style="padding: 60px 20px; background-color: #f8f9fa;">
    <div class="activity-list" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; text-align: center;">

        <!-- Activité 1 -->
        <div class="activity-item" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://www.marrakech-desert-trips.com/wp-content/uploads/2023/07/Marrakech-to-Fes-desert-tour-3-days-900x500.jpg" alt="Activité 1" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Excursion dans le Désert</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Vivez une aventure inoubliable avec une excursion dans le désert de Marrakech.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- Activité 2 -->
        <div class="activity-item" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://villatajmarrakech.com/wp-content/uploads/2022/05/un-chemin-dans-un-souk-debordant-de-souvenirs-artisanaux-a-marrakech.jpg" alt="Activité 2" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Visite des Souks</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Explorez les souks traditionnels de Marrakech et découvrez des trésors uniques.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- Activité 3 -->
        <div class="activity-item" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://darrbatia.com/wp-content/uploads/aaa.jpg" alt="Activité 3" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Dîner Traditionnel Marocain</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Savourez les délices de la cuisine marocaine avec un dîner traditionnel dans un cadre somptueux.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- Activité 4 -->
        <div class="activity-item" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://www.cieldafrique.info/theme/assets/img/ballooningmarrakech.jpg" alt="Activité 4" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Balade en Montgolfière</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Vivez l'expérience magique d'une balade en montgolfière au-dessus des paysages de Marrakech.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- Activité 5 -->
        <div class="activity-item" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2b/ae/5d/01/caption.jpg?w=500&h=400&s=1" alt="Activité 5" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Atelier de Cuisine Marocaine</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Apprenez à préparer des plats traditionnels marocains dans un atelier pratique avec un chef local.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- Activité 6 -->
        <div class="activity-item" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://www.nordiquefrance.com/wp-content/uploads/2020/05/COMMENT-CRÉER-UN-ESPACE-BIEN-ÊTRE-CHEZ-SOI-1-1024x670.jpeg" alt="Activité 6" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Spa et Bien-être</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Détendez-vous dans un spa de luxe avec des soins traditionnels marocains.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- Activité 7 -->
        <div class="activity-item" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://camelridemarrakech.com/wp-content/uploads/2024/02/Camel-ride-Marrakech-.jpg" alt="Activité 7" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Randonnée à dos de Chameau</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Explorez les dunes du désert en empruntant un chameau pour une expérience unique.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- Activité 8 -->
        <div class="activity-item" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://usercontent.one/wp/www.carhirealbir.com/wp-content/uploads/2024/01/mick-haupt-m0iXio5FF7M-unsplash.jpg" alt="Activité 8" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Royal Golf Club</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Profitez d'une journée de golf dans l'un des plus beaux parcours de Marrakech.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- Activité 9 -->
        <div class="activity-item" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/12/18/05/09.jpg" alt="Activité 9" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Visite des Jardins Majorelle</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Découvrez les magnifiques jardins Majorelle et explorez la culture marocaine.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

    </div>
</section>
@endsection
