<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Worksome\MultiFactorAuth\Contracts\MultiFactorAuthenticatable;
use Worksome\MultiFactorAuth\Models\MultiFactor;

/**
 * @mixin Model
 * @mixin MultiFactorAuthenticatable
 */
trait HasMultiFactorAuthentication
{
    abstract public function isMultiFactorAuthenticationEnabled(): bool;

    /** @return HasMany<MultiFactor> */
    public function multiFactors(): HasMany
    {
        return $this->hasMany(MultiFactor::class);
    }
}
