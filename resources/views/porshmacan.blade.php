@extends('layouts.app')

@section('title', 'Porsche Macan - Location de Voiture')

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
</style>

<div class="carousel">
    <img class="active" src="https://res.cloudinary.com/unix-center/image/upload/c_limit,dpr_3.0,f_auto,fl_progressive,g_center,h_580,q_75,w_906/lgmrqoqbrtrxovayjjqa.jpg" alt="Porsche Macan extérieur">
    <img src="https://example.com/images/porsche-macan-2.jpg" alt="Porsche Macan intérieur">
    <img src="https://example.com/images/porsche-macan-3.jpg" alt="Porsche Macan arrière">
    <img src="https://example.com/images/porsche-macan-4.jpg" alt="Porsche Macan côté">
</div>

<div class="details">
    <h2>Porsche Macan - SUV Sportif</h2>
    <p>Louez le Porsche Macan pour une expérience de conduite inégalée, un confort de luxe et une performance dynamique. Parfait pour vos déplacements à Marrakech ou ailleurs.</p>
    <p class="price">Prix : 3 000 MAD / jour</p>
</div>

<div class="reservation-form">
    <h3>Check Availability</h3>
    <form action="{{ route('reservations.store') }}" method="POST">
    <input type="hidden" name="car_model" value="Porsche Macan">
    @csrf
    <input type="hidden" name="car_model" value="Porsche Macan">
    <input type="text" name="name" placeholder="Votre nom complet" required>
    <input type="email" name="email" placeholder="Votre adresse email" required>
    <input type="tel" name="phone" placeholder="Votre numéro de téléphone" required>

    <label for="check-in">Date de Check-in</label>
    <input type="date" id="check-in" name="check_in" required>

    <label for="check-out">Date de Check-out</label>
    <input type="date" id="check-out" name="check_out" required>

    <textarea name="message" rows="4" placeholder="Informations supplémentaires (dates, durée, etc.)" required></textarea>

    <button type="submit">Réserver le Porsche Macan</button>
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
