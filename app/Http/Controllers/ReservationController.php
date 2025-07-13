<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'required|string|max:20',
            'message'    => 'required|string',
            'check_in'   => 'required|date',
            'check_out'  => 'required|date',
            'car_model'  => 'nullable|string|max:255', // champ voiture optionnel mais recommandé
        ]);

        // Récupération du modèle de voiture
        $carModel = $request->input('car_model', 'Voiture inconnue');

        // Envoi de l’email
        Mail::raw(
            "Nouvelle réservation pour : {$carModel}\n\nNom : {$request->name}\nEmail : {$request->email}\nTéléphone : {$request->phone}\nDate de Check-in : {$request->check_in}\nDate de Check-out : {$request->check_out}\n\nMessage :\n{$request->message}",
            function ($message) use ($carModel) {
                $message->to('abdessamad777gt@gmail.com')
                        ->subject('Nouvelle réservation : ' . $carModel);
            }
        );

        // Redirection avec message de succès
        return redirect()->back()->with('success', 'Votre réservation a été envoyée avec succès !');
    }
}
