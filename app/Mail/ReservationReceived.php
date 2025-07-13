<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('Nouvelle réservation : ' . ($this->data['car_model'] ?? 'Voiture inconnue'))
                    ->view('emails.reservation')
                    ->with('data', $this->data);
    }
}
