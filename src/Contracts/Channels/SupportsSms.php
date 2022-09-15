<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Contracts\Channels;

use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\CreationResponse;

interface SupportsSms extends ChannelDriver
{
    public function sendSms(E164PhoneNumber $to): CreationResponse;

    public function verifySms(E164PhoneNumber $to, string $code): bool;
}
