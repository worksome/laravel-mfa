<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Enums\TwilioVerify;

enum Channel: string
{
    case EMAIL = 'email';
    case SMS = 'sms';
}
