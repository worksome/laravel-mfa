<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers\Email;

use Worksome\MultiFactorAuth\DataValues\Identifier;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\CreationResponse;
use Worksome\MultiFactorAuth\Drivers\AbstractEmailDriver;
use Worksome\MultiFactorAuth\Drivers\Concerns\CanFake;
use Worksome\MultiFactorAuth\Enums\Status;

class NullEmailDriver extends AbstractEmailDriver
{
    use CanFake;

    public function make(Identifier $to): CreationResponse
    {
        return new CreationResponse($this->status ?? Status::PENDING);
    }

    public function verify(Identifier $to, string $code): bool
    {
        return $this->verified ?? true;
    }
}
