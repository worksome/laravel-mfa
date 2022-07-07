<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers\Concerns;

use Worksome\MultiFactorAuth\Enums\Status;

trait CanFakeTotpVerification
{
    private Status $totpStatus;

    private bool $totpVerified;

    public function withTotpStatus(Status $status): self
    {
        $this->totpStatus = $status;

        return $this;
    }

    public function withTotpVerified(bool $verified = true): self
    {
        $this->totpVerified = $verified;

        return $this;
    }
}
