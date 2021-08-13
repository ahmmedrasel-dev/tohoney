<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    function SubCategory(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    function Category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    function Brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    function ProductGallery (){
        return $this->hasMany(ProductGallery::class, 'product_id');
    }

    function Cart(){
        return $this->hasMany(Cart::class, 'product_id');
    }

    function ProductAttribute(){
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    function order(){
        return $this->hasMany(Order::class, 'product_id');
    }

    function wishlist(){
        return $this->hasMany(Wishlist::class, 'product_id');
    }

    function productreview()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }

}
