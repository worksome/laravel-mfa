<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Enums\TwilioVerify;

enum Factor: string
{
    case TOTP = 'totp';
}
