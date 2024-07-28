<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'full_name',
        'address',
        'city',
        'country',
        'postal_code',
    ];

    /**
     * Get the user that owns the billing detail.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
