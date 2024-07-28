<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_title',
        'category_id',
        'subcategory_id',
        'price',
        'duration',
        'description',
        'additional_service_status',
        'additional_service_title',
        'additional_service_price',
        'additional_service_duration',
        'video_link',
        'number_of_days',
        'all_days_from',
        'all_days_to',
        'all_days_slots',
        'address',
        'country',
        'city',
        'state',
        'pincode',
        'google_maps_place_id',
        'latitude',
        'longitude',
        'gallery_files',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'provider_id',
    ];

    protected $casts = [
        'gallery_files' => 'array', // Cast JSON field to array
        'additional_service_status' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    // Define any relationships here
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function provider()
    {
        return $this->belongsTo(User::class);
    }
    public function timeSlots()
    {
        return $this->hasMany(ServiceTimeSlot::class);
    }
}
