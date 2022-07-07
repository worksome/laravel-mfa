<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers\Concerns;

use Worksome\MultiFactorAuth\Enums\Status;

trait CanFakeSmsVerification
{
    private Status $smsStatus;

    private bool $smsVerified;

    public function withSmsStatus(Status $status): self
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
