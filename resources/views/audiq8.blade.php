@extends('layouts.app')

@section('title', 'Audi Q8 - Location de Voiture')

@section('content')

<style>
    .carousel {
        position: relative;
        width: 100%;
        height: 90vh;
        overflow: hidden;
    }

    .carousel img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        transition: opacity 1.5s ease-in-out;
    }

    .carousel img.active {
        opacity: 1;
        z-index: 1;
    }

    .details {
        text-align: center;
        padding: 40px 20px;
        background-color: #f8f9fa;
    }

    .details h2 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .details p {
        font-size: 1.1rem;
        color: #555;
        max-width: 800px;
        margin: 0 auto 20px;
    }

    .details .price {
        font-size: 1.6rem;
        color: #28a745;
        margin-top: 10px;
        font-weight: bold;
    }

    .reservation-form {
        background-color: #fff;
        padding: 40px 20px;
        max-width: 600px;
        margin: 40px auto;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .reservation-form h3 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 1.8rem;
    }

    .reservation-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .reservation-form input,
    .reservation-form textarea {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 1rem;
    }

    .reservation-form button {
        width: 100%;
        padding: 14px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1.2rem;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .reservation-form button:hover {
        background-color: #218838;
    }

    @media (max-width: 768px) {
        .details h2 {
            font-size: 1.8rem;
        }

        .details p {
            font-size: 1rem;
        }

        .reservation-form {
            padding: 20px 10px;
        }
    }
</style>

<div class="carousel">
    <img class="active" src="{{ asset('image/audiq8.jpg') }}"alt="Audi Q8 extérieur">
</div>

<div class="details">
    <h2>Audi Q8 - SUV de Luxe</h2>
    <p>Louez l’Audi Q8 pour un confort haut de gamme, une performance exceptionnelle et un design moderne. Idéale pour vos déplacements à Marrakech ou ailleurs.</p>
    <p class="price">Prix : 1500 MAD / jour</p>
</div>

@if(session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
@endif

<div class="reservation-form">
    <h3>Vérifier la Disponibilité</h3>
    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf

        <input type="hidden" name="car_model" value="Audi Q8">

        <label for="name">Nom complet</label>
        <input type="text" id="name" name="name" placeholder="Votre nom complet" required>

        <label for="email">Adresse email</label>
        <input type="email" id="email" name="email" placeholder="Votre adresse email" required>

        <label for="phone">Numéro de téléphone</label>
        <input type="tel" id="phone" name="phone" placeholder="Votre numéro de téléphone" required>

        <label for="check-in">Date de Check-in</label>
        <input type="date" id="check-in" name="check_in" required>

        <label for="check-out">Date de Check-out</label>
        <input type="date" id="check-out" name="check_out" required>

        <label for="message">Message</label>
        <textarea id="message" name="message" rows="4" placeholder="Informations supplémentaires (dates, durée, etc.)" required></textarea>

        <button type="submit">Réserver l'Audi Q8</button>
    </form>
</div>

@endsection

@section('scripts')
<script>
    let currentIndex = 0;
    const images = document.querySelectorAll('.carousel img');

    function changeImage() {
        images[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % images.length;
        images[currentIndex].classList.add('active');
    }

    setInterval(changeImage, 5000);
</script>
@endsection
