<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use App\Models\Reservation;

class ReservationConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $pdfContent;

    /**
     * Create a new message instance.
     */
    public function __construct(Reservation $reservation, $pdfContent)
    {
        $this->reservation = $reservation;
        $this->pdfContent = $pdfContent;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de votre réservation - ' . str_pad($this->reservation->id, 5, '0', STR_PAD_LEFT),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // On utilise un simple html text ou une petite vue d'email qu'on laisse vide
        return new Content(
            view: 'emails.reservation_confirmed_text', 
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfContent, 'Confirmation_Reservation_' . $this->reservation->id . '.pdf')
                    ->withMime('application/pdf'),
        ];
    }
}
