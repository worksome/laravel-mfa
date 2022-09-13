<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers\Concerns;

use Worksome\MultiFactorAuth\Enums\Status;

trait CanFakeEmailVerification
{
    private Status $emailStatus;

    private bool $emailVerified;

    public function withEmailStatus(Status $status): self
    {
        $this->emailStatus = $status;

        return $this;
    }

    public function withEmailVerified(bool $verified = true): self
    {
        $this->emailVerified = $verified;

        return $this;
    }
}
