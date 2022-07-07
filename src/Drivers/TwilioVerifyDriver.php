<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers;

use Worksome\MultiFactorAuth\Contracts\Channels\SupportsSms;
use Worksome\MultiFactorAuth\Contracts\Driver;
use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\DataValues\Sms\SmsCreationResponse;
use Worksome\MultiFactorAuth\Enums\Sms\Status;
use Worksome\MultiFactorAuth\Enums\Sms\TwilioVerifyChannel;
use Worksome\MultiFactorAuth\Services\TwilioVerify\Client;

class TwilioVerifyDriver implements Driver, SupportsSms
{
    public function __construct(private readonly Client $client)
    {
    }

    public function sendSms(E164PhoneNumber $to): SmsCreationResponse
    {
        $data = $this->client->sendVerification($to->number, TwilioVerifyChannel::SMS);

        assert(isset($data['status']));

        return new SmsCreationResponse(
            Status::fromTwilioVerify($data['status']),
            $data
        );
    }

    public function verifySms(E164PhoneNumber $to, string $code): bool
    {
        $data = $this->client->sendVerificationCheck($to->number, $code);

        assert(isset($data['status']));

        return Status::fromTwilioVerify($data['status']) === Status::APPROVED;
    }
}
