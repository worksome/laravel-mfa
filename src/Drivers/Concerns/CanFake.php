<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers\Concerns;

use Worksome\MultiFactorAuth\Enums\Status;

trait CanFake
{
    private Status $status;

    private bool $verified;

    public function fakeStatus(Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function fakeVerified(bool $verified = true): self
    {
        $this->verified = $verified;

        return $this;
    }
}
