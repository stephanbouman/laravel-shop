<?php

namespace App\Models;

use Spatie\Browsershot\Browsershot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'status',
        'payment_id',
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

    public function getTotalItemsAttribute()
    {
        return $this->orderlines->sum(function (OrderLine $orderLine) {
            return $orderLine->quantity;
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

    public function getFingerprintAttribute()
    {
        return md5($this->payment_id);
    }

    public function savePaymentId($paymentId)
    {
        $this->update(['payment_id' => $paymentId]);
    }

    public function getInvoicePdfStream()
    {

        $invoicePdfUrl = route('invoice.pdf', [
            'order'       => $this,
            'fingerprint' => $this->fingerprint,
        ]);

        $streamContent = Browsershot::url($invoicePdfUrl)
            ->margins(12, 12, 12, 12)
            ->format('A4')
            ->showBackground()
            ->pdf();

        return response()
            ->stream(function () use ($streamContent) {
                echo $streamContent;
            }, 200, ['Content-Type' => 'application/pdf']);
    }

}
