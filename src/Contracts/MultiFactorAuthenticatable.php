<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Contracts;

interface MultiFactorAuthenticatable
{
    public function isMultiFactorAuthenticationEnabled(): bool;

    public function multiFactors(): bool;
}
