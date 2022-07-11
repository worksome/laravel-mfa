<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Worksome\MultiFactorAuth\Models\MultiFactor;

/** @mixin Model */
trait HasMultiFactorAuthentication
{
    abstract public function isMultiFactorAuthenticationEnabled(): HasMany;

    public function multiFactors(): HasMany
    {
        return $this->hasMany(MultiFactor::class);
    }
}
