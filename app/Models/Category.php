<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    use HasFactory;
    function product()
    {
        return $this->hasMany('App\Models\Product', 'category_id', 'category_id');
    }
}
