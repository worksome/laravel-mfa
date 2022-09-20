<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers\Sms;

use Worksome\MultiFactorAuth\DataValues\Identifier;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\CreationResponse;
use Worksome\MultiFactorAuth\Drivers\AbstractSmsDriver;
use Worksome\MultiFactorAuth\Enums\Channel;
use Worksome\MultiFactorAuth\Enums\Status;
use Worksome\MultiFactorAuth\Services\TwilioVerify\Client;

class TwilioVerifySmsDriver extends AbstractSmsDriver
{
    public function __construct(private readonly Client $client)
    {
    }

    public function send(Identifier $to): CreationResponse
    {
        $data = $this->client->sendVerification($to->data, Channel::Sms);

        assert(isset($data['status']));

        return new CreationResponse(
            Status::fromTwilioVerify($data['status']),
            $data
        );
    }

    public function verify(Identifier $to, string $code): bool
    {
        $data = $this->client->sendVerificationCheck($to->data, $code);

        assert(isset($data['status']));

        return Status::fromTwilioVerify($data['status']) === Status::APPROVED;
    }
}