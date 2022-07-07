<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Contracts\Channels;

use Worksome\MultiFactorAuth\DataValues\TwilioVerify\TotpResponse;

interface SupportsTotp
{
    public function createTotp(string $issuer, string $identifier, string $label): TotpResponse;

    public function verifyTotp(string $identifier, string $code, array $data = []): bool;
}
