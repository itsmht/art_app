<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchases';
    protected $primaryKey = 'purchase_id';
    use HasFactory;
    function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'product_id');
    }
}
