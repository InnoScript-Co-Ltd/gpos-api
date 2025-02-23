<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $table = 'invoices';

    protected $fillable = [
        'iv_number', 'total_item_amount', 'tax', 'total_amount', 'pay_amount', 'refund_amount',
    ];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'iv_number');
    }
}
