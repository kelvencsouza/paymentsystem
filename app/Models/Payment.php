<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Payment extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'status', 'method', 'installment', 'product_id', 'coupon_discount', 'short_id', 'total_amount',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
