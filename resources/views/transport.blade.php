@extends('layouts.app')

@section('title', 'Transport')

@section('content')

<!-- Image en haut avec texte centré -->
<section style="position: relative; width: 100%; height: 400px; overflow: hidden;">
    <img src="https://istanbullimo.com/images/modules/mercedes-vip-vito-chauffeur-service.jpg" 
         alt="Transport à Marrakech" 
         style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white;">
        <h2 style="font-size: 2.5rem; margin-bottom: 20px;">Nos Services de Transport à Marrakech</h2>
    </div>
</section>

<!-- Section des Services de Transport avec Filtre -->
<section style="padding: 60px 20px; background-color: #f8f9fa;">
    <div style="margin-bottom: 30px; text-align: center;">
        <!-- Filtre Type de Transport -->
        <select id="transportFilter" style="padding: 10px 20px; font-size: 1rem; border-radius: 5px; border: 1px solid #ddd;">
            <option value="all">Tous les Types</option>
            <option value="suv">SUV</option>
            <option value="lux">LUX</option>
            <option value="economique">ÉCONOMIQUE</option>
            <option value="moto">MOTO</option>
            <option value="chauffeur">CHAUFFEUR</option>
        </select>
    </div>

    <div class="transport-list" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; text-align: center;">

        <!-- SUV 1 -->
        <div class="transport-item suv" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://res.cloudinary.com/unix-center/image/upload/c_limit,dpr_3.0,f_auto,fl_progressive,g_center,h_580,q_75,w_906/lgmrqoqbrtrxovayjjqa.jpg" alt="SUV 1" style="width: 100%; height: 300px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">PORSHE MACAN</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Profitez du confort et de la puissance de ce SUV premium.</p>
                <a href="{{ route('porshmacan') }}" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- SUV 2 -->
        <div class="transport-item suv" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://glide.netfpn.net/carshop/75967ed03ba602fe49c63218f699e6729e25a3e3af888b395a58641b4c0e582692818b8302c405684c17dbe2e363dd4cb1e38c4a20c8ef4c7b1be87978f93341e223755d1376f932_2?fm=jpg&h=639" alt="SUV 2" style="width: 100%; height: 300px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">AUDI Q8</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Explorez Marrakech avec ce SUV tout terrain.</p>
                <a href="{{ route('audiq8') }}" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- SUV 3 -->
        <div class="transport-item suv" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://ymimg1.b8cdn.com/uploads/article/8397/pictures/8880637/touareg_r_line-5.jpg" alt="SUV 3" style="width: 100%; height: 300px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">TOUAREG</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Voyagez dans le luxe avec ce SUV haut de gamme.</p>
               <a href="{{ route('touareg') }}" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- LUX 1 -->
        <div class="transport-item lux" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://prod.pictures.autoscout24.net/listing-images/1dcac22e-f4b4-459d-b193-51017e0cbf25_f1c54a98-f061-4770-99a5-f28e76200c77.jpg/1920x1080.webp" alt="LUX 1" style="width: 100%; height: 300px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Mercedes Classe A35d</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Vivez une expérience de conduite luxueuse avec cette voiture.</p>
                <a href="{{ route('mercedesclassea35d') }}"class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- LUX 2 -->
        <div class="transport-item lux" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://www.volkswagen.ma/content/dam/onehub_master/pc/models/golf-models-(2024)/golf-hatchback/exterior/GL6287_Golf_exterior_IQ-Light_front_view_16-91.jpg" alt="LUX 2" style="width: 100%; height: 300px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">GOLF 8</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Un véhicule sportif pour les amateurs de vitesse.</p>
                <a href="{{ route('golf8') }}" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- LUX 3 -->
        <div class="transport-item lux" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://listing-images.autoscout24.ch/686/12334686/2048535961.jpeg?w=1920&q=90" alt="LUX 3" style="width: 100%; height: 300px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Range Rover  Velar</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Roulez sous le soleil avec notre cabriolet de luxe.</p>
                <a href="{{ route('rangerovervelar') }}" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- ÉCONOMIQUE 1 -->
        <div class="transport-item economique" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://www.coraliacars.com/wp-content/uploads/2024/09/Renault-Clio-5-1.webp" alt="ÉCONOMIQUE 1" style="width: 100%; height: 300px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Clio 5</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Une option économique pour vos trajets à Marrakech.</p>
                <a href="{{ route('clio5') }}"class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- ÉCONOMIQUE 2 -->
        <div class="transport-item economique" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://cdn-ldfbn.nitrocdn.com/tpQGFHLertYHnXBeEUPRtFmbpmRbBIRa/assets/images/optimized/rev-714e5fa/www.hurento.ma/wp-content/uploads/2023/12/Dacia-Logan-main.jpg" alt="ÉCONOMIQUE 2" style="width: 100%; height: 300px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Dacia</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Une voiture compacte à prix abordable.</p>
                <a href="{{ route('dacia') }}"class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- ÉCONOMIQUE 3 -->
        <div class="transport-item economique" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://cdn-ldfbn.nitrocdn.com/tpQGFHLertYHnXBeEUPRtFmbpmRbBIRa/assets/images/optimized/rev-714e5fa/www.hurento.ma/wp-content/uploads/2024/01/Fiat-Tipo.jpg" alt="ÉCONOMIQUE 3" style="width: 100%; height: 300px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Fiat</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Idéale pour les déplacements urbains à petit prix.</p>
                <a href="{{ route('fiat') }}"class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- MOTO 1 -->
        <div class="transport-item moto" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://media.motoservices.com/media/cache/vehicle_detail/media/vehicle/1600/2017_yam_xp500a_eu_smx_stu_001_03.jpg" alt="MOTO 1" style="width: 100%; height: 300px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">Tmax 530 DX</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Explorez la ville à moto, facile et rapide.</p>
                <a href="{{ route('tmax530dx') }}"class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- MOTO 2 -->
        <div class="transport-item moto" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://www.tuningblog.eu/wp-content/uploads/2021/11/Honda-SH150i-Modelljahr-2022-3.jpg" alt="MOTO 2" style="width: 100%; height: 300px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">SH 150i</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Vitesse et adrénaline avec cette moto sportive.</p>
                <a href="{{ route('sh150i') }}"class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- MOTO 3 -->
        <div class="transport-item moto" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://www.xadvshop.com/img/cms/443774_24YM_X-ADV.jpg" alt="MOTO 3" style="width: 100%; height: 300px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">XADV</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Idéale pour circuler facilement dans Marrakech.</p>
                <a href="{{ route('xadv') }}"class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

        <!-- chauffeur 1 -->
        <div class="transport-item chauffeur" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://rakadventuremarrakech.com/wp-content/uploads/2021/08/transport1.jpg" alt="chauffeur 1" style="width: 100%; height: 300px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">VIP CHAUFFEUR -> 3 PERSON</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Profitez du confort et de la puissance de ce SUV premium.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

         <!-- chauffeur 2 -->
        <div class="transport-item chauffeur" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://grinda-maroc.com/wp-content/uploads/2021/06/mercedes-touristique-768x384.jpg" alt="chauffeur 1" style="width: 100%; height: 300px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">VIP CHAUFFEUR -> GROUP</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Profitez du confort et de la puissance de ce SUV premium.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

         <!-- chauffeur 3 -->
        <div class="transport-item chauffeur" style="background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <img src="https://vtc-maroc.org/wp-content/uploads/2025/03/driver-800x450.jpg" alt="chauffeur 1" style="width: 100%; height: 300px; object-fit: cover;">
            <div style="padding: 20px;">
                <h3 style="font-size: 1.8rem; margin-bottom: 10px;">VIP LUX -> 1 PERSON</h3>
                <p style="font-size: 1rem; color: #777; margin-bottom: 15px;">Profitez du confort et de la puissance de ce SUV premium.</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">Voir Détails</a>
            </div>
        </div>

    </div>
</section>

<script>
    // JavaScript pour filtrer les éléments en fonction du type de transport sélectionné
    document.getElementById('transportFilter').addEventListener('change', function() {
        var filterValue = this.value;
        var items = document.querySelectorAll('.transport-item');
        
        items.forEach(function(item) {
            if (filterValue === 'all' || item.classList.contains(filterValue)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>

@endsection
