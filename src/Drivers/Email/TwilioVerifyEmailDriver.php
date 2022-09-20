<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers\Email;

use Worksome\MultiFactorAuth\DataValues\CreationResponse;
use Worksome\MultiFactorAuth\DataValues\Identifier;
use Worksome\MultiFactorAuth\Drivers\AbstractEmailDriver;
use Worksome\MultiFactorAuth\Enums\Channel;
use Worksome\MultiFactorAuth\Enums\Status;
use Worksome\MultiFactorAuth\Services\TwilioVerify\Client;

class TwilioVerifyEmailDriver extends AbstractEmailDriver
{
    public function __construct(private readonly Client $client)
    {
    }

    public function make(Identifier $to): CreationResponse
    {
        $data = $this->client->sendVerification($to->data, Channel::Email);

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
