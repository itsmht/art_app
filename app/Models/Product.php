<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    use HasFactory;
    function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'category_id');
    }
    function product_images()
    {
        return $this->hasMany('App\Models\ProductImage', 'product_id', 'product_id');
    }
    function purchase()
    {
        return $this->hasMany('App\Models\Purchase', 'product_id', 'product_id');
    }
    // function review()
    // {
    //     return $this->hasMany('App\Models\Review', 'product_id', 'product_id');
    // }
    // function rating()
    // {
    //     return $this->hasMany('App\Models\Rating', 'product_id', 'product_id');
    // }
    // function request()
    // {
    //     return $this->hasMany('App\Models\ServiceRequest', 'product_id', 'product_id');
    // }
    // function my_product()
    // {
    //     return $this->hasMany('App\Models\MyProduct', 'product_id', 'product_id');
    // }
}
