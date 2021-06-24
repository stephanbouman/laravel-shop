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

    public function scopePaid($query)
    {
        return $query->whereStatus('paid');
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

    public function getInvoiceNumberAttribute()
    {
        return str_pad($this->id, 5, '0', STR_PAD_LEFT);
    }

    public function getInvoicePdfUrlAttribute()
    {
        return route('invoice.pdf', [
            'order'       => $this,
            'fingerprint' => $this->fingerprint,
        ]);
    }

    public function saveInvoicePdf()
    {
        $filePath = storage_path("invoices/invoice-" . $this->invoice_number . ".pdf");

        $this->createBrowsershotInvoice()
            ->savePdf($filePath);
    }

    public function getInvoicePdfStream()
    {
        $streamContent = $this->createBrowsershotInvoice()->pdf();

        return response()
            ->stream(function () use ($streamContent) {
                echo $streamContent;
            }, 200, ['Content-Type' => 'application/pdf']);
    }

    public function createBrowsershotInvoice()
    {
        return Browsershot::url($this->invoice_pdf_url)
            ->margins(12, 12, 12, 12)
            ->format('A4')
            ->showBackground();
    }

}
