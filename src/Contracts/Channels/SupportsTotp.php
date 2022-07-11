<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Contracts\Channels;

use Worksome\MultiFactorAuth\DataValues\Totp\TotpIdentifier;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\TotpResponse;

interface SupportsTotp
{
    public function createTotp(string $issuer, TotpIdentifier $identifier, string $label): TotpResponse;

    public function verifyTotp(TotpIdentifier $identifier, string $code): bool;
}
