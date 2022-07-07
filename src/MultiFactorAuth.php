<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth;

use Illuminate\Support\Traits\ForwardsCalls;
use Worksome\MultiFactorAuth\Contracts\Driver;
use Worksome\MultiFactorAuth\Managers\MultiFactorManager;

/** @mixin Driver */
class MultiFactorAuth
{
    use ForwardsCalls;

    private Driver|null $driver = null;

    public function __construct(private readonly MultiFactorManager $multiFactorManager)
    {
    }

    public function usingDriver(Driver|null $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    private function driver(): Driver
    {
        // @phpstan-ignore-next-line
        return $this->driver ?? $this->multiFactorManager->driver();
    }

    public function __call(string $name, array $arguments): mixed
    {
        return $this->forwardCallTo($this->driver(), $name, $arguments);
    }
}
