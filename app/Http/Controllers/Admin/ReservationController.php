<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationConfirmedMail;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::latest()->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    public function edit(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('admin.reservations.edit', compact('reservation'));
    }

    public function update(Request $request, string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $rules = [
            'status' => 'required|string|in:pending,confirmed,cancelled'
        ];

        if ($request->has('name')) {
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'required|email|max:255';
            $rules['phone'] = 'nullable|string|max:255';
            $rules['guests_count'] = 'nullable|integer|min:1';
            $rules['check_in'] = 'required|date';
            $rules['check_out'] = 'required|date';
            $rules['item_name'] = 'nullable|string|max:255';
            $rules['reservation_type'] = 'nullable|string|max:255';
            $rules['advance_payment'] = 'nullable|numeric|min:0';
            $rules['total_payment'] = 'nullable|numeric|min:0';
        }

        $request->validate($rules);

        $oldStatus = $reservation->status;
        
        // Exclure 'action' de l'update
        $reservation->update($request->except(['_token', '_method', 'action']));

        // Si c'est un test d'envoi de PDF à l'admin
        if ($request->action === 'test_pdf') {
            // Si le statut a été passé à 'confirmed' par erreur lors du test, on le remet à son état d'origine
            if ($reservation->status === 'confirmed' && $oldStatus !== 'confirmed') {
                $reservation->status = $oldStatus;
                $reservation->save();
            }

            $pdf = Pdf::loadView('pdf.reservation_confirmation', compact('reservation'));
            $pdfContent = $pdf->output();

            // Envoi à l'email de l'admin
            Mail::to('abdessamad777gt@gmail.com')
                ->send(new ReservationConfirmedMail($reservation, $pdfContent));

            return back()->with('success', 'TEST PDF a été envoyé à votre adresse email administrateur !');
        }

        // Flow normal d'enregistrement et de confirmation
        if ($oldStatus !== 'confirmed' && $reservation->status === 'confirmed') {
            // Génération du PDF
            $pdf = Pdf::loadView('pdf.reservation_confirmation', compact('reservation'));
            $pdfContent = $pdf->output();

            // Envoi de l'email avec le PDF en pièce jointe au client
            Mail::to($reservation->email)
                ->send(new ReservationConfirmedMail($reservation, $pdfContent));
        }
        
        return redirect()->route('admin.reservations.index')->with('success', 'Réservation mise à jour avec succès.');
    }

    public function destroy(string $id)
    {
        Reservation::findOrFail($id)->delete();
        return back()->with('success', 'Réservation supprimée avec succès.');
    }
}
