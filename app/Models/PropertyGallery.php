<?php

namespace App\Models;

use App\Models\Property;
use Illuminate\Database\Eloquent\Model;

class PropertyGallery extends Model
{
    protected $fillable = [
        'property_id',
        'image',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
