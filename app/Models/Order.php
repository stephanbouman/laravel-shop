<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'status',
        'payment_id'
    ];

    public function orderlines()
    {
        return $this->hasMany(OrderLine::class);
    }

    public function getTotalPriceAttribute()
    {
        return $this->orderlines->sum(function (OrderLine $orderLine) {
            return $orderLine->price * $orderLine->quantity;
        });
    }

    public function getIsOpenAttribute()
    {
        return $this->status === 'open';
    }

    public function getIsPaidAttribute()
    {
        return $this->status === 'paid';
    }

    public function savePaymentId($paymentId)
    {
        $this->update(['payment_id' => $paymentId]);
    }
}
