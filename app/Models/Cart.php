<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        // Update Function Jokhon Use korbo tokhon Model ke protected $fillable use kore fill gulo ke likhte dite hobe.
        'quantity'
    ];

    function Product (){
        return $this->belongsTo(Product::class, 'product_id');
    }

    function Color(){
        return $this->belongsTo(Color::class, 'color_id');
    }

    function Size(){
        return $this->belongsTo(Size::class, 'size_id');
    }
}
