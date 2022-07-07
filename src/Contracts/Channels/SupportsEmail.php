<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Contracts\Channels;

use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\CreationResponse;

interface SupportsEmail
{
    public function sendEmail(EmailAddress $to): CreationResponse;

    public function verifyEmail(EmailAddress $to, string $code): bool;
}
