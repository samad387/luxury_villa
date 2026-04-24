<?php

namespace App\Http\Controllers;

use App\Models\Yacht;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class YachtController extends Controller
{
    public function index()
    {
        // Fetch only active yachts with their images, ordered by creation date (newest first)
        $yachts = Yacht::where('active', 1)
                   ->with('images')
                   ->orderBy('created_at', 'desc')
                   ->get();
        return view('yachts.index', compact('yachts'));
    }

    public function show(Yacht $yacht)
    {
        // Load images for the yacht
        $yacht->load('images');
        return view('yachts.show', compact('yacht'));
    }

    public function reserve(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'yacht_id' => 'required|exists:yachts,id',
            'departure' => 'required|string|max:255',
            'arrival' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'return_date' => 'required|date|after:departure_date',
            'message' => 'nullable|string',
        ]);

        $yacht = Yacht::findOrFail($data['yacht_id']);

        $messageText = $data['message'] ?? 'Aucun message additionnel';

        Mail::raw("
NOUVELLE DEMANDE DE RÉSERVATION - YACHT

Informations du client:
- Nom complet: {$data['name']}
- Email: {$data['email']}
- Téléphone: {$data['phone']}

Détails de la location:
- Yacht: {$yacht->name}
- Port de départ: {$data['departure']}
- Port d'arrivée: {$data['arrival']}
- Date de départ: {$data['departure_date']}
- Date de retour: {$data['return_date']}

Message additionnel:
{$messageText}
", function ($message) use ($yacht) {
            $message->to('abdessamad777gt@gmail.com')
                    ->subject('Nouvelle demande de réservation - ' . $yacht->name);
        });

        return back()->with('success', 'Votre demande de réservation a été envoyée avec succès. Nous vous contacterons sous peu.');
    }
}
