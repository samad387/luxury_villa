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
    <form id="filterForm" style="display: flex; gap: 15px; flex-wrap: wrap; justify-content: center;">
        <select name="type" id="typeFilter" class="filter-select">
            <option value="">Type</option>
            <option value="villa">Villa</option>
            <option value="riad">Riad</option>
            <option value="appartement">Appartement</option>
        </select>
        <input type="number" name="minPrice" id="minPrice" placeholder="Prix min" class="filter-input">
        <input type="number" name="maxPrice" id="maxPrice" placeholder="Prix max" class="filter-input">
        <input type="number" name="capacity" id="capacityFilter" placeholder="Capacité min" class="filter-input">
        <input type="text" id="searchName" placeholder="Rechercher par nom..." class="filter-input">
        <button type="button" class="filter-button">Filtrer</button>
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
</section>

<!-- Script de filtre -->
@push('scripts')
<script>
    console.log("hello");
    document.addEventListener('DOMContentLoaded', function() {
        // Initial filter application in case of pre-filled filters from URL or refresh
        applyFilters();
            document.querySelector('.filter-button').addEventListener('click',applyFilters);
    });
    document.querySelectorAll('.etablissement').forEach(item => {
        item.addEventListener('click', () => {
            const url = item.getAttribute('data-url');
            if (url) {
                window.location.href = url;
            }
        });
    });
    function applyFilters() {
        const type = document.getElementById('typeFilter').value.toLowerCase();
        const minPrice = parseFloat(document.getElementById('minPrice').value) || 0; // Use parseFloat for prices
        const maxPrice = parseFloat(document.getElementById('maxPrice').value) || Infinity;
        const capacity = parseInt(document.getElementById('capacityFilter').value) || 0;
        const searchName = document.getElementById('searchName').value.toLowerCase();

        const establishments = document.querySelectorAll('.etablissement');

        establishments.forEach(est => {
            const estType = est.getAttribute('data-type');
            const estPrice = parseFloat(est.getAttribute('data-price'));
            const estCapacity = parseInt(est.getAttribute('data-capacity'));
            const estName = est.querySelector('h3').innerText.toLowerCase();

            const matchesType = !type || estType === type;
            const matchesPrice = estPrice >= minPrice && estPrice <= maxPrice;
            const matchesCapacity = estCapacity >= capacity;
            const matchesName = estName.includes(searchName);

            if (matchesType && matchesPrice && matchesCapacity && matchesName) {
                est.style.display = 'block';
            } else {
                est.style.display = 'none';
            }
        });
    }
</script>
@endpush

@endsection
