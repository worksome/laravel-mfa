<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers;

use Worksome\MultiFactorAuth\Contracts\Channels\SupportsSms;
use Worksome\MultiFactorAuth\Contracts\Driver;
use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\DataValues\Sms\SmsCreationResponse;
use Worksome\MultiFactorAuth\Enums\Sms\Status as SmsStatus;

class NullDriver implements Driver, SupportsSms
{
    private SmsStatus $smsStatus;
    private bool $smsVerified;

    public function sendSms(E164PhoneNumber $to): SmsCreationResponse
    {
        return new SmsCreationResponse($this->smsStatus ?? SmsStatus::PENDING);
    }

    public function verifySms(E164PhoneNumber $to, string $code): bool
    {
        return $this->smsVerified ?? true;
    }

    public function withSmsStatus(SmsStatus $status): self
    {
        $this->smsStatus = $status;

        return $this;
    }

    public function withSmsVerified(bool $verified = true): self
    {
        $this->smsVerified = $verified;

        return $this;
    }
}
