<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    function Category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    function Product(){
        return $this->hasMany(Product::class, 'subcategory_id');
    }
}
