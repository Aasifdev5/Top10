<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTimeSlot extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_id',
        'service_id',
        'day',
        'from',
        'to',
        'slots',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
