<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'f_thumbnail',
        'short_desc',
        'description',
        'extra_desc',
        'cost_price',
        'sale_price',
        'old_price',
        'start_date',
        'end_date',
        'is_discount',
        'is_stock',
        'sku',
        'stock_status_id',
        'stock_qty',
        'u_stock_qty',
        'subcategory_id',
        'category',
        'brand_id',

        'variation_color',
        'variation_size',
        'tax_id',
        'is_featured',
        'is_publish',
        'user_id',
        'store_id',
        'og_title',
        'og_image',
        'og_description',
        'og_keywords',
        'price',
        'price1',
        'price2',
        'price3',
        'price4',
        'price5',
    ];
    public function screenTimes()
{
    return $this->hasMany(ScreenTime::class, 'product_id');
}
public function orders()
{
    return $this->belongsToMany(Order::class)->withPivot('quantity', 'price');
}
}
