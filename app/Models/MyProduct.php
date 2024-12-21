<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyProduct extends Model
{
    protected $table = 'my_products';
    protected $primaryKey = 'my_product_id';
    use HasFactory;
}
