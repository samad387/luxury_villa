<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $fillable = [
        'type', 'nom', 'description', 'image', 'prix', 'capacity'
    ];

    public function images()
    {
        return $this->morphMany(\App\Models\Image::class, 'imageable');
    }
}
