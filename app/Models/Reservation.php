<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'guests_count',
        'message',
        'check_in',
        'check_out',
        'car_model',
        'activity_name',
        'reservation_type',
        'item_name',
        'advance_payment',
        'total_payment',
        'status',
    ];
}
