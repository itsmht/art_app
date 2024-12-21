<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranReq extends Model
{
    protected $table = 'transaction_requests';
    protected $primaryKey = 'tr_id';
    use HasFactory;
}
