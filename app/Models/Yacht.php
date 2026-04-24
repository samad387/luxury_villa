<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

class Yacht extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'length_meters',
        'price_per_day',
        'description',
        'image', // Keep for backward compatibility
        'active',
    ];

    /**
     * Get all of the images for the yacht.
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
        static::deleting(function ($yacht) {
            // Delete actual image files from storage
            foreach ($yacht->images as $image) {
                Storage::disk('public')->delete($image->path);
            }
            // Delete image records from the database
            $yacht->images()->delete();
            
            // Also delete the old single image if exists
            if ($yacht->image && Storage::disk('public')->exists($yacht->image)) {
                Storage::disk('public')->delete($yacht->image);
            }
        });
    }
}
