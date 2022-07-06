<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Contracts;

interface TwoFactorAuthenticatable
{
    public function isTwoFactorAuthenticationEnabled(): bool;
}
