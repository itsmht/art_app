<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $primaryKey = 'product_image_id';
    use HasFactory;
    function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'product_id');
    }
}
