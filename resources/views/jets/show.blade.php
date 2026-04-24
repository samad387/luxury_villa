@extends('layouts.app')

@section('title', $jet->name . ' - Jets Privés')

@section('content')
<style>
    .jet-detail-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 20px;
        background: #f9f9f9;
    }
    
    .jet-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 30px;
        font-size: 2rem;
        font-weight: 700;
        color: #2c2c2c;
    }
    
    .jet-header i {
        font-size: 2.5rem;
        color: #A67C52;
    }
    
    .jet-content-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 40px;
    }
    
    .jet-info-section {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    
    .jet-image-container {
        position: relative;
        width: 100%;
        margin-bottom: 25px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .jet-image-container img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    
    .jet-image-container img:hover {
        transform: scale(1.02);
    }
    
    .jet-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: #A67C52;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f0f0f0;
    }
    
    .jet-description {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
        margin-bottom: 20px;
    }
    
    .jet-specs {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-top: 25px;
        padding-top: 25px;
        border-top: 2px solid #f0f0f0;
    }
    
    .jet-spec-item {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    
    .jet-spec-label {
        font-size: 0.9rem;
        color: #888;
        font-weight: 500;
    }
    
    .jet-spec-value {
        font-size: 1.2rem;
        font-weight: 700;
        color: #2c2c2c;
    }
    
    .reservation-form-section {
        background: white;
        border-radius: 16px;
        padding: 35px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        position: sticky;
        top: 20px;
        height: fit-content;
    }
    
    .reservation-form-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c2c2c;
        margin-bottom: 30px;
        text-align: center;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }
    
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s;
        box-sizing: border-box;
    }
    
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #A67C52;
    }
    
    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    .submit-btn {
        width: 100%;
        background: linear-gradient(135deg, #A67C52 0%, #8B643E 100%);
        color: white;
        padding: 16px;
        border: none;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(166, 124, 82, 0.4);
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #c3e6cb;
    }
    
    .thumbnail-row {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        overflow-x: auto;
        padding: 10px 0;
    }
    
    .thumbnail-row img {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s;
        flex-shrink: 0;
    }
    
    .thumbnail-row img:hover,
    .thumbnail-row img.active {
        border-color: #A67C52;
        transform: scale(1.1);
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
    
    @media (max-width: 1024px) {
        .jet-content-wrapper {
            grid-template-columns: 1fr;
        }
        
        .reservation-form-section {
            position: static;
        }
    }
    
    @media (max-width: 768px) {
        .jet-detail-container {
            padding: 20px 15px;
        }
        
        .jet-header {
            font-size: 1.5rem;
        }
        
        .jet-image-container img {
            height: 300px;
        }
        
        .jet-specs {
            grid-template-columns: 1fr;
        }
        
        .reservation-form-section {
            padding: 25px;
        }
    }
</style>

<div class="jet-detail-container">
    <div class="jet-header">
        <i class="fas fa-plane"></i>
        <span>{{ $jet->name }}</span>
    </div>

    <div class="jet-content-wrapper">
        <!-- Left Section: Jet Info & Image -->
        <div class="jet-info-section">
            @php
                $allImages = collect();
                if($jet->images->isNotEmpty()) {
                    $allImages = $jet->images;
                } elseif($jet->image) {
                    $allImages = collect([(object)['path' => $jet->image]]);
                }
            @endphp
            
            @if($allImages->isNotEmpty())
                <div class="jet-image-container">
                    <img id="mainImage" 
                         src="{{ asset('storage/'.$allImages->first()->path) }}" 
                         alt="{{ $jet->name }}"
                         onclick="openFullscreen()">
                    
                    @if($allImages->count() > 1)
                    <div class="carousel-controls">
                        <span onclick="prevImage(); event.stopPropagation();">‹</span>
                        <span onclick="nextImage(); event.stopPropagation();">›</span>
                    </div>
                    @endif
                </div>
                
                @if($allImages->count() > 1)
                <div id="thumbnailRow" class="thumbnail-row">
                    @foreach($allImages as $index => $image)
                        <img src="{{ asset('storage/'.$image->path) }}" 
                             alt="{{ $jet->name }} - Image {{ $index + 1 }}"
                             onclick="changeImage(this)"
                             class="{{ $index === 0 ? 'active' : '' }}">
                    @endforeach
                </div>
                @endif
            @else
                <div class="jet-image-container">
                    <div style="width: 100%; height: 400px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-plane" style="font-size: 5rem; color: white; opacity: 0.5;"></i>
                    </div>
                </div>
            @endif
            
            <div class="jet-price">
                Prix : {{ number_format($jet->price_per_hour, 2, ',', ' ') }} MAD / heure
            </div>
            
            <div class="jet-description">
                <strong>Description :</strong><br>
                {{ $jet->description }}
            </div>
            
            <div class="jet-specs">
                <div class="jet-spec-item">
                    <span class="jet-spec-label">Capacité</span>
                    <span class="jet-spec-value">{{ $jet->capacity }} passagers</span>
                </div>
                <div class="jet-spec-item">
                    <span class="jet-spec-label">Autonomie</span>
                    <span class="jet-spec-value">{{ number_format($jet->range_km, 0, ',', ' ') }} km</span>
                </div>
            </div>
        </div>

        <!-- Right Section: Reservation Form -->
        <div class="reservation-form-section">
            <h2 class="reservation-form-title">Réserver ce Jet Privé</h2>
            
            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('jet.reserve') }}">
                @csrf
                <input type="hidden" name="jet_id" value="{{ $jet->id }}">
                
                <div class="form-group">
                    <label for="name">Nom complet *</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           placeholder="Votre nom complet" 
                           value="{{ old('name') }}"
                           required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           placeholder="exemple@domaine.com" 
                           value="{{ old('email') }}"
                           required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Téléphone *</label>
                    <input type="tel" 
                           id="phone" 
                           name="phone" 
                           placeholder="Votre numéro de téléphone" 
                           value="{{ old('phone') }}"
                           required>
                </div>
                
                <div class="form-group">
                    <label for="departure">Pays / Ville de départ *</label>
                    <input type="text" 
                           id="departure" 
                           name="departure" 
                           placeholder="Ex: Paris, France" 
                           value="{{ old('departure') }}"
                           required>
                </div>
                
                <div class="form-group">
                    <label for="arrival">Pays / Ville d'arrivée *</label>
                    <input type="text" 
                           id="arrival" 
                           name="arrival" 
                           placeholder="Ex: Marrakech, Maroc" 
                           value="{{ old('arrival') }}"
                           required>
                </div>
                
                <div class="form-group">
                    <label for="departure_datetime">Date et heure de départ *</label>
                    <input type="datetime-local" 
                           id="departure_datetime" 
                           name="departure_datetime" 
                           value="{{ old('departure_datetime') }}"
                           required>
                </div>
                
                <div class="form-group">
                    <label for="message">Message additionnel</label>
                    <textarea id="message" 
                              name="message" 
                              placeholder="Informations supplémentaires (services VIP, bagages...)">{{ old('message') }}</textarea>
                </div>
                
                <button type="submit" class="submit-btn">
                    ENVOYER LA DEMANDE
                </button>
            </form>
        </div>
    </div>
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
