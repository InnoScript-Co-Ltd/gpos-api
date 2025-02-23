<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Str;

class UniqueIdHelper
{
    public function makePrimaryId(): string
    {
        $uuid = Str::orderedUuid();

        return $uuid;
    }
}
