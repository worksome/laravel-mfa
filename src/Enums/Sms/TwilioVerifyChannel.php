<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Enums\Sms;

enum TwilioVerifyChannel: string
{
    case EMAIL = 'email';
    case SMS = 'sms';
}
