@extends('layouts.app')

@section('title', $transport->nom)

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .transport-detail-container {
        max-width: 1100px;
        margin: 2rem auto;
        display: grid;
        grid-template-columns: 65% 35%;
        gap: 2rem;
        padding: 0 1rem;
    }
    .main-content {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    .transport-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #333;
        display: flex;
        align-items: center;
        gap: 0.7rem;
    }
    .swiper {
        max-width: 100%;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 1rem;
    }
    .swiper-slide img {
        width: 100%;
        height: 350px;
        object-fit: cover;
        border-radius: 10px;
    }
    .swiper-pagination-bullet-active {
        background: #FF5A5F;
    }
    .info-list {
        margin: 1.5rem 0;
        font-size: 1.1rem;
        color: #444;
    }
    .info-list strong {
        color: #222;
        margin-right: 8px;
    }
    .description {
        margin-top: 1.5rem;
        font-size: 1.08rem;
        color: #555;
        line-height: 1.7;
    }
    .sidebar {
        background: #fff;
        border-radius: 12px;
        padding: 2rem 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        height: fit-content;
        position: sticky;
        top: 2rem;
    }
    .sidebar h3 {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    form label {
        font-weight: 500;
        font-size: 0.95rem;
        margin-bottom: 0.3rem;
        display: block;
    }
    form input,
    form textarea {
        width: 100%;
        padding: 0.7rem;
        margin-bottom: 1.2rem;
        border: 1.5px solid #ccc;
        border-radius: 10px;
        font-size: 1rem;
        transition: border-color 0.3s;
        box-sizing: border-box;
    }
    form input:focus,
    form textarea:focus {
        border-color: #FF5A5F;
        outline: none;
    }
    button[type="submit"] {
        width: 100%;
        background-color: #FF5A5F;
        color: white;
        padding: 0.9rem;
        font-weight: 600;
        font-size: 1.1rem;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: background 0.3s ease;
    }
    button[type="submit"]:hover {
        background-color: #e0484d;
    }
    @media (max-width: 900px) {
        .transport-detail-container {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        .main-content, .sidebar {
            padding: 1rem;
        }
        .swiper-slide img {
            height: 220px;
        }
    }
</style>
<div class="transport-detail-container">
    <main class="main-content">
        <div class="transport-title">
            @if($transport->type === 'moto')
                <i class="fas fa-motorcycle text-orange-500"></i>
            @elseif($transport->type === 'voiture')
                <i class="fas fa-car-side text-blue-500"></i>
            @elseif($transport->type === 'vip')
                <i class="fas fa-crown text-yellow-500"></i>
            @endif
            {{ $transport->nom }}
        </div>
        @if($transport->images && $transport->images->isNotEmpty())
        <div class="swiper mainSwiper">
            <div class="swiper-wrapper">
                @foreach($transport->images as $img)
                <div class="swiper-slide">
                    <img src="{{ asset('storage/' . $img->path) }}" alt="{{ $transport->nom }}" class="transport-image-lightbox" style="cursor:zoom-in;">
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <div id="lightbox-modal" style="display:none;position:fixed;z-index:9999;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.9);align-items:center;justify-content:center;">
            <img id="lightbox-img" src="" style="max-width:90vw;max-height:90vh;border-radius:12px;box-shadow:0 0 40px #000;">
            <span id="lightbox-close" style="position:absolute;top:30px;right:40px;font-size:3rem;color:#fff;cursor:pointer;font-weight:bold;">&times;</span>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.transport-image-lightbox').forEach(function(img) {
                img.addEventListener('click', function() {
                    document.getElementById('lightbox-img').src = this.src;
                    document.getElementById('lightbox-modal').style.display = 'flex';
                });
            });
            document.getElementById('lightbox-close').onclick = function() {
                document.getElementById('lightbox-modal').style.display = 'none';
            };
            document.getElementById('lightbox-modal').onclick = function(e) {
                if(e.target === this) this.style.display = 'none';
            };
        });
        </script>
        @elseif($transport->image)
            <img src="{{ asset('storage/' . $transport->image) }}" alt="{{ $transport->nom }}" class="rounded mb-4" style="width:100%; max-height:350px; object-fit:cover;">
        @else
            <img src="https://via.placeholder.com/600x350?text=Transport" alt="{{ $transport->nom }}" class="rounded mb-4" style="width:100%; max-height:350px; object-fit:cover;">
        @endif
        <div class="info-list">
            <div><strong>Prix :</strong> {{ $transport->prix ? number_format($transport->prix,2).' MAD' : '-' }}</div>
            <div><strong>Capacité :</strong> {{ $transport->capacity ?? '-' }}</div>
        </div>
        <div class="description">
            <strong>Description :</strong><br>
            {{ $transport->description }}
        </div>
    </main>
    <aside class="sidebar">
        <h3>Réserver ce transport</h3>
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="car_model" value="{{ $transport->nom }}">
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
            <textarea id="message" name="message" rows="4" placeholder="Informations supplémentaires..."></textarea>
            <button type="submit">Réserver ce transport</button>
        </form>
    </aside>
</div>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mainSwiper = new Swiper('.mainSwiper', {
        spaceBetween: 30,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
    });
});
</script>
@endsection 