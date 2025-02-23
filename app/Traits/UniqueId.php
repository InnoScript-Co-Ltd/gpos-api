<?php

namespace App\Traits;

use App\Helpers\UniqueIdHelper;

trait UniqueId
{
    /**
     * Boot function from Laravel.
     */
    protected static function bootUniqueId()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (new UniqueIdHelper)->makePrimaryId();
            }
        });
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }
}
