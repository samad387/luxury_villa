<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'nom', 'description', 'image', 'prix', 'category'
    ];

    public function images()
    {
        return $this->morphMany(\App\Models\Image::class, 'imageable');
    }
}











