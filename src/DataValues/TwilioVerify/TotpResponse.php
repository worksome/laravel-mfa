<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\DataValues\TwilioVerify;

use Worksome\MultiFactorAuth\DataValues\Totp\TotpSecret;
use Worksome\MultiFactorAuth\Enums\Status;

class TotpResponse
{
    public function __construct(
        public readonly string $identifier,
        public readonly Status $status,
        public readonly TotpSecret $secret,
        public readonly array $data = [],
    ) {
    }
}
