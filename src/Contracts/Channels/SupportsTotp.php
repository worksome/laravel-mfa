<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Contracts\Channels;

use Worksome\MultiFactorAuth\DataValues\CreationResponse;
use Worksome\MultiFactorAuth\DataValues\Identifier;
use Worksome\MultiFactorAuth\DataValues\Totp\TotpSecret;

/**
 * @extends ChannelDriver<TotpSecret>
 */
interface SupportsTotp extends ChannelDriver
{
    public function make(Identifier $to): CreationResponse;

    public function verify(Identifier $to, string $code): bool;
}
