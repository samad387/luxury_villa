<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage; 
class Villa extends Model
{
     use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'capacity',
        'description',
        'geo_emplacement',
    ];

    /**
     * Get all of the images for the villa.
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Accessor to get latitude and longitude as an array.
     *
     * @return array|null
     */
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

    /**
     * Boot method to delete associated images when the model is deleted.
     */
    protected static function booted()
    {
        static::deleting(function ($villa) {
            // Delete actual image files from storage
            foreach ($villa->images as $image) {
                Storage::disk('public')->delete($image->path);
            }
            // Delete image records from the database
            $villa->images()->delete();
        });
    }
}
