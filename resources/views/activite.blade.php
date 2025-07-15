@extends('layouts.app')

@section('title', 'Activités & Services de Conciergerie de Luxe')

@section('content')
<style>
    .hero-activite {
        background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80') center/cover no-repeat;
        color: #fff;
        padding: 80px 0 40px 0;
        text-align: center;
    }
    .hero-activite h1 {
        font-size: 2.7rem;
        font-weight: bold;
        margin-bottom: 1rem;
        letter-spacing: 1px;
    }
    .hero-activite p {
        font-size: 1.2rem;
        max-width: 600px;
        margin: 0 auto;
        opacity: 0.95;
    }
    .services-section {
        background: #f8f6f3;
        padding: 60px 0 30px 0;
    }
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 32px;
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 16px;
    }
    .service-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.07);
        padding: 36px 24px 28px 24px;
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
        border: 1px solid #ececec;
    }
    .service-card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 8px 32px rgba(166,124,82,0.13);
        border-color: #A67C52;
    }
    .service-card .icon {
        font-size: 2.7rem;
        color: #A67C52;
        margin-bottom: 18px;
    }
    .service-card h3 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: #2c2c2c;
    }
    .service-card p {
        font-size: 1rem;
        color: #666;
        margin-bottom: 0;
    }
    .cta-section {
        background: #fff;
        padding: 40px 0 60px 0;
        text-align: center;
    }
    .cta-section h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 18px;
        color: #A67C52;
    }
    .cta-section p {
        font-size: 1.1rem;
        margin-bottom: 24px;
        color: #444;
    }
    .cta-btn {
        background: #A67C52;
        color: #fff;
        padding: 14px 38px;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 600;
        border: none;
        transition: background 0.2s;
        text-decoration: none;
        display: inline-block;
    }
    .cta-btn:hover {
        background: #8B643E;
        color: #fff;
    }
    @media (max-width: 600px) {
        .hero-activite h1 { font-size: 2rem; }
        .services-section { padding: 30px 0 10px 0; }
        .service-card { padding: 24px 10px 18px 10px; }
        .cta-section { padding: 24px 0 30px 0; }
        .cta-section h2 { font-size: 1.3rem; }
    }
</style>

<div class="hero-activite">
    <h1>Conciergerie de Luxe & Activités Exclusives</h1>
    <p>
        Offrez-vous l’excellence : notre conciergerie vous ouvre les portes des expériences les plus exclusives à Marrakech. Profitez d’un accompagnement sur-mesure, 24h/24, pour tous vos désirs et besoins.
    </p>
</div>

<section class="services-section">
    <div class="services-grid">
        <div class="service-card">
            <div class="icon">🛎️</div>
            <h3>Service de Conciergerie 24/7</h3>
            <p>Réservations, organisation de séjours, gestion d’imprévus : un assistant personnel à votre écoute à tout moment.</p>
        </div>
        <div class="service-card">
            <div class="icon">🚗</div>
            <h3>Transferts & Chauffeur Privé</h3>
            <p>Transferts aéroport, mise à disposition de véhicules de prestige, chauffeurs professionnels et discrets.</p>
        </div>
        <div class="service-card">
            <div class="icon">🍽️</div>
            <h3>Réservations Gastronomiques</h3>
            <p>Tables dans les meilleurs restaurants, chefs privés, expériences culinaires uniques à domicile ou à l’extérieur.</p>
        </div>
        <div class="service-card">
            <div class="icon">🎟️</div>
            <h3>Accès VIP & Événements</h3>
            <p>Entrées exclusives pour soirées, clubs, festivals, événements sportifs ou culturels, organisation sur-mesure.</p>
        </div>
        <div class="service-card">
            <div class="icon">💆‍♀️</div>
            <h3>Bien-être & Spa</h3>
            <p>Massages, soins, coachs sportifs, yoga, beauté : profitez des meilleurs professionnels à domicile ou en spa.</p>
        </div>
        <div class="service-card">
            <div class="icon">🏜️</div>
            <h3>Expériences & Excursions</h3>
            <p>Balades en montgolfière, excursions dans le désert, golf, activités sportives, découvertes culturelles…</p>
        </div>
    </div>
</section>

<section class="cta-section">
    <h2>Un désir, une envie ? Nous réalisons l’impossible.</h2>
    <p>Contactez notre équipe de concierges pour un accompagnement personnalisé et une réponse immédiate à toutes vos demandes.</p>
    <a href="{{ route('contact') }}" class="cta-btn">Contactez-nous</a>
</section>
@endsection
