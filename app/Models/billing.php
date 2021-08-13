<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class billing extends Model
{
    use HasFactory;

    function City(){
        return $this->belongsTo(City::class, 'city');
    }

    function Upazilas(){
        return $this->belongsTo(Upazilas::class, 'upazilas');
    }

    function Country(){
        return $this->belongsTo(Country::class, 'country');
    }
}
