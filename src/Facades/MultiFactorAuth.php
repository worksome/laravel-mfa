<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Facades;

use Illuminate\Support\Facades\Facade;
use Worksome\MultiFactorAuth\Drivers\NullDriver;
use Worksome\MultiFactorAuth\DTOs\Secret;
use Worksome\MultiFactorAuth\Managers\MultiFactorManager;

/** @mixin \Worksome\MultiFactorAuth\MultiFactorAuth */
class MultiFactorAuth extends Facade
{
    public static function fake(Secret $secret = null): void
    {
        /** @var \Worksome\MultiFactorAuth\MultiFactorAuth $instance */
        $instance = self::$app->make(\Worksome\MultiFactorAuth\MultiFactorAuth::class);

        /** @var MultiFactorManager $manager */
        $manager = self::$app->make(MultiFactorManager::class);

        /** @var NullDriver $nullDriver */
        $nullDriver = $manager->driver('null');

        if ($secret !== null) {
            $nullDriver->withSecret($secret);
        }

        $instance->usingDriver($nullDriver);

        self::swap($instance);
    }

    protected static function getFacadeAccessor(): string
    {
        return \Worksome\MultiFactorAuth\MultiFactorAuth::class;
    }
}
