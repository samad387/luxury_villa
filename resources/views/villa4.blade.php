@extends('layouts.app')

@section('title', 'Villa de Luxe - Marrakech')

@section('content')
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
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    padding: 0 1rem;
  }

  .main-content {
    flex: 1 1 700px;
    background: #fff;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  }

  .villa-title {
    font-size: 2.2rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #333;
  }

  .main-image-container {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 1rem;
    cursor: pointer;
  }

  .main-image-container img {
    width: 100%;
    height: 450px;
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .main-image-container:hover img {
    transform: scale(1.03);
  }

  .carousel-controls {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
    pointer-events: none;
  }

  .carousel-controls span {
    background-color: rgba(0,0,0,0.5);
    color: white;
    padding: 10px 14px;
    font-size: 1.4rem;
    cursor: pointer;
    border-radius: 50%;
    pointer-events: all;
    transition: background 0.3s ease;
    user-select: none;
  }

  .carousel-controls span:hover {
    background-color: rgba(0,0,0,0.7);
  }

  .thumbnail-row {
    display: flex;
    gap: 10px;
    overflow-x: auto;
    padding-bottom: 0.5rem;
    margin-bottom: 2rem;
  }

  .thumbnail-row img {
    width: 100px;
    height: 70px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
    border: 2px solid transparent;
    transition: border 0.3s;
  }

  .thumbnail-row img:hover,
  .thumbnail-row img.active {
    border: 2px solid #FF5A5F;
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
  form select {
    width: 100%;
    padding: 0.6rem;
    margin-bottom: 1.2rem;
    border: 1.5px solid #ccc;
    border-radius: 8px;
    font-size: 1rem;
    transition: border 0.3s ease;
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

  /* Plein écran overlay */
  #fullscreenOverlay {
    display: none;
    position: fixed;
    top:0; left:0; right:0; bottom:0;
    background-color: rgba(0,0,0,0.95);
    z-index: 9999;
    justify-content: center;
    align-items: center;
    overflow: hidden;
  }

  #fullscreenOverlay.active {
    display: flex;
  }

  #fullscreenImage {
    max-width: 90%;
    max-height: 90vh;
    object-fit: contain;
    border-radius: 10px;
  }

  /* Contrôles plein écran */
  #fullscreenOverlay .carousel-controls {
    position: absolute;
    top: 50%;
    width: 100%;
    padding: 0 2rem;
    box-sizing: border-box;
    pointer-events: none;
  }

  #fullscreenOverlay .carousel-controls span {
    background-color: rgba(255,255,255,0.3);
    color: #000;
    font-size: 2rem;
    pointer-events: all;
    user-select: none;
  }

  #fullscreenOverlay .carousel-controls span:hover {
    background-color: rgba(255,255,255,0.7);
  }

  /* Bouton fermer */
  #closeFullscreen {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    font-size: 2rem;
    color: white;
    cursor: pointer;
    user-select: none;
    background: rgba(0,0,0,0.4);
    padding: 0.3rem 0.7rem;
    border-radius: 50%;
  }

  @media (max-width: 900px) {
    .container {
      flex-direction: column;
    }

    .sidebar {
      position: relative;
      top: 0;
      width: 100%;
    }
  }
</style>

<div class="container">
  <main class="main-content">
    <h1 class="villa-title">Villa de Luxe avec Piscine Privée à Marrakech</h1>

    <div class="main-image-container" onclick="openFullscreen()">
      <img id="mainImage" src="https://www.muretprestige.com/images/pages/slide.jpg" alt="Villa principale">
      <div class="carousel-controls">
        <span onclick="event.stopPropagation(); prevImage()">❮</span>
        <span onclick="event.stopPropagation(); nextImage()">❯</span>
      </div>
    </div>

    <div class="thumbnail-row" id="thumbnailRow">
      <img src="https://www.muretprestige.com/images/pages/slide.jpg" class="active" onclick="changeImage(this)">
      <img src="https://www.marrakech-private-resort.com/wp-content/uploads/2018/03/Villa-Royal-Palm-3-5337.jpg" onclick="changeImage(this)">
      <img src="https://bks-immobilier.com/wp-content/uploads/2020/08/9W9A0038-Modifier.jpg" onclick="changeImage(this)">
      <img src="https://www.marrakech-villas.com/activities/homesliders/image_1154536023.jpeg" onclick="changeImage(this)">
      <img src="https://www.southfrancevillas.com/assets/e7318ea9/MR039A-villa-marrakech-18.jpg" onclick="changeImage(this)">
    </div>

    <section class="description">
      <h2>Description</h2>
      <p>
        Découvrez cette magnifique villa contemporaine avec piscine privée, située dans un quartier calme à seulement 15 minutes du centre-ville de Marrakech.
        Avec ses 4 chambres, 3 salles de bains, cuisine équipée et grand jardin, elle est parfaite pour des vacances inoubliables en famille ou entre amis.
      </p>
      <p>
        Services inclus : Wi-Fi, ménage, sécurité 24/7, parking privé.
      </p>
    </section>

    <section class="location">
      <h3>Emplacement</h3>
      <p>Marrakech, Maroc</p>
      <div class="map-container">
        <iframe src="https://maps.google.com/maps?q=marrakech&z=13&output=embed" allowfullscreen loading="lazy" title="Carte de Marrakech"></iframe>
      </div>
    </section>
  </main>

  <aside class="sidebar">
    <h3>Réserver cette villa</h3>
    <form method="POST" action="{{ route('contact') }}">
      @csrf
      <label for="name">Nom complet</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Adresse e-mail</label>
      <input type="email" id="email" name="email" required>

      <label for="phone">Téléphone</label>
      <input type="tel" id="phone" name="phone" required>

      <label for="date_in">Date d'arrivée</label>
      <input type="date" id="date_in" name="date_in" required>

      <label for="date_out">Date de départ</label>
      <input type="date" id="date_out" name="date_out" required>

      <label for="guests">Nombre de personnes</label>
      <select id="guests" name="guests" required>
        <option value="">Sélectionnez</option>
        @for ($i = 1; $i <= 10; $i++)
          <option value="{{ $i }}">{{ $i }}</option>
        @endfor
      </select>

      <button type="submit">Réserver</button>
    </form>
  </aside>
</div>

<!-- Overlay plein écran -->
<div id="fullscreenOverlay" onclick="closeFullscreen()">
  <span id="closeFullscreen" onclick="event.stopPropagation(); closeFullscreen()">×</span>
  <img id="fullscreenImage" src="" alt="Image en plein écran">
  <div class="carousel-controls">
    <span onclick="event.stopPropagation(); prevFullscreenImage()">❮</span>
    <span onclick="event.stopPropagation(); nextFullscreenImage()">❯</span>
  </div>
</div>

<script>
  const thumbnails = document.querySelectorAll('#thumbnailRow img');
  const mainImage = document.getElementById('mainImage');
  const fullscreenOverlay = document.getElementById('fullscreenOverlay');
  const fullscreenImage = document.getElementById('fullscreenImage');

  let currentIndex = 0;

  const updateMainImage = (index) => {
    mainImage.src = thumbnails[index].src;
    thumbnails.forEach(img => img.classList.remove('active'));
    thumbnails[index].classList.add('active');
    currentIndex = index;
  }

  const changeImage = (element) => {
    const index = Array.from(thumbnails).indexOf(element);
    updateMainImage(index);
  }

  const prevImage = () => {
    const newIndex = (currentIndex - 1 + thumbnails.length) % thumbnails.length;
    updateMainImage(newIndex);
  }

  const nextImage = () => {
    const newIndex = (currentIndex + 1) % thumbnails.length;
    updateMainImage(newIndex);
  }

  // Plein écran
  const openFullscreen = () => {
    fullscreenOverlay.classList.add('active');
    fullscreenImage.src = mainImage.src;
  }

  const closeFullscreen = () => {
    fullscreenOverlay.classList.remove('active');
  }

  const prevFullscreenImage = () => {
    const newIndex = (currentIndex - 1 + thumbnails.length) % thumbnails.length;
    currentIndex = newIndex;
    fullscreenImage.src = thumbnails[newIndex].src;
    updateMainImage(newIndex);
  }

  const nextFullscreenImage = () => {
    const newIndex = (currentIndex + 1) % thumbnails.length;
    currentIndex = newIndex;
    fullscreenImage.src = thumbnails[newIndex].src;
    updateMainImage(newIndex);
  }

  // Fermer plein écran avec Échap
  document.addEventListener('keydown', (e) => {
    if (e.key === "Escape" && fullscreenOverlay.classList.contains('active')) {
      closeFullscreen();
    }
    if (e.key === "ArrowLeft" && fullscreenOverlay.classList.contains('active')) {
      prevFullscreenImage();
    }
    if (e.key === "ArrowRight" && fullscreenOverlay.classList.contains('active')) {
      nextFullscreenImage();
    }
  });
</script>
@endsection
