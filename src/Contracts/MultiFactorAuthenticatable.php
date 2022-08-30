<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Contracts;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface MultiFactorAuthenticatable
{
    public function isMultiFactorAuthenticationEnabled(): bool;

    public function multiFactors(): HasMany;
}
