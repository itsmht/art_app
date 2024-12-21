<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'transaction_id';
    use HasFactory;

    function account()
    {
        return $this->belongsTo('App\Models\Account', 'account_id', 'account_id');
    }
}
