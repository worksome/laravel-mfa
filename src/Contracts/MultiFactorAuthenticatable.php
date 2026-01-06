<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Worksome\MultiFactorAuth\Models\MultiFactor;

interface MultiFactorAuthenticatable
{
    public function isMultiFactorAuthenticationEnabled(): bool;

    /** @return HasMany<MultiFactor, Model&$this> */
    public function multiFactors(): HasMany;
}
