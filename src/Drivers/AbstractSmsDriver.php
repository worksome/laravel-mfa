<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers;

use Worksome\MultiFactorAuth\Contracts\Channels\SupportsSms;
use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\CreationResponse;

abstract class AbstractSmsDriver implements SupportsSms
{
    abstract public function sendSms(E164PhoneNumber $to): CreationResponse;

    abstract public function verifySms(E164PhoneNumber $to, string $code): bool;
}
