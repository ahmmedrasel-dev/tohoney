<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    function Subcategory()
    {
        return $this->hasOne(SubCategory::class, 'category_id');
    }

    function Product()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    function Blog()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }
}
