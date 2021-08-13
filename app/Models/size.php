<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class size extends Model
{
    use HasFactory;

    function ProductAttribute(){
        return $this->hasMany(ProductAttribute::class, 'size_id');
    }

    function order(){
        return $this->hasMany(Order::class, 'size_id');
    }
}
