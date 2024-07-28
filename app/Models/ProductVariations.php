<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariations extends Model
{
    use HasFactory;
    protected $table = 'product_variations'; // Adjust the table name if necessary

    protected $fillable = [
        'product_id',
        'size',
        'color',
        'sku',
        // Add other fields here if necessary
    ];
}
