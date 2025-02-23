<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceItem extends Model
{
    use SoftDeletes;

    protected $table = 'invoice_items';

    protected $fillable = [
        'category_id', 'invoice_id', 'item_id', 'name', 'qty', 'amount',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'category_id');
    }

    public function item()
    {
        return $this->hasOne(Item::class, 'item_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'invoice_id');
    }
}
