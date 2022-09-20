<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Contracts\Channels;

use Worksome\MultiFactorAuth\DataValues\CreationResponse;
use Worksome\MultiFactorAuth\DataValues\Identifier;

/**
 * @template TIdentifier of Identifier
 */
interface ChannelDriver
{
    /**
     * @param TIdentifier $to
     */
    public function make(Identifier $to): CreationResponse;

    /**
     * @param TIdentifier $to
     */
    public function verify(Identifier $to, string $code): bool;
}
