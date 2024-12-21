<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeRequest extends Model
{
    protected $table = 'requests';
    protected $primaryKey = 'request_id';
    use HasFactory;
}
