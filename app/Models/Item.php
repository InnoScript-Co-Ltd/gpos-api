<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $table = 'items';

    protected $fillable = [
        'name', 'description', 'category_id', 'sku', 'photo', 'description', 'qty', 'price',
        'qrcode', 'status', 'created_at', 'updated_at', 'deleted_at',
    ];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id');
    }
}
