<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazilas extends Model
{
    use HasFactory;

    function Billing(){
        return $this->hasMany(billing::class, 'upazilas');
    }
}
