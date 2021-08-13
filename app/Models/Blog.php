<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    function Category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    function User(){
        return $this->belongsTo(User::class, 'user_id');
    }

    function Keyword(){
        return $this->hasMany(Keyword::class, 'blog_id');
    }

}
