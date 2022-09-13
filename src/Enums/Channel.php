<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Enums;

enum Channel: string
{
    case EMAIL = 'email';
    case SMS = 'sms';
}
