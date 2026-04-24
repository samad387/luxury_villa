<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email',
            'phone'         => 'required|string|max:20',
            'message'       => 'required|string',
            'check_in'      => 'required|date',
            'check_out'     => 'required|date',
            'car_model'     => 'nullable|string|max:255', // champ voiture optionnel
            'activity_name' => 'nullable|string|max:255', // champ activité optionnel
        ]);

        // Récupération du modèle de voiture ou du nom d'activité
        $carModel = $request->input('car_model');
        $activityName = $request->input('activity_name');
        
        // Déterminer le type de réservation et le nom
        $reservationType = '';
        $itemName = '';
        
        if ($activityName) {
            $reservationType = 'Activité';
            $itemName = $activityName;
        } elseif ($carModel) {
            $reservationType = 'Transport';
            $itemName = $carModel;
        } else {
            $reservationType = 'Réservation';
            $itemName = 'Non spécifié';
        }

        // Sauvegarde de la réservation dans la base de données
        Reservation::create([
            'name'             => $request->name,
            'email'            => $request->email,
            'phone'            => $request->phone,
            'message'          => $request->message,
            'check_in'         => $request->check_in,
            'check_out'        => $request->check_out,
            'car_model'        => $carModel,
            'activity_name'    => $activityName,
            'reservation_type' => $reservationType,
            'item_name'        => $itemName,
            'status'           => 'pending', // Statut par défaut : en attente de confirmation
        ]);

        // Envoi de l'email
        Mail::raw(
            "Nouvelle réservation pour : {$itemName}\n\nType : {$reservationType}\nNom : {$request->name}\nEmail : {$request->email}\nTéléphone : {$request->phone}\nDate de début : {$request->check_in}\nDate de fin : {$request->check_out}\n\nMessage :\n{$request->message}",
            function ($message) use ($reservationType, $itemName) {
                $message->to('abdessamad777gt@gmail.com')
                        ->subject('Nouvelle réservation : ' . $itemName . ' (' . $reservationType . ')');
            }
        );

        // Redirection avec message de succès
        return redirect()->back()->with('success', 'Votre réservation a été envoyée avec succès !');
    }
}
