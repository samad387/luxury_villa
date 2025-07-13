@extends('layouts.app')

@section('title', 'Contact')

@section('content')

<section style="position: relative; width: 100%; height: 100vh; overflow: hidden;">
    <img src="https://elitemarrakech.com/wp-content/uploads/2021/09/Marrakech_DarSayang_41.jpg" 
         alt="Contact Marrakech" 
         style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: -1;">
    
    <div style="display: flex; align-items: center; justify-content: center; height: 100%;">
        <div style="
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            max-width: 600px;
            width: 90%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        ">
            <h2 style="text-align: center; font-size: 2rem; margin-bottom: 30px; font-weight: bold; color: #222;">Contactez-nous</h2>

            @if(session('success'))
                <div style="color: green; margin-bottom: 20px; text-align: center;">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('contact.send') }}">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label for="name" style="display: block; margin-bottom: 8px; font-weight: 600;">Nom</label>
                    <input type="text" id="name" name="name" required
                           style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc; font-size: 1rem;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; margin-bottom: 8px; font-weight: 600;">Email</label>
                    <input type="email" id="email" name="email" required
                           style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc; font-size: 1rem;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="phone" style="display: block; margin-bottom: 8px; font-weight: 600;">Téléphone</label>
                    <input type="tel" id="phone" name="phone" required
                           style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc; font-size: 1rem;">
                </div>

                <div style="margin-bottom: 30px;">
                    <label for="message" style="display: block; margin-bottom: 8px; font-weight: 600;">Message</label>
                    <textarea id="message" name="message" rows="5" required
                              style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc; font-size: 1rem;"></textarea>
                </div>

                <div style="text-align: center;">
                    <button type="submit"
                            style="background-color: #000; color: white; padding: 14px 30px; font-size: 1.1rem; border-radius: 8px; cursor: pointer;">
                        Envoyer
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
