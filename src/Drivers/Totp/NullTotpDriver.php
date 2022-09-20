<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers\Totp;

use Worksome\MultiFactorAuth\DataValues\CreationResponse;
use Worksome\MultiFactorAuth\DataValues\Identifier;
use Worksome\MultiFactorAuth\Drivers\AbstractSmsDriver;
use Worksome\MultiFactorAuth\Drivers\Concerns\CanFake;
use Worksome\MultiFactorAuth\Enums\Status;

class NullTotpDriver extends AbstractSmsDriver
{
    use CanFake;

    public function __construct()
    {
    }

    public function make(Identifier $to): CreationResponse
    {
        return new CreationResponse($this->status ?? Status::PENDING, [
            'secret' => 'TEST',
        ]);
    }

    public function verify(Identifier $to, string $code): bool
    {
        return $this->verified ?? true;
    }
}
