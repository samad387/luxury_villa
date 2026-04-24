@extends('layouts.app')

@section('title', $activity->nom)

@section('content')
<style>
    .activity-detail-container {
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
    .activity-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #333;
        display: flex;
        align-items: center;
        gap: 0.7rem;
    }
    .main-image-container {
        position: relative;
        width: 100%;
        margin-bottom: 1rem;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        background: #000;
    }
    .main-image-container img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    .main-image-container img:hover {
        transform: scale(1.02);
    }
    .carousel-controls {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 100%;
        display: flex;
        justify-content: space-between;
        padding: 0 15px;
        pointer-events: none;
    }
    .carousel-controls span {
        background: rgba(0,0,0,0.7);
        color: white;
        padding: 12px 18px;
        border-radius: 50%;
        cursor: pointer;
        pointer-events: auto;
        font-size: 1.5rem;
        transition: background 0.3s;
        user-select: none;
    }
    .carousel-controls span:hover {
        background: rgba(0,0,0,0.9);
    }
    .thumbnail-row {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        overflow-x: auto;
        padding: 10px 0;
        -webkit-overflow-scrolling: touch;
    }
    .thumbnail-row img {
        width: 100px;
        height: 70px;
        object-fit: cover;
        border-radius: 8px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s;
        flex-shrink: 0;
    }
    .thumbnail-row img:hover,
    .thumbnail-row img.active {
        border-color: #FF5A5F;
        transform: scale(1.1);
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
    #fullscreenOverlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0,0,0,0.95);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    #fullscreenOverlay.active {
        display: flex;
    }
    #fullscreenImage {
        max-width: 90vw;
        max-height: 90vh;
        object-fit: contain;
        border-radius: 12px;
        box-shadow: 0 0 40px rgba(0,0,0,0.5);
    }
    .fullscreen-close {
        position: absolute;
        top: 30px;
        right: 40px;
        font-size: 3rem;
        color: white;
        cursor: pointer;
        font-weight: bold;
        z-index: 10000;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0,0,0,0.5);
        border-radius: 50%;
        transition: background 0.3s;
    }
    .fullscreen-close:hover {
        background: rgba(0,0,0,0.8);
    }
    .fullscreen-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0,0,0,0.7);
        color: white;
        padding: 15px 20px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 2rem;
        z-index: 10000;
        transition: background 0.3s;
    }
    .fullscreen-nav:hover {
        background: rgba(0,0,0,0.9);
    }
    .fullscreen-nav.prev {
        left: 30px;
    }
    .fullscreen-nav.next {
        right: 30px;
    }
    @media (max-width: 900px) {
        .activity-detail-container {
            grid-template-columns: 1fr;
            gap: 1rem;
            margin: 1rem auto;
            padding: 0 0.5rem;
        }
        .main-content, .sidebar {
            padding: 1rem;
        }
        .activity-title {
            font-size: 1.8rem;
        }
        .main-image-container img {
            height: 300px;
        }
    }
    @media (max-width: 768px) {
        .activity-detail-container {
            margin: 0.5rem auto;
            padding: 0 0.25rem;
            gap: 0.75rem;
        }
        .main-content {
            padding: 0.75rem;
            border-radius: 8px;
        }
        .sidebar {
            padding: 1rem;
            border-radius: 8px;
        }
        .activity-title {
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
        }
        .main-image-container img {
            height: 250px;
        }
        .thumbnail-row img {
            width: 80px;
            height: 60px;
        }
    }
</style>

<div class="activity-detail-container">
    <main class="main-content">
        <div class="activity-title">
            <i class="fas fa-running text-blue-500"></i>
            {{ $activity->nom }}
        </div>
        
        @php
            $allImages = collect();
            if($activity->images && $activity->images->isNotEmpty()) {
                $allImages = $activity->images;
            } elseif($activity->image) {
                $allImages = collect([(object)['path' => $activity->image]]);
            }
        @endphp
        
        @if($allImages->isNotEmpty())
            <!-- Main Image Container -->
            <div class="main-image-container">
                <img id="mainImage" 
                     src="{{ asset('storage/'.$allImages->first()->path) }}" 
                     alt="{{ $activity->nom }}"
                     onclick="openFullscreen()">
                
                @if($allImages->count() > 1)
                <div class="carousel-controls">
                    <span onclick="prevImage(); event.stopPropagation();">‹</span>
                    <span onclick="nextImage(); event.stopPropagation();">›</span>
                </div>
                @endif
            </div>

            <!-- Thumbnail Row -->
            @if($allImages->count() > 1)
            <div id="thumbnailRow" class="thumbnail-row">
                @foreach($allImages as $index => $image)
                    <img src="{{ asset('storage/'.$image->path) }}" 
                         alt="{{ $activity->nom }} - Image {{ $index + 1 }}"
                         onclick="changeImage(this)"
                         class="{{ $index === 0 ? 'active' : '' }}">
                @endforeach
            </div>
            @endif
        @else
            <div class="main-image-container">
                <div style="width: 100%; height: 400px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-image" style="font-size: 5rem; color: white; opacity: 0.5;"></i>
                </div>
            </div>
        @endif

        <div class="info-list">
            <div><strong>Prix :</strong> {{ $activity->prix ? number_format($activity->prix,2).' MAD' : '-' }}</div>
            <div><strong>Catégorie :</strong> {{ $activity->category ?? '-' }}</div>
        </div>
        
        <div class="description">
            <strong>Description :</strong><br>
            {{ $activity->description }}
        </div>
    </main>
    
    <aside class="sidebar">
        <h3>Réserver cette activité</h3>
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="activity_name" value="{{ $activity->nom }}">
            <label for="name">Nom complet</label>
            <input type="text" id="name" name="name" placeholder="Votre nom complet" required>
            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" placeholder="Votre adresse email" required>
            <label for="phone">Numéro de téléphone</label>
            <input type="tel" id="phone" name="phone" placeholder="Votre numéro de téléphone" required>
            <label for="check-in">Date de début</label>
            <input type="date" id="check-in" name="check_in" required>
            <label for="check-out">Date de fin</label>
            <input type="date" id="check-out" name="check_out" required>
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="4" placeholder="Informations supplémentaires..."></textarea>
            <button type="submit">Réserver cette activité</button>
        </form>
    </aside>
</div>

<!-- Fullscreen Overlay -->
<div id="fullscreenOverlay" onclick="closeFullscreen()">
    <img id="fullscreenImage" onclick="event.stopPropagation();">
    <span class="fullscreen-close" onclick="closeFullscreen(); event.stopPropagation();">×</span>
    @if($allImages->count() > 1)
    <span class="fullscreen-nav prev" onclick="prevFullscreenImage(); event.stopPropagation();">‹</span>
    <span class="fullscreen-nav next" onclick="nextFullscreenImage(); event.stopPropagation();">›</span>
    @endif
</div>

<script>
  const thumbnails = document.querySelectorAll('#thumbnailRow img');
  const mainImage = document.getElementById('mainImage');
  const fullscreenOverlay = document.getElementById('fullscreenOverlay');
  const fullscreenImage = document.getElementById('fullscreenImage');

  let currentIndex = 0;

  const updateMainImage = (index) => {
    if (!thumbnails.length) return;
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
    if (!thumbnails.length) return;
    const newIndex = (currentIndex - 1 + thumbnails.length) % thumbnails.length;
    updateMainImage(newIndex);
  }

  const nextImage = () => {
    if (!thumbnails.length) return;
    const newIndex = (currentIndex + 1) % thumbnails.length;
    updateMainImage(newIndex);
  }

  const openFullscreen = () => {
    if (!fullscreenOverlay || !mainImage) return;
    fullscreenOverlay.classList.add('active');
    fullscreenImage.src = mainImage.src;
  }

  const closeFullscreen = () => {
    if (!fullscreenOverlay) return;
    fullscreenOverlay.classList.remove('active');
  }

  const prevFullscreenImage = () => {
    if (!thumbnails.length) return;
    const newIndex = (currentIndex - 1 + thumbnails.length) % thumbnails.length;
    currentIndex = newIndex;
    fullscreenImage.src = thumbnails[newIndex].src;
    updateMainImage(newIndex);
  }

  const nextFullscreenImage = () => {
    if (!thumbnails.length) return;
    const newIndex = (currentIndex + 1) % thumbnails.length;
    currentIndex = newIndex;
    fullscreenImage.src = thumbnails[newIndex].src;
    updateMainImage(newIndex);
  }

  document.addEventListener('keydown', (e) => {
    if (fullscreenOverlay && fullscreenOverlay.classList.contains('active')) {
      if (e.key === 'Escape') {
        closeFullscreen();
      } else if (e.key === 'ArrowLeft') {
        prevFullscreenImage();
      } else if (e.key === 'ArrowRight') {
        nextFullscreenImage();
      }
    } else {
      if (e.key === 'ArrowLeft' && thumbnails.length > 1) {
        prevImage();
      } else if (e.key === 'ArrowRight' && thumbnails.length > 1) {
        nextImage();
      }
    }
  });
</script>
@endsection
