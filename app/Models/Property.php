<?php

namespace App\Models;

use App\Models\PropertyGallery;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'property_name',
        'type',
        'location',
        'pricing',
        'interest',
        'rules_and_regulations',
        'description',
        'property_type',
        'beds',
        'baths',
        'area',
        'status',
        'discounted',
        'latitude',
        'longitude',
        'disc_percent',
        'date_range',
        'airbnb',
        'capitalvac',
        'phone'
    ];

    public function galleries()
    {
        return $this->hasMany(PropertyGallery::class);
    }
}
