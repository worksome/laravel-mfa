<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Enums\Sms;

enum Status: string
{
    case APPROVED = 'approved';
    case PENDING = 'pending';
    case FAILED = 'failed';
}
