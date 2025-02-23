<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceItem extends Model
{
    use SoftDeletes;

    protected $table = 'invoice_items';

    protected $fillable = [
        'category_id', 'iv_number', 'item_id', 'name', 'qty', 'price', 'amount',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
