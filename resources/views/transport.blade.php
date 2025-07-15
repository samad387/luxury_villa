@extends('layouts.app')

@section('title', 'Transport de Luxe & Location à Marrakech')

@section('content')
<style>
    .transport-hero {
        background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1511918984145-48de785d4c4e?auto=format&fit=crop&w=1200&q=80') center/cover no-repeat;
        color: #fff;
        padding: 70px 0 40px 0;
        text-align: center;
    }
    .transport-hero h1 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }
    .transport-hero p {
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
        opacity: 0.95;
    }
    .transport-categories {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
        gap: 32px;
        max-width: 1000px;
        margin: 0 auto;
        padding: 50px 16px 30px 16px;
    }
    .category-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.07);
        padding: 36px 24px 28px 24px;
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
        border: 1px solid #ececec;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .category-card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 8px 32px rgba(166,124,82,0.13);
        border-color: #A67C52;
    }
    .category-card .icon {
        font-size: 2.7rem;
        color: #A67C52;
        margin-bottom: 18px;
    }
    .category-card h3 {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: #2c2c2c;
    }
    .category-card p {
        font-size: 1rem;
        color: #666;
        margin-bottom: 0;
    }
    .category-link {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        z-index: 2;
        text-indent: -9999px;
    }
    @media (max-width: 600px) {
        .transport-hero h1 { font-size: 1.5rem; }
        .transport-categories { padding: 20px 4px 10px 4px; gap: 16px; }
        .category-card { padding: 18px 6px 14px 6px; }
    }
</style>

<div class="transport-hero">
    <h1>Transport de Luxe & Location à Marrakech</h1>
    <p>
        Découvrez nos solutions de transport haut de gamme : location de voitures de prestige, motos puissantes, et services VIP avec chauffeur privé. Vivez Marrakech autrement, en toute sérénité.
    </p>
</div>

<div class="transport-categories">
    <div class="category-card">
        <div class="icon">🚗</div>
        <h3>Location Voiture</h3>
        <p>Large choix de véhicules de luxe, SUV, berlines, sportives, pour tous vos déplacements à Marrakech et au Maroc.</p>
        <a href="{{ url('/location-voiture') }}" class="category-link">Location Voiture</a>
    </div>
    <div class="category-card">
        <div class="icon">🏍️</div>
        <h3>Location Moto</h3>
        <p>Motos, scooters, maxi-scooters : vivez la liberté et l’aventure sur les routes de Marrakech avec des deux-roues récents.</p>
        <a href="{{ url('/location-moto') }}" class="category-link">Location Moto</a>
    </div>
    <div class="category-card">
        <div class="icon">🛎️</div>
        <h3>VIP Transport</h3>
        <p>Chauffeur privé, transferts aéroport, limousines, vans de luxe : un service sur-mesure pour une expérience exclusive.</p>
        <a href="{{ url('/vip-transport') }}" class="category-link">VIP Transport</a>
    </div>
</div>
@endsection
