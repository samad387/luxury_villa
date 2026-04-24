@extends('layouts.app')

@section('title', $yacht->name . ' - Yachts')

@section('content')
<style>
    .yacht-detail-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 20px;
        background: #f9f9f9;
    }
    
    .yacht-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 30px;
        font-size: 2rem;
        font-weight: 700;
        color: #2c2c2c;
    }
    
    .yacht-header i {
        font-size: 2.5rem;
        color: #A67C52;
    }
    
    .yacht-content-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 40px;
    }
    
    .yacht-info-section {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    
    .yacht-image-container {
        position: relative;
        width: 100%;
        margin-bottom: 25px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .yacht-image-container img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    
    .yacht-image-container img:hover {
        transform: scale(1.02);
    }
    
    .yacht-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: #A67C52;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f0f0f0;
    }
    
    .yacht-description {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
        margin-bottom: 20px;
    }
    
    .yacht-specs {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-top: 25px;
        padding-top: 25px;
        border-top: 2px solid #f0f0f0;
    }
    
    .yacht-spec-item {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    
    .yacht-spec-label {
        font-size: 0.9rem;
        color: #888;
        font-weight: 500;
    }
    
    .yacht-spec-value {
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
        .yacht-content-wrapper {
            grid-template-columns: 1fr;
        }
        
        .reservation-form-section {
            position: static;
        }
    }
    
    @media (max-width: 768px) {
        .yacht-detail-container {
            padding: 20px 15px;
        }
        
        .yacht-header {
            font-size: 1.5rem;
        }
        
        .yacht-image-container img {
            height: 300px;
        }
        
        .yacht-specs {
            grid-template-columns: 1fr;
        }
        
        .reservation-form-section {
            padding: 25px;
        }
    }
</style>

<div class="yacht-detail-container">
    <div class="yacht-header">
        <i class="fas fa-ship"></i>
        <span>{{ $yacht->name }}</span>
    </div>

    <div class="yacht-content-wrapper">
        <!-- Left Section: Yacht Info & Image -->
        <div class="yacht-info-section">
            @php
                $allImages = collect();
                if($yacht->images->isNotEmpty()) {
                    $allImages = $yacht->images;
                } elseif($yacht->image) {
                    $allImages = collect([(object)['path' => $yacht->image]]);
                }
            @endphp
            
            @if($allImages->isNotEmpty())
                <div class="yacht-image-container">
                    <img id="mainImage" 
                         src="{{ asset('storage/'.$allImages->first()->path) }}" 
                         alt="{{ $yacht->name }}"
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
                             alt="{{ $yacht->name }} - Image {{ $index + 1 }}"
                             onclick="changeImage(this)"
                             class="{{ $index === 0 ? 'active' : '' }}">
                    @endforeach
                </div>
                @endif
            @else
                <div class="yacht-image-container">
                    <div style="width: 100%; height: 400px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-ship" style="font-size: 5rem; color: white; opacity: 0.5;"></i>
                    </div>
                </div>
            @endif
            
            <div class="yacht-price">
                Prix : {{ number_format($yacht->price_per_day, 2, ',', ' ') }} MAD / jour
            </div>
            
            <div class="yacht-description">
                <strong>Description :</strong><br>
                {{ $yacht->description }}
            </div>
            
            <div class="yacht-specs">
                <div class="yacht-spec-item">
                    <span class="yacht-spec-label">Capacité</span>
                    <span class="yacht-spec-value">{{ $yacht->capacity }} passagers</span>
                </div>
                <div class="yacht-spec-item">
                    <span class="yacht-spec-label">Longueur</span>
                    <span class="yacht-spec-value">{{ number_format($yacht->length_meters, 1) }} m</span>
                </div>
            </div>
        </div>

        <!-- Right Section: Reservation Form -->
        <div class="reservation-form-section">
            <h2 class="reservation-form-title">Réserver ce Yacht</h2>
            
            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('yacht.reserve') }}">
                @csrf
                <input type="hidden" name="yacht_id" value="{{ $yacht->id }}">
                
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
                    <label for="departure">Port de départ *</label>
                    <input type="text" 
                           id="departure" 
                           name="departure" 
                           placeholder="Ex: Port de Casablanca" 
                           value="{{ old('departure') }}"
                           required>
                </div>
                
                <div class="form-group">
                    <label for="arrival">Port d'arrivée *</label>
                    <input type="text" 
                           id="arrival" 
                           name="arrival" 
                           placeholder="Ex: Port de Tanger" 
                           value="{{ old('arrival') }}"
                           required>
                </div>
                
                <div class="form-group">
                    <label for="departure_date">Date de départ *</label>
                    <input type="date" 
                           id="departure_date" 
                           name="departure_date" 
                           value="{{ old('departure_date') }}"
                           required>
                </div>
                
                <div class="form-group">
                    <label for="return_date">Date de retour *</label>
                    <input type="date" 
                           id="return_date" 
                           name="return_date" 
                           value="{{ old('return_date') }}"
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

