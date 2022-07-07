<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Contracts\Channels;

use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\DataValues\Sms\SmsCreationResponse;

interface SupportsSms
{
    public function sendSms(E164PhoneNumber $to): SmsCreationResponse;

    public function verifySms(E164PhoneNumber $to, string $code): bool;
}
