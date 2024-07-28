<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalService extends Model
{
    use HasFactory;
    protected $fillable = ['provider_id','service_id','title','price','duration'];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
