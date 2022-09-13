<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Facades;

use Illuminate\Support\Facades\Facade;
use Worksome\MultiFactorAuth\Contracts\Channels\SupportsSms;

/**
 * @see SupportsSms
 * @mixin \Worksome\MultiFactorAuth\MultiFactorAuth
 */
class MultiFactorAuth extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Worksome\MultiFactorAuth\MultiFactorAuth::class;
    }
}
