<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    function billing(){
        return $this->belongsTo(billing::class, 'billing_id');
    }

    function size(){
        return $this->belongsTo(Size::class, 'size_id');
    }
    
    function color(){
        return $this->belongsTo(Color::class, 'color_id');
    }
}



