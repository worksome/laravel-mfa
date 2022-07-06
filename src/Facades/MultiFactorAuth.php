<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Worksome\MultiFactorAuth\MultiFactorAuth
 */
class MultiFactorAuth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-mfa';
    }
}
