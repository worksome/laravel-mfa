<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Contracts\Channels;

use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\DataValues\Identifier;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\CreationResponse;

/**
 * @extends ChannelDriver<EmailAddress>
 */
interface SupportsEmail extends ChannelDriver
{
    public function make(Identifier $to): CreationResponse;

    public function verify(Identifier $to, string $code): bool;
}
