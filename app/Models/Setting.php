<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'shop_name', 'logo', 'phone', 'email', 'address', 'tax',
    ];

    protected $hidden = [
        'id', 'deleted_at', 'created_at', 'updated_at',
    ];
}
