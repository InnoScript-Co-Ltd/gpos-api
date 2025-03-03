<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $table = 'invoices';

    protected $fillable = [
        'customer_id',

        'iv_number', 'total_item_amount', 'tax', 'total_amount', 'pay_amount', 'refund_amount',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class); 
    }
}
