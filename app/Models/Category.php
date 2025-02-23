<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'name', 'description', 'status', 'created_at', 'updated_at', 'deleted_at',
    ];

    public function items(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
