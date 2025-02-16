<?php

namespace App\Enums;

enum UserStatusEnum: string
{
    case PENDING = 'PENDING';
    case ACTIVE = 'ACTIVE';
    case BLOCK = 'DIACTIVE';
}
