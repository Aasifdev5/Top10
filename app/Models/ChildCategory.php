<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;

    protected $table = 'child_categories';
    protected $fillable = ['name','slug','category_id','sub_category_id','status','image', 'description'];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class, 'sub_category_id', 'id');
    }

    public function services(){
        return $this->hasMany('App\Models\Service');
    }

    public function metaData(){
        return $this->morphOne(MetaData::class,'meta_taggable');
    }

}
