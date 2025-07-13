@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

<style>
    .hero-video-section {
        position: relative;
        width: 100%;
        height: 85vh;
        overflow: hidden;
        font-family: 'Playfair Display', serif;
    }

    .hero-video-section video {
        position: absolute;
        top: 0; left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
    }

    .hero-video-section::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.45);
        z-index: 1;
        pointer-events: none;
    }

    .hero-video-texts {
        position: absolute;
        top: 25%;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
        color: #fff;
        z-index: 2;
        max-width: 90%;
        text-shadow: 0 2px 6px rgba(0, 0, 0, 0.85), 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .hero-video-texts h1 {
        font-size: 3.5rem;
        margin-bottom: 15px;
        font-weight: 900;
        letter-spacing: 2px;
        text-transform: uppercase;
        line-height: 1.1;
    }

    .hero-video-texts h2 {
        font-size: 1.75rem;
        font-weight: 400;
        max-width: 700px;
        margin: 0 auto;
        letter-spacing: 1px;
        font-style: italic;
        opacity: 0.85;
    }

    .hero-video-buttons {
        position: absolute;
        top: 60%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        gap: 20px;
        z-index: 3;
        flex-wrap: wrap;
        justify-content: center;
    }

    .hero-video-button {
        padding: 14px 28px;
        font-size: 1.1rem;
        font-weight: 700;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }

    .hero-video-button.contact {
        background-color: #28a745;
        color: white;
        border: none;
    }

    .hero-video-button.view-villas {
        background-color: white;
        color: black;
        border: 2px solid white;
    }

    .hero-video-button:hover {
        opacity: 0.9;
        box-shadow: 0 6px 12px rgba(0,0,0,0.4);
    }

    @media (max-width: 768px) {
        .hero-video-section {
            height: 60vh;
        }

        .hero-video-texts h1 {
            font-size: 2.2rem;
        }

        .hero-video-texts h2 {
            font-size: 1.1rem;
            max-width: 90vw;
        }

        .hero-video-buttons {
            flex-direction: column;
            gap: 12px;
        }
    }
</style>

<div class="hero-video-section" aria-label="Vidéo de présentation de villa">
    <video class="active" autoplay muted loop playsinline>
        <source src="{{ asset('image/villa.mp4') }}" type="video/mp4">
        Votre navigateur ne supporte pas la lecture vidéo.
    </video>

    <div class="hero-video-texts">
        <h1>Magnifiques Villas à Marrakech</h1>
        <h2>Réservez votre villa de vacances avec Royal Key Marrakech aujourd'hui.</h2>
    </div>

    <div class="hero-video-buttons">
        <a href="{{ route('contact') }}" target="_blank" class="hero-video-button contact" role="button" aria-label="Contactez-nous">Contactez-nous</a>
        <a href="{{ route('public.establishments.index') }}" class="hero-video-button view-villas" role="button" aria-label="Voir les villas">Voir les Villas</a>
    </div>
</div>



<!-- Espace entre le carousel et cette section -->
<div style="height: 60px;"></div>

<!-- Section texte avec fond dégradé élégant et ombre portée -->
<div style="
    text-align: center; 
    padding: 60px 30px; 
    max-width: 900px; 
    margin: auto; 
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    font-family: 'Georgia', serif;
">
    <h2 style="
        font-size: 3.5rem; 
        font-weight: bold; 
        margin-bottom: 30px; 
        color: #2a2a2a; 
        text-transform: uppercase; 
        letter-spacing: 2px;
        ">
        Luxury Marrakech Holiday Villas
    </h2>
    <p style="
        font-size: 1.3rem; 
        color: #444; 
        line-height: 1.8; 
        font-family: 'Helvetica Neue', sans-serif; 
        max-width: 800px; 
        margin: 0 auto;
        ">
        If you're looking for an exceptional luxury villa experience in Marrakech, you've found the right place. 
        Elite Marrakech offers a selection of handpicked, exquisite villas perfect for large groups. 
        Whether you're planning a relaxing family vacation, or hosting a vibrant stag or hen party, we provide the ideal solution tailored to your desires and expectations.
    </p>
</div>




<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Inter:wght@400;600&display=swap');

    .section-conciergerie {
        background-color: #f9f9f9;
        padding: 80px 200px;
        font-family: 'Inter', sans-serif;
    }

    .section-conciergerie h2 {
        font-family: 'Playfair Display', serif;
        font-size: 49px;
        text-align: center;
        margin-bottom: 70px;
        color: #1c1c1c;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    

    .grid-conciergerie {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 50px;
        max-width: 1200px;
        margin: auto;
    }

    .carte-conciergerie {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        transform: translateY(50px);
        opacity: 0;
        transition: all 0.9s ease;
    }

    .carte-conciergerie.visible {
        transform: translateY(0);
        opacity: 1;
    }

    .carte-conciergerie img {
        width: 100%;
        height: 320px;
        object-fit: cover;
        transition: transform 0.5s ease, filter 0.5s ease;
    }

    .carte-conciergerie:hover img {
        transform: scale(1.07);
        filter: brightness(0.8);
    }

    .texte-categorie {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 25px;
        background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
        color: #fff;
        font-size: 24px;
        font-weight: 600;
        font-family: 'Playfair Display', serif;
        text-align: center;
        text-shadow: 0 1px 3px rgba(0,0,0,0.6);
        text-transform: uppercase;
    }

    @media (max-width: 768px) {
        .grid-conciergerie {
            grid-template-columns: 1fr;
        }

        .carte-conciergerie img {
            height: 250px;
        }

        .texte-categorie {
            font-size: 20px;
        }

       
    }
</style>

<section class="section-conciergerie" id="categories">
    <h2>Nos Services de Conciergerie</h2>
    <div class="grid-conciergerie">
        <a href="{{ route('public.establishments.index') }}" class="carte-conciergerie" data-delay="0">
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=900&q=80" alt="Établissement à Marrakech">
            <div class="texte-categorie">Hebergement</div>
        </a>

        <a href="{{ route('activite') }}" class="carte-conciergerie" data-delay="200">
            <img src="https://elitemarrakech.com/wp-content/uploads/2021/10/activities.jpg" alt="Activités à Marrakech">
            <div class="texte-categorie">Activité</div>
        </a>

        <a href="{{ route('pack') }}" class="carte-conciergerie" data-delay="400">
            <img src="https://dubai-immo.com/wp-content/uploads/2024/05/PALMIERA-2-villa-dubai.png" alt="Pack de séjour">
            <div class="texte-categorie">Pack Séjour</div>
        </a>

        <a href="{{ route('transport') }}" class="carte-conciergerie" data-delay="600">
            <img src="https://votrechauffeur.ma/assets/images/blog/b3665-chauffeur-vtc-001.jpg" alt="Transport de luxe">
            <div class="texte-categorie">Transport</div>
        </a>
    </div>
</section>

<script>
    // Animation lors du scroll
    document.addEventListener('DOMContentLoaded', () => {
        const cartes = document.querySelectorAll('.carte-conciergerie');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const delay = parseInt(entry.target.getAttribute('data-delay')) || 0;
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, delay);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.4
        });

        cartes.forEach(carte => {
            observer.observe(carte);
        });
    });
</script>





<script>
    const images = document.querySelectorAll('.carousel img');
    let index = 0;

    function setActiveImage() {
        images.forEach(image => image.classList.remove('active'));
        images[index].classList.add('active');
    }

    setActiveImage();

    setInterval(() => {
        index = (index + 1) % images.length;
        setActiveImage();
    }, 5000);
</script>

<!-- SECTION : Why Choose Us -->
<section class="why-choose">
  <div class="container">
    <h2>Why Choose Us?</h2>

    <div class="choose-grid">

      <!-- Bloc 1 -->
      <div class="card-lux">
        <img src="https://cdn-icons-png.flaticon.com/512/942/942748.png" alt="Professional Icon" class="icon-lux">
        <h3 class="title-lux">Professional</h3>
        <p class="text-lux">
          Our elite team of professionals understands luxury standards and the unique needs of high-end travelers.
        </p>
      </div>

      <!-- Bloc 2 -->
      <div class="card-lux">
        <img src="https://cdn-icons-png.flaticon.com/512/456/456212.png" alt="Reliable Icon" class="icon-lux">
        <h3 class="title-lux">Reliable</h3>
        <p class="text-lux">
          We work exclusively with verified partners and deliver consistent, 5-star quality experiences with integrity.
        </p>
      </div>

      <!-- Bloc 3 -->
      <div class="card-lux">
        <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Competitive Icon" class="icon-lux">
        <h3 class="title-lux">Competitive</h3>
        <p class="text-lux">
          Transparent and premium pricing. We offer unmatched luxury for your budget—no compromise on excellence.
        </p>
      </div>

    </div>
  </div>
</section>

<style>
  .why-choose {
    background: linear-gradient(to bottom, #0a0a0a, #1a1a1a);
    padding: 100px 20px;
    color: #ffffff;
    font-family: 'Helvetica Neue', sans-serif;
    text-align: center;
  }

  .why-choose h2 {
    font-size: 3.2rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 80px;
    font-family: 'Georgia', serif;
    letter-spacing: 2px;
    text-shadow: 0 0 10px #d4af37;
  }

  .container {
    max-width: 1200px;
    margin: auto;
  }

  .choose-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 50px;
  }

  .card-lux {
    background: rgba(30, 30, 30, 0.85);
    backdrop-filter: blur(8px);
    padding: 50px 35px;
    border-radius: 20px;
    border: 1px solid rgba(255, 215, 0, 0.15);
    box-shadow: 0 10px 20px rgba(212, 175, 55, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    overflow: hidden;
    cursor: default;
  }

  .card-lux:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 40px rgba(212, 175, 55, 0.25);
  }

  .icon-lux {
    width: 60px;
    margin-bottom: 25px;
    filter: brightness(1.1) drop-shadow(0 0 4px #f0c040);
  }

  .title-lux {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #ffffff;
    letter-spacing: 1px;
    text-transform: uppercase;
  }

  .text-lux {
    font-size: 1.1rem;
    color: #f0f0f0;
    line-height: 1.8;
  }

  @media (max-width: 600px) {
    .why-choose h2 {
      font-size: 2.2rem;
    }

    .card-lux {
      padding: 35px 20px;
    }

    .title-lux {
      font-size: 1.5rem;
    }

    .text-lux {
      font-size: 1rem;
    }
  }

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
    transform: scale(1.2);
  }

</style>



<!-- SECTION : Témoignages Clients -->
<section style="background-color: #f5f5f5; padding: 100px 20px;">
  <div style="max-width: 1100px; margin: auto; text-align: center;">
    <h2 style="font-size: 3rem; font-weight: 700; margin-bottom: 60px; color: #1a1a1a; font-family: 'Georgia', serif; letter-spacing: 1px;">Ce que disent nos clients</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 50px;">
      
      <!-- Témoignage -->
      <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; font-family: 'Helvetica Neue', sans-serif; padding: 40px 0;">

  <!-- Témoignage 1 -->
  <div style="background: #fff; padding: 35px 30px; border-radius: 20px; box-shadow: 0 15px 30px rgba(0,0,0,0.1); max-width: 350px; transition: transform 0.3s ease;">
    <div style="color: #f5a623; font-size: 1.2rem; margin-bottom: 15px;">
      ★★★★★
    </div>
    <p style="font-style: italic; font-size: 1.1rem; color: #444; line-height: 1.8;">“Séjour inoubliable ! La villa était magnifique et l’équipe toujours disponible.”</p>
    <h4 style="margin-top: 25px; font-weight: 600; color: #111; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.5px;">— Sarah M.</h4>
  </div>

  <!-- Témoignage 2 -->
  <div style="background: #fff; padding: 35px 30px; border-radius: 20px; box-shadow: 0 15px 30px rgba(0,0,0,0.1); max-width: 350px; transition: transform 0.3s ease;">
    <div style="color: #f5a623; font-size: 1.2rem; margin-bottom: 15px;">
      ★★★★★
    </div>
    <p style="font-style: italic; font-size: 1.1rem; color: #444; line-height: 1.8;">“Organisation parfaite, activités incroyables. Je recommande vivement Royal Key Marrakech.”</p>
    <h4 style="margin-top: 25px; font-weight: 600; color: #111; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.5px;">— Amine B.</h4>
  </div>

  <!-- Témoignage 3 -->
  <div style="background: #fff; padding: 35px 30px; border-radius: 20px; box-shadow: 0 15px 30px rgba(0,0,0,0.1); max-width: 350px; transition: transform 0.3s ease;">
    <div style="color: #f5a623; font-size: 1.2rem; margin-bottom: 15px;">
      ★★★★★
    </div>
    <p style="font-style: italic; font-size: 1.1rem; color: #444; line-height: 1.8;">“L’expérience a dépassé nos attentes. On reviendra l’année prochaine !”</p>
    <h4 style="margin-top: 25px; font-weight: 600; color: #111; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.5px;">— Clara & Thomas</h4>
  </div>

</div>

    </div>
  </div>
</section>

<!-- SECTION : Image immersive avec effet au scroll -->
<section style="position: relative; height: 80vh; background-image: url('https://elitemarrakech.com/wp-content/uploads/2021/09/IMG-20170110-WA0107.jpg'); background-size: cover; background-position: center; background-attachment: fixed; display: flex; align-items: center; justify-content: center;">
  <div style="background: rgba(0, 0, 0, 0.7); padding: 80px 50px; border-radius: 20px; max-width: 850px; text-align: center; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);">
    <h2 style="color: #fff; font-size: 3rem; font-weight: 700; margin-bottom: 30px; font-family: 'Georgia', serif; letter-spacing: 1px;">Une Expérience Unique à Marrakech</h2>
    <p style="color: #e0e0e0; font-size: 1.25rem; line-height: 1.8; font-family: 'Helvetica Neue', sans-serif;">Profitez du luxe, du confort et d’un service personnalisé dans nos villas prestigieuses. Chaque détail est pensé pour vous offrir un séjour de rêve.</p>
  </div>
</section>



@endsection
