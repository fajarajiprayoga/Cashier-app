<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'discount',
        'total_price',
        'pay',
        'change',
    ];

    public function transaction_details()
    {
        return $this->hasOne(TransactionDetail::class);
    }
}
