<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class color extends Model
{
    use HasFactory;

    function ProductAttribute(){
        return $this->hasMany(ProductAttribute::class, 'color_id');
    }

    function Cart(){
        return $this->hasMany(Cart::class, 'color_id');
    }

    function Order(){
        return $this->hasMany(Order::class, 'color_id');
    }
}
