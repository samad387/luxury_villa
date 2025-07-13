<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'path',
        'imageable_id',
        'imageable_type',
    ];

    /**
     * Get the parent imageable model (villa, riad, appartement).
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
