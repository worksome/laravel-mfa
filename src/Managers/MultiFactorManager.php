<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Managers;

use Illuminate\Support\Manager;
use Worksome\MultiFactorAuth\Drivers\NullDriver;

final class MultiFactorManager extends Manager
{
    public function getDefaultDriver(): string
    {
        // @phpstan-ignore-next-line
        return $this->config->get('mfa.default') ?? 'null';
    }

    public function createNullDriver(): NullDriver
    {
        return new NullDriver();
    }
}
