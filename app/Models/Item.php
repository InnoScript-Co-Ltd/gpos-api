<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $table = 'items';

    protected $fillable = [
        'name', 'description', 'category_id', 'photo', 'description', 'qty', 'price', 'qrcode', 'status',
        'created_at', 'updated_at', 'deleted_at',
    ];
}
