<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

class Appartement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'capacity',
        'description',
        'geo_emplacement',
    ];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getCoordinatesAttribute()
    {
        if ($this->geo_emplacement) {
            $coords = explode(',', $this->geo_emplacement);
            if (count($coords) == 2) {
                return ['lat' => (float)trim($coords[0]), 'lng' => (float)trim($coords[1])];
            }
        }
        return null;
    }

    protected static function booted()
    {
        static::deleting(function ($appartement) {
            foreach ($appartement->images as $image) {
                Storage::disk('public')->delete($image->path);
            }
            $appartement->images()->delete();
        });
    }
}
