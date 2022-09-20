<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Enums;

enum Channel: string
{
    case Email = 'email';
    case Sms = 'sms';
    case Totp = 'totp';
}
