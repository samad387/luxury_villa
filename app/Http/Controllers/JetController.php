<?php

namespace App\Http\Controllers;

use App\Models\Jet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class JetController extends Controller
{
    public function index()
    {
        // Fetch only active jets with their images, ordered by creation date (newest first)
        $jets = Jet::where('active', 1)
                   ->with('images')
                   ->orderBy('created_at', 'desc')
                   ->get();
        return view('jets.index', compact('jets'));
    }

    public function show(Jet $jet)
    {
        // Load images for the jet
        $jet->load('images');
        return view('jets.show', compact('jet'));
    }

    public function reserve(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'jet_id' => 'required|exists:jets,id',
            'departure' => 'required|string|max:255',
            'arrival' => 'required|string|max:255',
            'departure_datetime' => 'required|date',
            'message' => 'nullable|string',
        ]);

        $jet = Jet::findOrFail($data['jet_id']);

        $messageText = $data['message'] ?? 'Aucun message additionnel';

        Mail::raw("
NOUVELLE DEMANDE DE RÉSERVATION - JET PRIVÉ

Informations du client:
- Nom complet: {$data['name']}
- Email: {$data['email']}
- Téléphone: {$data['phone']}

Détails du vol:
- Jet: {$jet->name}
- Départ: {$data['departure']}
- Arrivée: {$data['arrival']}
- Date et heure de départ: {$data['departure_datetime']}

Message additionnel:
{$messageText}
", function ($message) use ($jet) {
            $message->to('abdessamad777gt@gmail.com')
                    ->subject('Nouvelle demande de réservation - ' . $jet->name);
        });

        return back()->with('success', 'Votre demande de réservation a été envoyée avec succès. Nous vous contacterons sous peu.');
    }
}
