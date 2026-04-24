<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

class Jet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'range_km',
        'price_per_hour',
        'description',
        'image', // Keep for backward compatibility
        'active',
    ];

    /**
     * Get all of the images for the jet.
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Boot method to delete associated images when the model is deleted.
     */
    protected static function booted()
    {
        static::deleting(function ($jet) {
            // Delete actual image files from storage
            foreach ($jet->images as $image) {
                Storage::disk('public')->delete($image->path);
            }
            // Delete image records from the database
            $jet->images()->delete();
            
            // Also delete the old single image if exists
            if ($jet->image && Storage::disk('public')->exists($jet->image)) {
                Storage::disk('public')->delete($jet->image);
            }
        });
    }
}
