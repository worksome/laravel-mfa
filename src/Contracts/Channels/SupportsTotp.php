<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Contracts\Channels;

use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\CreationResponse;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\TotpResponse;

interface SupportsTotp
{
    public function createTotp(string $identifier, string $label): TotpResponse;

    public function verifyTotp(string $identifier, string $code): bool;
}
