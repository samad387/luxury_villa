@extends('layouts.app')

@section('title', 'Villa de Luxe - Marrakech')

@section('content')
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');

  body, html {
    font-family: 'Montserrat', sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
  }

  .container {
    max-width: 1200px;
    margin: 2rem auto;
    display: grid;
    grid-template-columns: 70% 30%;
    gap: 2rem;
    padding: 0 1rem;
  }

  .main-content {
    width: 100%;
    background: #fff;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  }
  
  .description p {
    max-width: 650px;
    width: 100%;
    word-break: break-all
  }
  
  .villa-title {
    font-size: 2.2rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #333;
  }

  /* Swiper Styles */
  .swiper {
    max-width: 100%;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 1rem;
  }

  .swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
  }

  .swiper-slide img {
    display: block;
    width: 100%;
    height: 450px;
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .swiper-slide:hover img {
    transform: scale(1.03);
  }

  .swiper-button-next,
  .swiper-button-prev {
    color: #fff;
    background: rgba(0,0,0,0.5);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    transition: background 0.3s ease;
  }

  .swiper-button-next:hover,
  .swiper-button-prev:hover {
    background: rgba(0,0,0,0.7);
  }

  .swiper-button-next::after,
  .swiper-button-prev::after {
    font-size: 20px;
  }

  .swiper-pagination-bullet {
    background: #fff;
    opacity: 0.7;
  }

  .swiper-pagination-bullet-active {
    background: #FF5A5F;
    opacity: 1;
  }

  /* Thumbnail Swiper */
  .thumbnail-swiper {
    width: 100%;
    height: 100px;
    margin-bottom: 2rem;
  }

  .thumbnail-swiper .swiper-slide {
    opacity: 0.6;
    transition: opacity 0.3s ease;
    cursor: pointer;
  }

  .thumbnail-swiper .swiper-slide-thumb-active {
    opacity: 1;
    border: 2px solid #FF5A5F;
    border-radius: 8px;
  }

  .thumbnail-swiper .swiper-slide img {
    width: 100%;
    height: 70px;
    object-fit: cover;
    border-radius: 6px;
  }

  /* Responsive Styles */
  @media (max-width: 998px) {
    .swiper {
    max-width: 550px;
  }
    .swiper-slide img {
      height: 300px;
    }
    
    .thumbnail-swiper {
      height: 80px;
      margin-bottom: 1rem;
    }
    
    .thumbnail-swiper .swiper-slide img {
      height: 60px;
    }
    
    .swiper-button-next,
    .swiper-button-prev {
      width: 40px;
      height: 40px;
    }
    
    .swiper-button-next::after,
    .swiper-button-prev::after {
      font-size: 16px;
    }
    
    .fullscreen-swiper {
      width: 95%;
      height: 85vh;
    }
    
    .fullscreen-close {
      top: 10px;
      right: 15px;
      font-size: 1.5rem;
      padding: 8px 12px;
    }
    
    .swiper-pagination {
      bottom: 10px;
    }
    
    .swiper-pagination-bullet {
      width: 8px;
      height: 8px;
    }
  }

  @media (max-width: 480px) {
    .swiper {
    max-width: 320px;
  }
    .swiper-slide img {
      height: 250px;
    }
    
    .thumbnail-swiper {
      height: 70px;
      margin-bottom: 0.75rem;
    }
    
    .thumbnail-swiper .swiper-slide img {
      height: 50px;
    }
    
    .swiper-button-next,
    .swiper-button-prev {
      width: 35px;
      height: 35px;
    }
    
    .swiper-button-next::after,
    .swiper-button-prev::after {
      font-size: 14px;
    }
    
    .swiper-pagination {
      bottom: 8px;
    }
    
    .swiper-pagination-bullet {
      width: 6px;
      height: 6px;
    }
    
    .fullscreen-swiper {
      width: 98%;
      height: 80vh;
    }
    
    .fullscreen-close {
      top: 5px;
      right: 10px;
      font-size: 1.2rem;
      padding: 6px 10px;
    }
  }

  @media (max-width: 360px) {
    .swiper-slide img {
      height: 200px;
    }
    
    .thumbnail-swiper {
      height: 60px;
    }
    
    .thumbnail-swiper .swiper-slide img {
      height: 45px;
    }
    
    .swiper-button-next,
    .swiper-button-prev {
      width: 30px;
      height: 30px;
    }
    
    .swiper-button-next::after,
    .swiper-button-prev::after {
      font-size: 12px;
    }
  }

  .description {
    font-size: 1.05rem;
    line-height: 1.7;
    color: #555;
  }

  .description h2 {
    font-size: 1.4rem;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #333;
  }

  .location {
    margin-top: 2rem;
  }

  .location h3 {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1rem;
  }

  .map-container iframe {
    width: 100%;
    height: 300px;
    border: none;
    border-radius: 12px;
  }

  .sidebar {
    flex: 0 0 350px;
    background: #fff;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    height: fit-content;
    position: sticky;
    top: 2rem;
  }

  .sidebar h3 {
    font-size: 1.6rem;
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
  form select,
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
  form select:focus {
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

  /* Fullscreen Modal */
  .fullscreen-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.95);
    z-index: 9999;
    justify-content: center;
    align-items: center;
  }

  .fullscreen-modal.active {
    display: flex;
  }

  .fullscreen-swiper {
    width: 90%;
    height: 90vh;
  }

  .fullscreen-swiper .swiper-slide img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: 10px;
  }

  .fullscreen-close {
    position: absolute;
    top: 20px;
    right: 30px;
    color: white;
    font-size: 2rem;
    cursor: pointer;
    background: rgba(0,0,0,0.4);
    padding: 10px 15px;
    border-radius: 50%;
    z-index: 10000;
  }

  /* Location Section (Map) */
  .location-section {
    margin-top: 2rem;
  }
  
  .location-section p {
    font-size: 1.125rem;
    color: #4a5568;
    margin-bottom: 1rem;
  }
  
  #mapid {
    width: 100%;
    height: 24rem;
    border-radius: 0.75rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    overflow: hidden;
  }

  @media (max-width: 768px) {
    #mapid {
      height: 20rem;
      border-radius: 0.5rem;
    }
  }

  @media (max-width: 480px) {
    #mapid {
      height: 16rem;
      border-radius: 0.375rem;
    }
  }
  
  @media (max-width: 900px) {
    .container {
      grid-template-columns: 1fr;
      margin: 1rem auto;
      gap: 1rem;
      padding: 0 0.5rem;
    }
    
    .main-content {
      padding: 1rem;
    }
    
    .description p {
      max-width: 100%;
    }
    
    .sidebar {
      position: relative;
      top: 0;
      width: 100%;
      padding: 1.5rem;
    }
    
    .villa-title {
      font-size: 1.8rem;
    }
  }

  @media (max-width: 768px) {
    .container {
      margin: 0.5rem auto;
      padding: 0 0.25rem;
    }
    
    .main-content {
      padding: 0.75rem;
      border-radius: 8px;
    }
    
    .sidebar {
      padding: 1rem;
      border-radius: 8px;
    }
    
    .villa-title {
      font-size: 1.5rem;
      margin-bottom: 0.75rem;
    }
    
    .description h2 {
      font-size: 1.2rem;
    }
    
    .description p {
      font-size: 0.95rem;
      line-height: 1.6;
    }
    
    .location h3 {
      font-size: 1.1rem;
    }
    
    .sidebar h3 {
      font-size: 1.3rem;
      margin-bottom: 1rem;
    }
    
    form input,
    form select,
    form textarea {
      padding: 0.6rem;
      font-size: 0.9rem;
    }
    
    button[type="submit"] {
      padding: 0.8rem;
      font-size: 1rem;
    }
  }

  @media (max-width: 480px) {
    .container {
      margin: 0.25rem auto;
      padding: 0 0.125rem;
    }
    
    .main-content {
      padding: 0.5rem;
      border-radius: 6px;
    }
    
    .sidebar {
      padding: 0.75rem;
      border-radius: 6px;
    }
    
    .villa-title {
      font-size: 1.3rem;
      margin-bottom: 0.5rem;
    }
    
    .description h2 {
      font-size: 1.1rem;
    }
    
    .description p {
      font-size: 0.9rem;
      line-height: 1.5;
    }
    
    .location h3 {
      font-size: 1rem;
    }
    
    .sidebar h3 {
      font-size: 1.2rem;
      margin-bottom: 0.75rem;
    }
    
    form label {
      font-size: 0.9rem;
    }
    
    form input,
    form select,
    form textarea {
      padding: 0.5rem;
      font-size: 0.85rem;
      margin-bottom: 0.75rem;
    }
    
    button[type="submit"] {
      padding: 0.7rem;
      font-size: 0.95rem;
    }
  }
</style>

<div class="container">
  <main class="main-content">
    <h1 class="villa-title">{{$villa->name}}</h1>
    
    @if ($villa->images->isNotEmpty())
    <!-- Main Swiper -->
    <div class="swiper mainSwiper" onclick="openFullscreen()">
      <div class="swiper-wrapper">
        @foreach ($villa->images as $image)
        <div class="swiper-slide">
          <img src="{{asset('storage/' . $image->path)}}" alt="{{$villa->name}}">
        </div>
        @endforeach
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>

    <!-- Thumbnail Swiper -->
    <div class="swiper thumbnailSwiper">
      <div class="swiper-wrapper">
        @foreach ($villa->images as $image)
        <div class="swiper-slide">
          <img src="{{asset('storage/' . $image->path)}}" alt="{{$villa->name}}">
        </div>
        @endforeach
      </div>
    </div>
    @endif
    
    <section class="description">
      <h2>Description</h2>
      <p>
        {{$villa->description}}
      </p>
      <p>
        Services inclus : Wi-Fi, ménage, sécurité 24/7, parking privé.
      </p>
    </section>

    <section class="location">
      <section class="location-section">
        <h3>Emplacement</h3>
        @if ($villa->geo_emplacement && $villa->coordinates)
          <p>{{ $villa->geo_emplacement }}</p>
          <div id="mapid"></div>
        @else
          <p class="no-map-text">Aucune localisation géographique fournie pour cette villa.</p>
        @endif
      </section>
    </section>
  </main>

  <aside class="sidebar">
    @if(session('success'))
      <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    <h3>Réserver cette villa</h3>
    <form action="{{ route('reservations.store') }}" method="POST">
      @csrf
      <input type="hidden" name="car_model" value="{{$villa->name}}">

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

      <button type="submit">Réserver cette villa</button>
    </form>
  </aside>
</div>

<!-- Fullscreen Modal -->
<div class="fullscreen-modal" id="fullscreenModal">
  <div class="fullscreen-close" onclick="closeFullscreen()">×</div>
  <div class="swiper fullscreenSwiper">
    <div class="swiper-wrapper">
      @foreach ($villa->images as $image)
      <div class="swiper-slide">
        <img src="{{asset('storage/' . $image->path)}}" alt="{{$villa->name}}">
      </div>
      @endforeach
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
  </div>
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

@if ($villa->geo_emplacement && $villa->coordinates)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const coords = {{ Js::from($villa->coordinates) }};
        const mapElement = document.getElementById('mapid');

        if (typeof L === 'undefined') {
            console.error("Leaflet.js library (L) is not loaded. Map cannot be initialized.");
            return;
        }
        if (!mapElement) {
            console.warn("Map element with ID 'mapid' not found.");
            return;
        }
        if (!coords || !coords.lat || !coords.lng) {
            console.warn("Invalid coordinates provided for the map:", coords);
            return;
        }

        console.log('Initializing Leaflet map for coordinates:', coords);

        const map = L.map('mapid').setView([coords.lat, coords.lng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([coords.lat, coords.lng]).addTo(map)
            .bindPopup('<b>{{ $villa->name }}</b><br>{{ $villa->geo_emplacement }}')
            .openPopup();
    });
</script>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize main swiper
    const mainSwiper = new Swiper('.mainSwiper', {
        spaceBetween: 30,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        thumbs: {
            swiper: {
                el: '.thumbnailSwiper',
                slidesPerView: 5,
                spaceBetween: 10,
                freeMode: true,
                watchSlidesProgress: true,
                breakpoints: {
                    320: {
                        slidesPerView: 3,
                        spaceBetween: 5,
                    },
                    480: {
                        slidesPerView: 4,
                        spaceBetween: 8,
                    },
                    768: {
                        slidesPerView: 5,
                        spaceBetween: 10,
                    }
                }
            }
        },
        keyboard: {
            enabled: true,
        },
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            320: {
                spaceBetween: 10,
            },
            768: {
                spaceBetween: 30,
            }
        }
    });

    // Initialize fullscreen swiper
    const fullscreenSwiper = new Swiper('.fullscreenSwiper', {
        spaceBetween: 30,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        navigation: {
            nextEl: '.fullscreenSwiper .swiper-button-next',
            prevEl: '.fullscreenSwiper .swiper-button-prev',
        },
        pagination: {
            el: '.fullscreenSwiper .swiper-pagination',
            clickable: true,
        },
        keyboard: {
            enabled: true,
        },
        loop: true,
        breakpoints: {
            320: {
                spaceBetween: 10,
            },
            768: {
                spaceBetween: 30,
            }
        }
    });

    // Fullscreen functionality
    const fullscreenModal = document.getElementById('fullscreenModal');
    
    window.openFullscreen = function() {
        fullscreenModal.classList.add('active');
        fullscreenSwiper.slideTo(mainSwiper.activeIndex);
        document.body.style.overflow = 'hidden';
    }
    
    window.closeFullscreen = function() {
        fullscreenModal.classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    // Close fullscreen with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && fullscreenModal.classList.contains('active')) {
            closeFullscreen();
        }
    });

    // Close fullscreen when clicking outside the image
    fullscreenModal.addEventListener('click', function(e) {
        if (e.target === fullscreenModal) {
            closeFullscreen();
        }
    });

    // Sync main swiper with fullscreen swiper
    mainSwiper.on('slideChange', function() {
        if (fullscreenModal.classList.contains('active')) {
            fullscreenSwiper.slideTo(mainSwiper.activeIndex);
        }
    });

    fullscreenSwiper.on('slideChange', function() {
        mainSwiper.slideTo(fullscreenSwiper.activeIndex);
    });
});
</script>
@endsection
