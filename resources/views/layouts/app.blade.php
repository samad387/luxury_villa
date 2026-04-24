<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '') | Keys Royal Marrakech</title>
    
    <!-- Bootstrap + Google Font + FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <link rel="icon" type="image/png" href="/image/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/image/favicon.svg" />
    <link rel="shortcut icon" href="/image/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/image/apple-touch-icon.png" />
    <link rel="manifest" href="/image/site.webmanifest" />
    @stack('styles') {{-- For page-specific styles --}}
   <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
    }

    /* ================= NAVBAR ================= */
    .navbar {
        background-color: #ffffff;
        border-bottom: 1px solid #e5e5e5;
        padding: 1rem 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
    }

    .navbar-brand {
        font-family: 'Cinzel', serif;
        font-size: 1.8rem;
        font-weight: 600;
        color: #d4af37 !important;
        display: flex;
        align-items: center;
        letter-spacing: 1px;
    }

    .navbar-brand i {
        margin-right: 8px;
    }

    /* ================= NAV LINKS ================= */
    .nav-link {
        font-family: 'Cinzel', serif;
        font-size: 1rem;
        color: #2c2c2c !important;
        position: relative;
        padding: 0.5rem 1rem;
        transition: all 0.35s ease;
    }

    /* Ligne dorée animée */
    .nav-link::after {
        content: '';
        position: absolute;
        width: 0%;
        height: 2px;
        left: 0;
        bottom: -4px;
        background: linear-gradient(90deg, #d4af37, #b08d2d);
        transition: width 0.35s ease;
    }

    /* Hover GOLD */
    .nav-link:hover {
        color: #d4af37 !important;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    /* ================= DROPDOWN ================= */
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }

    .dropdown-menu {
        background-color: #ffffff;
        border: 1px solid #eee;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        border-radius: 10px;
        min-width: 200px;
        padding: 8px 0;
    }

    /* Dropdown items */
    .dropdown-item {
        font-size: 0.95rem;
        font-weight: 500;
        color: #2c2c2c;
        padding: 12px 20px;
        transition: all 0.3s ease;
        position: relative;
    }

    /* Hover GOLD PRO */
    .dropdown-item:hover {
        background: linear-gradient(135deg, #d4af37, #b08d2d);
        color: #ffffff;
        padding-left: 26px;
    }

    /* Effet premium : petite barre dorée */
    .dropdown-item::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 50%;
        width: 0;
        height: 2px;
        background-color: #ffffff;
        transition: width 0.3s ease;
        transform: translateY(-50%);
    }

    .dropdown-item:hover::before {
        width: 10px;
    }

    /* Actif dropdown */
    .nav-item.dropdown:hover .nav-link {
        color: #d4af37 !important;
    }

    /* ================= SOCIAL ICONS ================= */
    .social-icons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-top: 20px;
    }

    .social-icons a img {
        width: 32px;
        height: 32px;
        transition: transform 0.3s ease;
    }

    .social-icons a:hover img {
        transform: scale(1.15);
    }

    /* ================= FOOTER ================= */
    footer {
        font-size: 0.9rem;
        text-align: center;
        padding: 2rem 0;
        color: #777;
        background-color: #f9f9f9;
        border-top: 1px solid #e5e5e5;
    }

    /* ================= WHATSAPP ================= */
    .whatsapp-float {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #25D366;
        color: white;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        font-size: 30px;
        box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
        z-index: 100;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: transform 0.3s ease;
    }

    .whatsapp-float:hover {
        transform: scale(1.1);
    }

    .navbar.sticky-top {
        z-index: 999;
    }

    /* ================= RESPONSIVE ================= */
    @media (max-width: 900px) {
        .nav-link, .dropdown-item {
            font-size: 1.05rem;
        }
        .navbar-brand {
            font-size: 1.4rem;
        }
    }

    @media (max-width: 768px) {
        .dropdown-menu {
            min-width: 100vw;
            left: -16px !important;
            border-radius: 0 0 14px 14px;
        }
        .nav-link, .dropdown-item {
            padding: 1rem 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .navbar-brand {
            font-size: 1.1rem;
        }
    }
</style>

</head>

<script src="//code.tidio.co/tnetks97y0lcrhuj9xegwjcbt60q9zms.js" async></script>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <!-- <i class="fas fa-key"></i>Keys Royal -->
                <img src="/image/KeysRoyal-logo.png" alt="Keys Royal" style="height: 60px; width: auto; padding-top: 0px; padding-left: 12px; margin-top: -10px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Accueil</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('public.establishments.index') }}" id="etablissementDropdown">
                            Hébergement
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="etablissementDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('public.establishments.index') }}">
                                    <i class="fas fa-building me-2"></i>Tous les établissements
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('public.establishments.index', ['type' => 'villa']) }}">
                                    <i class="fas fa-home me-2"></i>Villa
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('public.establishments.index', ['type' => 'riad']) }}">
                                    <i class="fas fa-building me-2"></i>Riad
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('public.establishments.index', ['type' => 'appartement']) }}">
                                    <i class="fas fa-door-open me-2"></i>Appartement
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('jet.index') }}" class="nav-link">
                            ✈️ <span>Jets Privés</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('yacht.index') }}" class="nav-link">
                            ⛵ <span>Yachts</span>
                        </a>
                    </li>

                    
                    <li class="nav-item"><a class="nav-link" href="{{ route('activite') }}">Activités</a></li>
                    <!--
                    <li class="nav-item"><a class="nav-link" href="{{ route('pack') }}">Packs</a></li>
                    -->
                    <!-- Ajout du menu déroulant Transport -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="transportDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Transport
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="transportDropdown">
                            <li><a class="dropdown-item" href="{{ route('location_voiture') }}"><i class="fas fa-car-side me-2"></i>Location Voiture</a></li>
                            <li><a class="dropdown-item" href="{{ route('location_moto') }}"><i class="fas fa-motorcycle me-2"></i>Location Moto</a></li>
                            <li><a class="dropdown-item" href="{{ route('vip_transport') }}"><i class="fas fa-crown me-2"></i>VIP Transport</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/212609969986?text=Bonjour%2C%20je%20suis%20int%C3%A9ress%C3%A9%20par%20vos%20services%20de%20conciergerie%20%C3%A0%20Marrakech" class="whatsapp-float" target="_blank" title="Discuter sur WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-whatsapp" viewBox="0 0 16 16">
            <path d="M13.601 2.326A7.548 7.548 0 0 0 8.003.026a7.518 7.518 0 0 0-6.446 11.29L.165 16l4.783-1.352a7.528 7.528 0 0 0 3.052.666h.003a7.548 7.548 0 0 0 5.598-12.988ZM8.003 14.5a6.47 6.47 0 0 1-3.167-.85l-.227-.128-2.837.801.805-2.77-.147-.24a6.478 6.478 0 1 1 5.573 3.187Zm3.688-4.783c-.202-.101-1.195-.59-1.38-.657-.185-.068-.32-.101-.455.101-.134.202-.522.656-.64.79-.117.134-.235.151-.437.05-.202-.101-.853-.314-1.623-1a6.057 6.057 0 0 1-1.123-1.396c-.118-.202-.013-.312.089-.413.091-.09.202-.235.303-.353.101-.117.134-.202.202-.337.067-.134.034-.252-.017-.353-.051-.101-.455-1.094-.623-1.497-.164-.394-.331-.34-.455-.346l-.388-.007c-.118 0-.31.044-.472.202s-.62.605-.62 1.478.635 1.715.724 1.833c.089.118 1.244 1.9 3.017 2.662.422.182.75.29 1.006.372.422.134.806.115 1.11.07.339-.05 1.04-.425 1.188-.836.148-.412.148-.765.103-.836-.045-.07-.185-.117-.387-.218Z"/>
        </svg>
    </a>
    <footer style="background-color: #0b0b0b; color: #dcdcdc; padding: 100px 30px; font-family: 'Poppins', sans-serif; border-top: 1px solid rgba(255,255,255,0.05);">
  <div style="max-width: 1200px; margin: auto; display: flex; flex-wrap: wrap; gap: 60px; justify-content: space-between;">
    
    <!-- À propos -->
    <div style="flex: 1 1 300px;">
      <h3 style="margin-bottom: 30px; color: #fff; font-size: 1.6rem; font-weight: 600; letter-spacing: 1px;">À propos</h3>
      <p style="line-height: 1.9; color: #bbb; font-size: 1rem;">
        <strong style="color: #fff;">Royal Key Marrakech</strong> est votre conciergerie de luxe spécialisée dans la location de villas haut de gamme et l’organisation d’expériences inoubliables au cœur de Marrakech.
      </p>
    </div>

    <!-- Liens -->
    <div style="flex: 1 1 320px;">
      <h3 style="margin-bottom: 30px; color: #fff; font-size: 1.6rem; font-weight: 600; letter-spacing: 1px;">Liens utiles</h3>
      <ul style="list-style: none; padding: 0; margin: 0;">
        <li style="margin-bottom: 12px;"><a href="{{ route('public.establishments.index') }}" style="color: #aaa; text-decoration: none; transition: color 0.3s;">Établissements</a></li>
        <li style="margin-bottom: 12px;"><a href="{{ route('activite') }}" style="color: #aaa; text-decoration: none; transition: color 0.3s;">Activités</a></li>
        <!--
        <li style="margin-bottom: 12px;"><a href="{{ route('pack') }}" style="color: #aaa; text-decoration: none; transition: color 0.3s;">Packs</a></li>
        -->
        <li style="margin-bottom: 12px;"><a href="{{ route('transport') }}" style="color: #aaa; text-decoration: none; transition: color 0.3s;">Transports</a></li>
        <li style="margin-bottom: 12px;"><a href="{{ route('contact') }}" style="color: #aaa; text-decoration: none; transition: color 0.3s;">Contact</a></li>
      </ul>
    </div>

    <!-- Contact -->
    <div style="flex: 1 1 300px;">
      <h3 style="margin-bottom: 30px; color: #fff; font-size: 1.6rem; font-weight: 600; letter-spacing: 1px;">Contact</h3>
      <p style="margin-bottom: 10px;">📧 <a href="mailto:abdessamad777gt@gmail.com" style="color: #bbb; text-decoration: none;">abdessamad777gt@gmail.com</a></p>
      <p style="margin-bottom: 10px;">📞 <a href="tel:+212609969986" style="color: #bbb; text-decoration: none;">+212 6 09 96 99 86</a></p>
      <p style="margin-bottom: 10px;">📞 <a href="tel:+212654808623" style="color: #bbb; text-decoration: none;">+212 6 54 80 86 23</a></p>
      <p style="margin-bottom: 10px;">📍 Avenue Mohammed VI, Marrakech</p>
    </div>
  </div>

  <div class="social-icons">
 
 <a href="https://www.facebook.com/profile.php?id=61576387873427" target="_blank" title="Facebook">
    <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png
" alt="Facebook">
  </a>
  <a href="https://instagram.com/prestige_villa_marrakech" target="_blank" title="Instagram">
    <img src="https://cdn-icons-png.flaticon.com/512/733/733558.png" alt="Instagram">
  </a>
  <a href="https://www.tiktok.com/@luxury_villa_marrakech" target="_blank" title="TikTok">
  <img src="https://cdn.simpleicons.org/tiktok/FFFFFF" alt="TikTok">
 
  <a href="https://www.snapchat.com/@vip_marrakech" target="_blank" title="Snapchat">
  <img src="https://cdn.simpleicons.org/snapchat/FFFC00" alt="Snapchat">
</a>

  
</div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Leaflet JS for Map -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
    @stack('scripts')
</body>
</html>
