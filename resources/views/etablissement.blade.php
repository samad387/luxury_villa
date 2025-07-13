@extends('layouts.app')

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
        <button type="button" onclick="applyFilters()" class="filter-button">Filtrer</button>
    </form>
</section>

<!-- Style Global -->
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
        grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
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

    .etablissement img {
        width: 100%;
        height: 200px;
        object-fit: cover;
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
        @php
            $establishments = [
                ['name' => 'Villa 3', 'type' => 'villa', 'price' => 550, 'capacity' => 8, 'img' => 'https://elitemarrakech.com/wp-content/uploads/2021/09/555-0212311d.jpeg'],
                ['name' => 'Villa 4', 'type' => 'villa', 'price' => 600, 'capacity' => 10, 'img' => 'https://elitemarrakech.com/wp-content/uploads/2019/10/22-bed-feat.jpg'],
                ['name' => 'Villa 5', 'type' => 'villa', 'price' => 480, 'capacity' => 6, 'img' => 'https://elitemarrakech.com/wp-content/uploads/2021/09/IMG-20170110-WA0092.jpg'],
                ['name' => 'Villa 6', 'type' => 'villa', 'price' => 530, 'capacity' => 9, 'img' => 'https://elitemarrakech.com/wp-content/uploads/2021/09/IMG-20170110-WA0107.jpg'],
                ['name' => 'Villa 7', 'type' => 'villa', 'price' => 590, 'capacity' => 8, 'img' => 'https://elitemarrakech.com/wp-content/uploads/2021/09/Marrakech_DarSayang_41.jpg'],
                ['name' => 'Villa 8', 'type' => 'villa', 'price' => 590, 'capacity' => 9, 'img' => 'https://www.essaadi.com/wp-content/uploads/villa-casablanca-1140x424-1.jpg.webp'],
                ['name' => 'Riad Andalou', 'type' => 'riad', 'price' => 220, 'capacity' => 4, 'img' => 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/10/f2/d6/02/hotel-spa-riad-dar-sara.jpg?w=900&h=500&s=1'],
                ['name' => 'Riad Shéhérazade', 'type' => 'riad', 'price' => 180, 'capacity' => 3, 'img' => 'https://static-service-voyages.b-cdn.net/photos/vacances/Marrakech/vue_747517_pgbighd.jpg'],
                ['name' => 'Riad El Medina', 'type' => 'riad', 'price' => 250, 'capacity' => 5, 'img' => 'https://unsacsurledos.com/wp-content/uploads/2023/03/riad-berbere-marrakech.jpeg'],
                ['name' => 'Riad Jasmine', 'type' => 'riad', 'price' => 200, 'capacity' => 4, 'img' => 'https://www.riad-vendome-marrakech.com/images/selection%20page%20riad%20marrakech/riad-marrakech-medina.JPG'],
                ['name' => 'Riad Azur', 'type' => 'riad', 'price' => 190, 'capacity' => 3, 'img' => 'https://riads.ch/photos/riad-tzarra-patio-nuit.jpg'],
                ['name' => 'Appartement Vista', 'type' => 'appartement', 'price' => 120, 'capacity' => 2, 'img' => 'https://q-xx.bstatic.com/xdata/images/hotel/max1024x768/590209545.jpg?k=c518422dc07f20b390325f1cd912bb2bfd3ac900c056e85fc32cb9d2a63f34e0&o='],
                ['name' => 'Appartement Medina Loft', 'type' => 'appartement', 'price' => 150, 'capacity' => 3, 'img' => 'https://img.freepik.com/photos-gratuite/bangkok-thailande-12-aout-2016-belle-luxe-salon_1203-2345.jpg?semt=ais_hybrid&w=740'],
                ['name' => 'Appartement Soleil', 'type' => 'appartement', 'price' => 100, 'capacity' => 2, 'img' => 'https://img.freepik.com/photos-gratuite/elegante-chambre-hotel-fenetre_1203-1492.jpg'],
                ['name' => 'Appartement Palms', 'type' => 'appartement', 'price' => 130, 'capacity' => 3, 'img' => 'https://www.dubai-hotels-now.com/data/Pics/OriginalPhoto/16284/1628471/1628471327/pic-dubai-17.JPEG'],
                ['name' => 'Appartement Atlas Sky', 'type' => 'appartement', 'price' => 110, 'capacity' => 2, 'img' => 'https://q-xx.bstatic.com/xdata/images/hotel/max500/599765776.jpg?k=88547aa78e4ee14de18fc682a1f48bb8903692301ba69c6024b0e84d9aa19ce8&o='],
            ];
        @endphp

        @foreach ($establishments as $e)
            <div class="etablissement" 
                data-type="{{ $e['type'] }}" 
                data-price="{{ $e['price'] }}" 
                data-capacity="{{ $e['capacity'] }}" 
                href="{{ route('villa4') }}"
                >
                <img src="{{ $e['img'] }}" alt="{{ $e['name'] }}">
                <div class="etablissement-content">
                    <h3>{{ $e['name'] }}</h3>
                    <p><strong>Prix :</strong> {{ $e['price'] }} $</p>
                    <p><strong>Capacité :</strong> {{ $e['capacity'] }} personnes</p>
                    <a href="{{ route('villa4') }}" class="btn">Voir Détails</a>
                </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Script de filtre -->
<script>
    function applyFilters() {
        const type = document.getElementById('typeFilter').value.toLowerCase();
        const minPrice = parseInt(document.getElementById('minPrice').value) || 0;
        const maxPrice = parseInt(document.getElementById('maxPrice').value) || Infinity;
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

@endsection
