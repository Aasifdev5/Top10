<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subcategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';
    protected $primaryKey = 'id';
    protected $fillable = [

        'category_id',
        'name',
        'slug',
        'description',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }



}
