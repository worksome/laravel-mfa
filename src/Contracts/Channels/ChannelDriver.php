<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Contracts\Channels;

use Worksome\MultiFactorAuth\DataValues\Identifier;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\CreationResponse;

/**
 * @template TIdentifier of Identifier
 */
interface ChannelDriver
{
    /**
     * @param  TIdentifier  $to
     */
    public function send(Identifier $to): CreationResponse;
    /**
     * @param  TIdentifier  $to
     */
    public function verify(Identifier $to, string $code): bool;
}
