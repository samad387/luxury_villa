@extends('layouts.app') {{-- Make sure this extends your public app layout --}}

@section('title', 'Établissements de Luxe à Marrakech')

@section('content')

<!-- Hero Section -->
<section style="position: relative; width: 100%; height: 450px; overflow: hidden;">
    <img src="https://www.marrakech-private-resort.com/wp-content/uploads/2018/03/Villa-Royal-Palm-3-5337.jpg"
         alt="Villa de Luxe"
         style="width: 100%; height: 100%; object-fit: cover; filter: brightness(70%);">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: #fff;">
        <h1 style="font-size: 3rem; font-weight: bold; text-shadow: 0 0 10px rgba(0,0,0,0.7);">
            Établissements de Prestige à Marrakech
        </h1>
    </div>
</section>

<!-- Filter Bar -->
<section style="background-color: #fafafa; padding: 30px 20px; border-bottom: 1px solid #ddd;">
    <form id="filterForm" method="GET" action="{{ route('public.establishments.index') }}" style="display: flex; gap: 15px; flex-wrap: wrap; justify-content: center;">
        <select name="type" id="typeFilter" class="filter-select">
            <option value="">Tous les types</option>
            <option value="villa" {{ request('type') == 'villa' ? 'selected' : '' }}>Villa</option>
            <option value="riad" {{ request('type') == 'riad' ? 'selected' : '' }}>Riad</option>
            <option value="appartement" {{ request('type') == 'appartement' ? 'selected' : '' }}>Appartement</option>
        </select>
        <input type="number" name="minPrice" id="minPrice" placeholder="Prix min" class="filter-input" value="{{ request('minPrice') }}">
        <input type="number" name="maxPrice" id="maxPrice" placeholder="Prix max" class="filter-input" value="{{ request('maxPrice') }}">
        <input type="number" name="capacity" id="capacityFilter" placeholder="Capacité min" class="filter-input" value="{{ request('capacity') }}">
        <input type="text" name="searchName" id="searchName" placeholder="Rechercher par nom..." class="filter-input" value="{{ request('searchName') }}">
        <button type="submit" class="filter-button">Filtrer</button>
        @if(request()->hasAny(['type', 'minPrice', 'maxPrice', 'capacity', 'searchName']))
            <a href="{{ route('public.establishments.index') }}" class="filter-button filter-reset">Réinitialiser</a>
        @endif
    </form>
</section>

<!-- Style Global (Can be moved to a CSS file if using Tailwind) -->
<style>
    .filter-select,
    .filter-input {
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
        width: 180px;
    }

    .filter-button {
        background-color: #A67C52;
        color: #fff;
        padding: 10px 25px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s;
    }

    .filter-button:hover {
        background-color: #8B643E;
    }

    .filter-reset {
        background-color: #6c757d !important;
    }

    .filter-reset:hover {
        background-color: #5a6268 !important;
    }

    .etablissement-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
        padding: 60px 20px;
        background-color: #f4f3f2;
    }

    .etablissement {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        transition: transform 0.3s;
    }

    .etablissement:hover {
        transform: translateY(-5px);
    }
    .etablissement-image {
    overflow: hidden;
}

.etablissement-image img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.etablissement:hover .etablissement-image img {
    transform: scale(1.1);
}

    .etablissement-content {
        padding: 20px;
        text-align: left;
    }

    .etablissement h3 {
        font-size: 1.2rem;
        color: #2c2c2c;
        margin-bottom: 10px;
    }

    .etablissement p {
        font-size: 0.95rem;
        color: #555;
    }

    .btn {
        display: inline-block;
        margin-top: 15px;
        background-color: #A67C52;
        color: #fff;
        padding: 10px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
    }

    .btn:hover {
        background-color: #8B643E;
    }

    /* Pagination Styles - Minimalist Professional Design */
    .pagination-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 50px 20px;
        background-color: #f4f3f2;
        gap: 20px;
    }

    .pagination-info {
        color: #555;
        font-size: 0.95rem;
        font-weight: 400;
        margin-bottom: 5px;
        text-align: center;
    }

    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 3px;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }

    .pagination li {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .pagination li a,
    .pagination li span {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 38px;
        height: 38px;
        padding: 0 12px;
        text-decoration: none;
        color: #555;
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        transition: all 0.15s ease;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .pagination li a:hover {
        background-color: #f8f8f8;
        border-color: #A67C52;
        color: #A67C52;
    }

    .pagination li.active span {
        background-color: #A67C52;
        color: #ffffff;
        border-color: #A67C52;
        cursor: default;
        font-weight: 600;
    }

    .pagination li.disabled span {
        color: #ccc;
        background-color: #f9f9f9;
        border-color: #e8e8e8;
        cursor: not-allowed;
        opacity: 0.5;
    }

    .pagination li.disabled span:hover {
        background-color: #f9f9f9;
        border-color: #e8e8e8;
    }

    /* Ultra small Google-style arrows for Previous/Next */
    .pagination li:first-child a,
    .pagination li:first-child span,
    .pagination li:last-child a,
    .pagination li:last-child span {
        min-width: 40px;
        height: 40px;
        padding: 0;
        position: relative;
    }

    .pagination li:first-child a::before,
    .pagination li:last-child a::after {
        content: '';
        position: absolute;
        width: 3px;
        height: 3px;
        border: 0.8px solid currentColor;
        border-top: none;
        border-right: none;
        transition: all 0.15s ease;
    }

    .pagination li:first-child a::before {
        transform: rotate(45deg);
    }

    .pagination li:last-child a::after {
        transform: rotate(-135deg);
    }

    .pagination li:first-child a:hover::before {
        transform: translateX(-1px) rotate(45deg);
    }

    .pagination li:last-child a:hover::after {
        transform: translateX(1px) rotate(-135deg);
    }

    /* Hide text, show only tiny arrows */
    .pagination li:first-child a,
    .pagination li:last-child a {
        font-size: 0;
        text-indent: -9999px;
        overflow: hidden;
    }

    /* Disabled arrows - very small */
    .pagination li:first-child.disabled span::before,
    .pagination li:last-child.disabled span::after {
        content: '';
        position: absolute;
        width: 3px;
        height: 3px;
        border: 0.8px solid #ccc;
        border-top: none;
        border-right: none;
    }

    .pagination li:first-child.disabled span::before {
        transform: rotate(45deg);
    }

    .pagination li:last-child.disabled span::after {
        transform: rotate(-135deg);
    }

    /* Ellipsis styling */
    .pagination li span.dots {
        border: none;
        background: transparent;
        cursor: default;
        color: #999;
        min-width: auto;
        padding: 0 8px;
    }

@media (max-width: 768px) {
  .etablissement-grid {
    grid-template-columns: 1fr !important;
    gap: 20px !important;
    padding: 30px 15px !important;
  }
  .etablissement {
    border-radius: 12px !important;
    box-shadow: 0 6px 16px rgba(0,0,0,0.1) !important;
    margin-bottom: 0 !important;
  }
  .etablissement-image img {
    height: 220px !important;
    border-radius: 12px 12px 0 0 !important;
  }
  .etablissement-content {
    padding: 16px !important;
  }
  .etablissement h3 {
    font-size: 1.15rem !important;
    margin-bottom: 8px !important;
    font-weight: 600 !important;
  }
  .etablissement p {
    font-size: 0.95rem !important;
    margin-bottom: 6px !important;
    line-height: 1.5 !important;
  }
  .btn {
    width: 100%;
    padding: 12px 0 !important;
    font-size: 1rem !important;
    margin-top: 12px !important;
    border-radius: 8px !important;
    text-align: center !important;
  }
  #filterForm {
    flex-direction: column !important;
    gap: 12px !important;
    align-items: stretch !important;
    padding: 20px 15px !important;
  }
  .filter-select, .filter-input {
    width: 100% !important;
    font-size: 1rem !important;
    padding: 12px !important;
    border-radius: 8px !important;
  }
  .filter-button {
    width: 100% !important;
    padding: 14px 0 !important;
    font-size: 1.05rem !important;
    border-radius: 8px !important;
  }
  .pagination-wrapper {
    padding: 35px 12px !important;
    gap: 18px !important;
  }
  .pagination-info {
    font-size: 0.85rem !important;
    line-height: 1.4;
  }
  .pagination {
    padding: 10px 12px !important;
    gap: 4px !important;
  }
  .pagination li a,
  .pagination li span {
    min-width: 36px !important;
    height: 36px !important;
    padding: 0 10px !important;
    font-size: 0.8rem !important;
  }
  .pagination li:first-child a,
  .pagination li:first-child span,
  .pagination li:last-child a,
  .pagination li:last-child span {
    min-width: 36px !important;
    padding: 0 !important;
  }
  .pagination li:first-child a::before,
  .pagination li:last-child a::after,
  .pagination li:first-child.disabled span::before,
  .pagination li:last-child.disabled span::after {
    width: 2.5px !important;
    height: 2.5px !important;
    border-width: 0.8px !important;
  }
  section[style*='height: 450px'] {
    height: 200px !important;
  }
  section[style*='height: 450px'] h1 {
    font-size: 1.4rem !important;
    padding: 0 15px !important;
    line-height: 1.3 !important;
  }
}

@media (max-width: 480px) {
  .etablissement-grid {
    gap: 16px !important;
    padding: 20px 12px !important;
  }
  .etablissement {
    border-radius: 10px !important;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
  }
  .etablissement-image img {
    height: 200px !important;
    border-radius: 10px 10px 0 0 !important;
  }
  .etablissement-content {
    padding: 14px !important;
  }
  .etablissement h3 {
    font-size: 1.1rem !important;
    margin-bottom: 6px !important;
  }
  .etablissement p {
    font-size: 0.9rem !important;
    margin-bottom: 5px !important;
  }
  .btn {
    padding: 11px 0 !important;
    font-size: 0.95rem !important;
    margin-top: 10px !important;
  }
  #filterForm {
    padding: 15px 12px !important;
    gap: 10px !important;
  }
  .filter-select, .filter-input {
    padding: 11px !important;
    font-size: 0.95rem !important;
  }
  .filter-button {
    padding: 12px 0 !important;
    font-size: 1rem !important;
  }
  section[style*='height: 450px'] {
    height: 180px !important;
  }
  section[style*='height: 450px'] h1 {
    font-size: 1.2rem !important;
    padding: 0 12px !important;
  }
}

@media (max-width: 360px) {
  .etablissement-grid {
    gap: 14px !important;
    padding: 16px 10px !important;
  }
  .etablissement-image img {
    height: 180px !important;
  }
  .etablissement-content {
    padding: 12px !important;
  }
  .etablissement h3 {
    font-size: 1.05rem !important;
  }
  .etablissement p {
    font-size: 0.88rem !important;
  }
  section[style*='height: 450px'] {
    height: 160px !important;
  }
  section[style*='height: 450px'] h1 {
    font-size: 1.1rem !important;
  }
  .pagination-wrapper {
    padding: 40px 15px !important;
    gap: 20px !important;
  }
  .pagination-info {
    font-size: 0.9rem !important;
    text-align: center;
    padding: 0 10px;
    line-height: 1.5;
  }
  .pagination {
    gap: 6px !important;
    padding: 12px 15px !important;
    border-radius: 12px !important;
  }
  .pagination li a,
  .pagination li span {
    min-width: 40px !important;
    height: 40px !important;
    padding: 0 12px !important;
    font-size: 0.85rem !important;
    border-radius: 10px !important;
  }
  .pagination li:first-child a,
  .pagination li:first-child span,
  .pagination li:last-child a,
  .pagination li:last-child span {
    min-width: 40px !important;
    padding: 0 !important;
  }
  .pagination li:first-child a::before,
  .pagination li:last-child a::after {
    width: 7px !important;
    height: 7px !important;
  }
}
</style>

<!-- Établissements -->
<section>
    <div id="establishmentList" class="etablissement-grid">
    @forelse ($establishments as $e)
    <div class="etablissement"
    data-type="{{ $e->type }}"
    data-price="{{ $e->price }}"
    data-capacity="{{ $e->capacity }}"
    data-url="{{ $e->detail_route }}"
    style="cursor: pointer;">
    
    <div class="etablissement-image">
        <img src="{{ asset('storage/' . $e->display_image) }}" alt="{{ $e->name }}">
    </div>

    <div class="etablissement-content">
        <h3>{{ $e->name }}</h3>
        <p><strong>Prix :</strong> {{ number_format($e->price, 2) }} MAD</p>
        <p><strong>Capacité :</strong> {{ $e->capacity }} personnes</p>
        <span class="btn">Voir Détails</span>
    </div>
</div>
@empty
    <p>Aucun établissement trouvé.</p>
@endforelse

    </div>
    
    <!-- Pagination -->
    @if($establishments->hasPages())
    <div class="pagination-wrapper">
        <div class="pagination-info">
            <span style="color: #A67C52; font-weight: 600;">Affichage de {{ $establishments->firstItem() }} à {{ $establishments->lastItem() }}</span>
            <span style="color: #888; margin: 0 8px;">sur</span>
            <span style="color: #333; font-weight: 600;">{{ $establishments->total() }} établissement(s)</span>
        </div>
        <div class="pagination-container">
            {{ $establishments->links() }}
        </div>
    </div>
    @endif
</section>

<!-- Script -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle establishment card clicks
        document.querySelectorAll('.etablissement').forEach(item => {
            item.addEventListener('click', () => {
                const url = item.getAttribute('data-url');
                if (url) {
                    window.location.href = url;
                }
            });
        });

        // Auto-submit form on Enter key in search field
        const searchInput = document.getElementById('searchName');
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    document.getElementById('filterForm').submit();
                }
            });
        }
    });
</script>
@endpush

@endsection
